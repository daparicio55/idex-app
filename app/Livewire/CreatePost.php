<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class CreatePost extends Component
{
    public $name;
    public $email;
    
    public function mount(User $user){
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function save(){
//        dd($this->name);
    }
    public function render()
    {
        return view('livewire.create-post');
    }
}
