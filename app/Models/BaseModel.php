<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setSqlMode();
        $this->setFillableFromTable();
        $this->setPrimaryKeyFromTable();
    }

    protected function setSqlMode()
    {
        static $sqlModeSet = false;

        if (!$sqlModeSet) {
            DB::statement('SET SESSION sql_mode = "NO_ENGINE_SUBSTITUTION"');
            $sqlModeSet = true;
        }
    }


    protected function setFillableFromTable()
    {
        if (!isset($this->table)) {
            $this->table = $this->getTable();
        }

        if (Schema::hasTable($this->table)) {
            $this->fillable = Schema::getColumnListing($this->table);
        }
    }

    protected function setPrimaryKeyFromTable()
    {
        if ($this->primaryKey === 'id') {
            $table = $this->getTable();
            $database = DB::getDatabaseName();

            $primaryKeyColumn = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->where('TABLE_SCHEMA', $database)
                ->where('TABLE_NAME', $table)
                ->where('CONSTRAINT_NAME', 'PRIMARY')
                ->value('COLUMN_NAME');

            if ($primaryKeyColumn) {
                $this->primaryKey = $primaryKeyColumn;
            }
        }
    }
}
