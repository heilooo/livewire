<?php

namespace App\Livewire;

use Livewire\Attributes\Renderless;
use Livewire\Component;
use App\Models\Course as CourseModel;
use Livewire\Attributes\Js;

class Course extends Component
{
    public CourseModel $course;
    public function mount(CourseModel $course)
    {
        $this->course = $course;
    }

    // #[Renderless]
    public function incrementView()
    {
        $this->course->ModelIncrementView();
        $this->skipRender();
    }

    public function render()
    {
        $course = $this->course;
        return view('livewire.course', compact('course'));
    }
}
