<?php

namespace App\Http\Livewire\Announcements;

use App\Models\Announcement;
use Livewire\Component;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    private $announcements;
    private $users;
    public $search = "";

    public function render()
    {
        $this->setUsers();
        $this->announcements = Announcement::paginate(10);
        return view('livewire.announcements.index', [
            'announcements' => $this->announcements,
            'users' => $this->users
        ]);
    }

    private function setUsers()
    {

        $this->users = User::orderBy('id', 'desc');

        if ($this->search) {
            $this->users = $this->users
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
        }

        if (Auth::user()->is_admin) {
            $this->users = $this->users;
        } else {
            $repositoryResponsiblesIds = Evaluation::where('evaluator_id', Auth::user()->id)->get()->pluck('repository.responsible.id')->flatten()->unique();
            $this->users = $this->users->whereIn('id', $repositoryResponsiblesIds);
        }

        $this->users = $this->users->get();
    }
}
