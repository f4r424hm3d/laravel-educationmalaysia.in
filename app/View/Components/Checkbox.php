<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
  public $label;
  public $name;
  public $id;
  public $ft;
  public $sd;
  public $required;

  public function __construct($label = '', $name = '', $id = '', $ft = '', $sd = '', $required = null)
  {
    $this->label = $label;
    $this->name = $name;
    $this->id = $id;
    $this->ft = $ft;
    $this->sd = $sd;
    $this->required = $required;
  }

  public function render()
  {
    return view('components.checkbox');
  }
}
