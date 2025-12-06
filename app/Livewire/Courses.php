<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use App\Models\Course as CourseModel;
use Livewire\Attributes\Js;

class Courses extends Component
{
    public $search = '';
    public $sortColumn = 'id'; // ستون پیش‌فرض برای سورت
    public $sortDirection = 'desc'; // جهت پیش‌فرض

    // متد برای تغییر سورت
    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            // اگر روی ستون فعلی کلیک شد، جهت را تغییر بده
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // اگر روی ستون جدید کلیک شد
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[Js]
    public function resetData()
    {
        return <<<'JS'
        $wire.search = '';
        JS;
    }

    public function delete(CourseModel $course)
    {
        $course->delete();
    }


    public $name = '';
    public $price = '';
    public function save()
    {
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        CourseModel::create($validated);
        $this->dispatch('closeModal');
    }
    public $singleCourse = null;
    public function show($id)
    {
        $this->singleCourse = CourseModel::findOrFail($id);
        $this->dispatch('showModal');
    }



    public function render()
    {
        $courses = CourseModel::where(function ($query) {
            $query->where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('price', 'LIKE', "%{$this->search}%")
                // برای جستجوی عددی در id
                ->orWhere('id', '=', $this->search)
                ->orWhere('id', 'LIKE', "%{$this->search}%");
        })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();

        return view('livewire.courses', compact('courses'));
    }
}