<?php

namespace App\Http\Controllers\Announcements\AnnouncementRepository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnouncementRepository;
use RealRashid\SweetAlert\Facades\Alert;

class DestroyAnnouncementRepositoryController extends Controller
{
    public function __invoke(Request $request, Int $announcementRepositoryId)
    {
        AnnouncementRepository::where('id',$announcementRepositoryId)->delete();

        Alert::success('¡Extensión de recepción eliminada!');
        return redirect()->route('announcements.index');
    }
}
