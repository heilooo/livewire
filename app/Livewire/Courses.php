<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Course as CourseModel;
use Livewire\Attributes\Js;
use Livewire\WithPagination;

class Courses extends Component
{
    use withPagination;

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

    public function delete($id)
    {
        Course::findOrFail($id)->delete();
    }

    #[Validate([
        'name' => 'required|min:3|max:5',
        'price' => 'required'
    ])]
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

    public function edit($id)
    {

        $this->singleCourse = CourseModel::findOrFail($id);
        $this->dispatch('showEditModal');
    }

    public function update($id)
    {
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $course = CourseModel::findOrFail($id);
        $course->update($validated);
        $this->dispatch('closeModal');
    }

    // در کامپوننت
    public function submitForm()
    {
        if (isset($this->singleCourse) && $this->singleCourse) {
            $this->update($this->singleCourse->id);
        } else {
            $this->save();
        }
    }


    public function changeStatus($value, $id)
    {
        $course = CourseModel::findOrFail($id);
        $course->update(['status' => $value]);
        $this->dispatch('ShowToast');
    }

    public function resetAll()
    {
        $this->reset();
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
