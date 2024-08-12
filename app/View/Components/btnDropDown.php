<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class btnDropDown extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $items;
    public $color;
    public $ruta;
    public function __construct(
        $id,$items,$ruta,$color="secondary"
    )
    {
        $this->id = $id;
        $this->items = $items;
        $this->color = $color;
        $this->ruta = $ruta;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.btn-drop-down');
    }
}
