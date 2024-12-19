<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SeoField extends Component
{
    public $ft;
    public $sd;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ft,$sd)
    {
      $this->ft = $ft;
      $this->sd = $sd;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.seo-field');
    }
}
