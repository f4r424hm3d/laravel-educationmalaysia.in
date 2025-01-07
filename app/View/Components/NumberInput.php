<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NumberInput extends Component
{

  public $label;
  public $type;
  public $name;
  public $id;
  public $ft;
  public $sd;
  public $required;
  public $max;
  public $min;
  public $step;
  /**
   * Create a new component instance.
   */
  public function __construct($label, $type, $name, $id, $ft, $sd, $required = null, $max = null, $min = null, $step = null)
  {
    $this->label = $label;
    $this->type = $type;
    $this->name = $name;
    $this->id = $id;
    $this->ft = $ft;
    $this->sd = $sd;
    $this->required = $required;
    $this->max = $max;
    $this->min = $min;
    $this->step = $step;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.number-input');
  }
}
