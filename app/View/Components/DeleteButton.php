<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton extends Component
{
  public $id;
  /**
   * Create a new component instance.
   */
  public function __construct($id)
  {
    $this->id = $id;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.delete-button');
  }
}
