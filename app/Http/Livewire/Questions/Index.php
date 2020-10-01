<?php

namespace App\Http\Livewire\Questions;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    private $questions;
    public $categories;
    public $search = "";

    public function mount()
    {
    }

    public function render()
    {
        $this->categories = Category::get();

        // dd($this->categories);
        $this->categories->each(function ($category) {
            $category->subcategories = Subcategory::get();
            $category->subcategories->each(function ($subcategory) use ($category) {
                $subcategory->total_punctuation = Question::where('category_id', $category->id)->where('subcategory_id', $subcategory->id)->get()->pluck('max_punctuation')->flatten()->sum();
            });
        });
        $this->setQuestions();
        return view('livewire.questions.index', [
            'questions' => $this->questions,
        ]);
    }

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    private function setQuestions()
    {
        if ($this->search) {
            $this->questions = Question::orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhereHas('category', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('subcategory', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            $this->questions = Question::paginate(10);
        }
    }
}
