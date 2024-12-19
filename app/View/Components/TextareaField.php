<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextareaField extends Component
{
  public $label;
  public $name;
  public $id;
  public $ft;
  public $sd;
  public $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label,$name,$id,$ft,$sd,$required=null)
    {
      $this->label = $label;
      $this->name = $name;
      $this->id = $id;
      $this->ft = $ft;
      $this->sd = $sd;
      $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea-field');
    }
}
