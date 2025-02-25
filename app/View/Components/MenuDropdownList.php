<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuDropdownList extends Component
{
  public $title;
  public $links;
  /**
   * Create a new component instance.
   */
  public function __construct($title, $links)
  {
    $this->title = $title;
    $this->links = $links;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.menu-dropdown-list');
  }
}
