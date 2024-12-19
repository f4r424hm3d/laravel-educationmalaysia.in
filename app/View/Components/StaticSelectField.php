<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StaticSelectField extends Component
{
  public $label;
  public $name;
  public $id;
  public $ft;
  public $sd;
  public $savev;
  public $showv;
  public $list;
  public $required;
  /**
   * Create a new component instance.
   */
  public function __construct($label, $name, $id, $ft, $sd, $list, $showv, $savev, $required = null)
  {
    $this->label = $label;
    $this->name = $name;
    $this->id = $id;
    $this->ft = $ft;
    $this->sd = $sd;
    $this->savev = $savev;
    $this->showv = $showv;
    $this->list = $list;
    $this->required = $required;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.static-select-field');
  }
}
