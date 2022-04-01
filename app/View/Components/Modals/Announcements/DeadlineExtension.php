<?php

namespace App\View\Components\modals\Announcements;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\AnnouncementRepository;
use Livewire\WithPagination;

class DeadlineExtension extends Component
{

    use WithPagination;
    public $title;
    public $users;
    public $announcement;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $title, $announcement, $users)
    {
        $this->title = $title;
        $this->users = $users;
        $this->announcement = $announcement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modals.announcements.deadline-extension', [
            'announcement' => $this->announcement,
            'announcementRepository' => AnnouncementRepository::where('announcement_id',$this->announcement->id)->get()
        ]);
    }
}
