<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomButton extends Component
{
  public $url;
  public $label;
  public $count;
  public $badgeClass;
  public $btnSize;
  public $btnColor;
  /**
   * Create a new component instance.
   */
  public function __construct($url, $label, $count = 0, $badgeClass = 'bg-danger', $btnSize = 'btn-xs', $btnColor = 'btn-outline-primary')
  {
    $this->url = $url;
    $this->label = $label;
    $this->count = $count;
    $this->badgeClass = $badgeClass;
    $this->btnSize = $btnSize;
    $this->btnColor = $btnColor;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.custom-button');
  }
}
