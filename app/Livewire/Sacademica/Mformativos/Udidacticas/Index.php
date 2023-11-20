<?php

namespace App\Livewire\Sacademica\Mformativos\Udidacticas;

use App\Livewire\Forms\Capacidades\CapacidadeCreateForm;
use App\Livewire\Forms\Capacidades\CapacidadeDeleteForm;
use App\Livewire\Forms\Capacidades\CapacidadeEditForm;
use App\Livewire\Forms\Indicadores\IndicatorCreateForm;
use App\Livewire\Forms\Indicadores\IndicatorDeleteForm;
use App\Livewire\Forms\Indicadores\IndicatorEditForm;
use App\Livewire\Forms\UdidacticaCreateForm;
use App\Livewire\Forms\UdidacticaDeleteForm;
use App\Livewire\Forms\UdidacticaEditForm;
use App\Models\Mformativo;
use App\Models\Udidactica;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Index extends Component
{
    public $mformativo;
    public $unidades;
    public UdidacticaCreateForm $udidacticacreate;
    public UdidacticaEditForm $udidacticaedit;
    public UdidacticaDeleteForm $udidacticadelete;
    //funciones para las unidades didacticas
        public function create_udidactica(){
            $this->udidacticacreate->create();
        }
        public function store_udidactica(){
            $this->udidacticacreate->store($this->mformativo->id);
        }
        public function edit_udidactica($id){
            $this->udidacticaedit->edit($id);
        }
        public function update_udidactica(){
            $this->udidacticaedit->update();
        }
        public function delete_udidactica($id){
            $this->udidacticadelete->delete($id);
        }
        public function destroy_udidactica(){
            $this->udidacticadelete->destroy();
        }
    //FUNCIONES PARA CAPACIDADES
        public CapacidadeCreateForm $capacidadecreate;
        public CapacidadeEditForm $capacidadeedit;
        public CapacidadeDeleteForm $capacidadedelete;
        public function create_capacidade($id){
            $this->capacidadecreate->create($id);
        }
        public function store_capacidade(){
            $this->capacidadecreate->store();
        }

        public function edit_capacidade($id){
            $this->capacidadeedit->edit($id);
        }
        public function update_capacidade(){
            $this->capacidadeedit->update();
        }

        public function delete_capacidade($id){
            $this->capacidadedelete->delete($id);
        }
        public function destroy_capacidade(){
            $this->capacidadedelete->destroy();
        }
    //FUNCIONES PARA INDICADORES
        public IndicatorCreateForm $indicatorcreate;
        public IndicatorEditForm $indicatoredit;
        public IndicatorDeleteForm $indicatordelete;
        public function create_indicator($id){
            $this->indicatorcreate->create($id);
        }
        public function store_indicator(){
            $this->indicatorcreate->store();
        }
        public function edit_indicator($id){
            $this->indicatoredit->edit($id);
        }
        public function update_indicator(){
            $this->indicatoredit->update();
        }
        public function delete_indicator($id){
            $this->indicatordelete->delete($id);
        }
        public function destroy_indicator(){
            $this->indicatordelete->destroy();
        }
    //FUNCIONES COMUNES
    public function mount($mformativo_id){
        //llenamos las filas de las unidades
        $this->mformativo = Mformativo::find($mformativo_id);
    }
    public function index(){
        $this->unidades = Udidactica::orderBy('id','desc')
        ->where('mformativo_id','=',$this->mformativo->id)
        ->get();
    }
    public function render()
    {
        $this->unidades = Udidactica::orderBy('id','desc')
        ->where('mformativo_id','=',$this->mformativo->id)
        ->get();
        return view('livewire.sacademica.mformativos.udidacticas.index');
    }
}
