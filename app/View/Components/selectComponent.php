<?php

namespace App\View\Components;

use Illuminate\View\Component;

class selectComponent extends Component
{
    public $data;
    public $column;
    public $name;
    public $id;
    public $class;
    public $label;
    public $arraykey;
    public $arrayValue;
    public $value;
    public $multiple;
    public function __construct($data=[], $column=null, $name=null, $id = null, $class = null, $label = null, $arraykey = null,$arrayValue = null,$value=null, $multiple=null)
    {
        $this->data = $data;
        $this->column = $column;
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->label = $label;
        $this->arrayValue = $arrayValue;
        $this->arraykey = $arraykey;
        $this->value = $value;
        $this->multiple = $multiple;
        //  pre($this->value) ;exit;
    }


    public function render()
    {
        $result['data'] = $this->data;
        return view('components.select-component',$result);
    }
}
