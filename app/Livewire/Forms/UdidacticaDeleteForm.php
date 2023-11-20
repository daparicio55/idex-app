<?php

namespace App\Livewire\Forms;

use App\Models\Udidactica;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UdidacticaDeleteForm extends Form
{
    //
    public $id;
    public $modal = false;
    public function delete($id){
        $this->id = $id;
        $this->modal = true;
    }
    public function destroy(){
        $unidad = Udidactica::findOrFail($this->id);
        $unidad->delete();
        $this->modal = false;
    }
}
