<?php

namespace App\Http\Livewire\Evaluations\Categories\Questions;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Subcategory;
use Livewire\Component;

class Index extends Component
{
    public $evaluation;
    public $categoryChoosed;
    public $categories;
    public $subcategories;

    public function mount(Evaluation $evaluation, Category $category)
    {
        $this->evaluation = $evaluation->append('is_answerable');
        $this->categoryChoosed = $category;
        $categoryChoosed = $this->categoryChoosed;
        $this->categories = Category::get();
        $this->subcategories = Subcategory::with(['questions'=> function($query) use($categoryChoosed){
            $query->where('category_id',$categoryChoosed->id)->with('answers.observation');
        }])
        ->get()
        ->append('has_questions');
    }

    public function render()
    {
        return view('livewire.evaluations.categories.questions.index');
    }
}
