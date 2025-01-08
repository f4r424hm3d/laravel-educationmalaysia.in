<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentViewModal extends Component
{
  public $row;
  public $field;
  public $title;
  /**
   * Create a new component instance.
   */
  public function __construct($row, $field, $title = 'Details')
  {
    $this->row = $row;
    $this->field = $field;
    $this->title = $title;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.content-view-modal');
  }
}
