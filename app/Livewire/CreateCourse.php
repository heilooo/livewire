<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CreateCourse extends Component
{

    public $name = '';
    public $price = '';
    public function save()
    {
        $inputs = ['name' => $this->name, 'price' => $this->price];
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        Course::create($validated);
        return to_route('courses')->with('success', 'دوره با موفقیت ساخته شد!');
    }
    public function render()
    {
        return view('livewire.create-course');
    }
}
