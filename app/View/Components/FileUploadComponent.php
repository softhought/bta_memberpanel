<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileUploadComponent extends Component
{
    public $id;
    public $label;
    public $value;
    public $accept;
    public function __construct($id, $label = 'Choose a file:', $value = '', $accept = '')
    {
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        $this->accept = $accept;
    }

    public function render(): View|Closure|string
    {
        return view('components.file-upload');
    }
}
