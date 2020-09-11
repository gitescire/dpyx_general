<?php

namespace App\Http\Livewire\Subcategories;

use App\Models\Subcategory;
use Livewire\Component;

class Index extends Component
{
    private $subcategories;

    public function render()
    {
        $this->subcategories = Subcategory::paginate(10);
        return view('livewire.subcategories.index', [
            'subcategories' => $this->subcategories
        ]);
    }
}
