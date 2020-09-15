<?php

namespace App\View\Components\Forms;

use App\Models\Category;
use App\Models\Question;
use App\Models\Subcategory;
use Illuminate\View\Component;

class Questions extends Component
{
    public $question;
    public $categories;
    public $subcategories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($question = null)
    {
        $this->question = $question;
        $this->categories = Category::get();
        $this->subcategories = Subcategory::get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.questions');
    }
}