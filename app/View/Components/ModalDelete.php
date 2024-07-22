<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDelete extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $titulo;
    public $size;
    public $route;
    public function __construct($id,$titulo,$route,$size='md')
    {
        //
        $this->id = $id;
        $this->titulo = $titulo;
        $this->size = $size;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-delete');
    }
}
