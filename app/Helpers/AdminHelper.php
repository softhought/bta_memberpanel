<?php

use App\Models\LogTable;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use PhpOffice\PhpSpreadsheet\IOFactory;

function getTopNavCat($roleId, $baseUrl = "")
{
    $menus = Menu::parents($roleId)->with('childrenRecursive')->get()->toArray();
    return generateMenuHtml($menus, 0, $baseUrl);
}

if (!function_exists('getBadgeColor')) {
    function getBadgeColor($level)
    {
        switch ($level) {
            case 0:
                return 'primary';   // Parent
            case 1:
                return 'level-success';   // Level 1
            case 2:
                return 'level-info';      // Level 2
            case 3:
                return 'level-warning';   // Level 3
            case 4:
                return 'level-danger';    // Level 4
            case 5:
                return 'level-dark';      // Level 5
            case 6:
                return 'level-light';     // Level 6
            case 7:
                return 'level-secondary'; // Level 7
            case 8:
                return 'level-muted';     // Level 8
            case 9:
                return 'level-dark';     // Level 9
            default:
                return 'level-default';   // Default for Level 10 or deeper
        }

    }
}

function generateMenuHtml($menus, $level, $baseUrl)
{
    $html = '';

    // Start the unordered list for the first level

    foreach ($menus as $item) {
        // Determine if the current item or its children are active
        $isOpen = request()->is($baseUrl . $item['url']) || isActiveChildMenu($item['children_recursive'], $baseUrl);
        $isActive = request()->is($baseUrl . $item['url']) || isActiveChildMenu($item['children_recursive'], $baseUrl);

        // Render the menu item with potential children
        if (count($item['children_recursive']) > 0) {
            $html .= '<li class="' . ($isOpen ? 'active' : '') . ' ' . ($isActive ? 'selected' : '') . '">';
            $html .= '<a href="javascript:void(0);" class="has-arrow" aria-expanded="' . ($isOpen ? 'true' : 'false') . '">';
            $html .= '<span class="has-icon">' . $item['icon'] . '</span>';
            $html .= '<span class="nav-title">' . $item['name'] . '</span>';
            // $html .= '<span class="lbl"></span>';
            $html .= '</a>';
            $html .= '<ul aria-expanded="' . ($isOpen ? 'true' : 'false') . '" class="' . ($isOpen ? 'collapse in' : 'collapse') . '">';
            $html .= generateMenuHtml($item['children_recursive'], $level + 1, $baseUrl);
            $html .= '</ul>';
        } else {
            // Single-level menu item
            $html .= '<li class="' . ($isActive ? 'selected active' : '') . '">';
            $html .= '<a href="' . url($baseUrl . $item['url']) . '">';
            $html .= '<span class="' . ($level > 0 ? 'has-icon-sub' : 'has-icon') . '">' . $item['icon'] . '</span>';
            $html .= '<span class="nav-title">' . $item['name'] . '</span>';
            $html .= '</a>';
            $html .= '</li>'; // Closing the single-level item
        }
    }

    return $html;
}

function isActiveChildMenu($children, $baseUrl)
{
    foreach ($children as $item) {
        if (request()->is($baseUrl . $item['url']) || isActiveChildMenu($item['children_recursive'], $baseUrl)) {
            return true;
        }
    }

    return false;
}


if (!function_exists('getUserBrowserName')) {
    function getUserBrowserName()
    {
        $agent = new Agent();
        $browserName = $agent->browser();
        return $browserName;

    }
}

if (!function_exists('getUserPlatform')) {
    function getUserPlatform()
    {
        $agent = new Agent();
        $platform = $agent->platform();
        return $platform;

    }
}

if (!function_exists('getUserIPAddress')) {
    function getUserIPAddress()
    {
        $agent = new Agent();
        $ipAddress = request()->ip();
        return $ipAddress;

    }
}

if (!function_exists('getIpAddress')) {
    function getIpAddress()
    {
        return request()->ip();
    }
}


function getMenuTree($userId)
{
    $menus = Menu::parents($userId)->with('childrenRecursive')->get();
    return generateMenuTree($menus, 0);
}

function generateMenuTree($menus, $level)
{

    $html = '';
    if ($level == 1) {
        $html .= '<ul>';
    }

    foreach ($menus as $item) {
        $html .= '<li id="' . $item['id'] . '">' . $item['name'];
        $html .= generateMenuTree($item['children'], 1);
        $html .= '</li>';
    }
    if ($level == 1) {
        $html .= '</ul>';
    }

    return $html;
}

function getEditData($mode, $arrayData, $filled, $imagePath = "")
{
    $value = "";
    if ($mode == "Edit" && !empty($arrayData)) {
        $value = $arrayData->$filled;
        if ($imagePath != "" && $arrayData->$filled != "") {
            $value = $imagePath . "/" . $arrayData->$filled;
        }
    }
    return $value;
}

function getEditDate($mode, $arrayData, $filled)
{
    $value = "";
    if ($mode == "Edit" && !empty($arrayData)) {
        $value = date_dmy_dp($arrayData->$filled);

    }
    return $value;
}

if (!function_exists('excelToArray')) {
    function excelToArray($file)
    {
        $path = $file->getPathname();
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [];

        foreach ($sheet->getRowIterator(1)->current()->getCellIterator() as $cell) {
            $header = $cell->getValue();
            $header = str_replace(' ', '_', $header);
            $headers[] = $header;
        }

        $data = [];

        if ($sheet->getHighestRow() > 1) {
            foreach ($sheet->getRowIterator(2) as $row) {
                $rowData = [];

                foreach ($row->getCellIterator() as $cell) {
                    $value = $cell->getValue();
                    $rowData[] = $value;
                }

                if (array_filter($rowData, fn($value) => $value !== null && $value !== '') == []) {
                    continue;
                }

                $rowKeyValue = array_combine($headers, array_map('strval', $rowData));
                $data[] = $rowKeyValue;
            }
        }

        return (object) $data;
    }
}
if (!function_exists('validateData')) {
    function validateData($data, $table, $uniqueFields = [], $fieldRules = [], $fieldMapping = [], $dbChecks = [])
    {
        $errorArray = [];
        foreach ($data as $row => $value) {
            // Check for unique fields
            foreach ($uniqueFields as $field) {
                // Map to the database field if a mapping exists
                $dbField = $fieldMapping[$field] ?? $field;

                if (!empty($value[$field])) {
                    // Check uniqueness in the database using the mapped field
                    $rowData = DB::table($table)->where($dbField, $value[$field])->first();
                    if ($rowData) {
                        $errorArray[] = ['row' => $row, 'col' => [$field]];
                    }
                }
            }

            // Check for any database existence checks
            foreach ($dbChecks as $field => $dbCheck) {
                if (!empty($value[$field])) {
                    $exists = DB::table($dbCheck['table'])->where([$dbCheck['column'] => $value[$field], 'is_active' => 'Y'])->exists();
                    if (!$exists) {
                        $errorArray[] = ['row' => $row, 'col' => [$field]];
                    }
                }
            }

            // Validate fields based on provided rules
            foreach ($fieldRules as $field => $rule) {
                if (!empty($value[$field]) && !preg_match($rule, $value[$field])) {
                    $errorArray[] = ['row' => $row, 'col' => [$field]];
                }
            }

            // Check for empty required fields
            $emptyCols = [];
            foreach (array_keys($fieldRules) as $field) {
                if (empty($value[$field])) {
                    $emptyCols[] = $field;
                }
            }

            if (!empty($emptyCols) && count($emptyCols) != count($fieldRules)) {
                $errorArray[] = ['row' => $row, 'col' => $emptyCols];
            }
        }

        return $errorArray;
    }

}


function arrConvertToAssociativeJsonObject($data)
{
    return json_decode(json_encode($data), true);
}

function insertLog($model, $mode = 'Add')
{
    $table = $model->getTable();
    $data = $model->toArray();
    $insertedId = $model->id;

    $logType = match ($mode) {
        'Edit' => config('constants.LOG_U'),
        'Delete' => config('constants.LOG_D'),
        default => config('constants.LOG_I')
    };

    LogTable::insertLogData($table, $data, $insertedId, $logType);
}


function makeReadable($text)
{
    $readableText = ucwords(str_replace('_', ' ', str_replace('-', ' ', $text)));
    return $readableText;
}


function getFileCategory($extension)
{
    $extension = strtolower($extension);

    $categories = [
        'EXCEL' => ['xls', 'xlsx', 'xlsm', 'xlsb', 'csv', 'xlt', 'xltx', 'xltm', 'xml'],
        'WORD' => ['doc', 'docx', 'dot', 'dotx', 'rtf'],
        'PDF' => ['pdf'],
        'IMAGE' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tiff'],
        'OTHER' => []
    ];

    foreach ($categories as $category => $extensions) {
        if (in_array($extension, $extensions)) {
            return $category;
        }
    }

    return 'OTHER';
}


if (!function_exists('getInitials')) {
    function getInitials($name)
    {
        $parts = explode(' ', $name);
        $initials = '';

        foreach ($parts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper(substr($part, 0, 1));
            }
        }

        return strtoupper(substr($initials, 0, 3));
    }
}

