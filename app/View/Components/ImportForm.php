<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImportForm extends Component
{
  public $pageRoute;
  public $fileName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageRoute,$fileName)
    {
      $this->pageRoute = $pageRoute;
      $this->fileName = $fileName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.import-form');
    }
}
