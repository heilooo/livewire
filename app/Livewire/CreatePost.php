<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public $title;
    public $description;


    public function handelSubmit()
    {
        dd($this->title, $this->description);
    }

    public function doSumeThing($a)
    {
        dd($a);
    }


    public function render()
    {
        return view('livewire.create-post');
    }
}
