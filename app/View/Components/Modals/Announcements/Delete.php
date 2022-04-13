<?php

namespace App\View\Components\modals\announcements;

use App\Models\Announcement;
use Illuminate\View\Component;

class Delete extends Component
{

    public $announcementChoosed;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcementChoosed = $announcement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modals.announcements.delete');
    }
}
