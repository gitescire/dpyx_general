<?php

namespace App\Http\Controllers\Announcements\AnnouncementRepository;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\AnnouncementRepository;
use App\Models\Repository;
use RealRashid\SweetAlert\Facades\Alert;

class StoreAnnouncementRepositoryController extends Controller
{
    public function __invoke(Request $request, Announcement $announcement, Repository $repository)
    {
        AnnouncementRepository::updateOrCreate([
            'announcement_id' => $announcement->id,
            'repository_id' => $repository->id
        ],[
            'announcement_id' => $announcement->id,
            'repository_id' => $repository->id,
            'extended_final_date' => $request->extended_final_date
        ]);

        Alert::success('¡Extensión de recepción registrada!');
        return redirect()->route('announcements.index');
    }
}
