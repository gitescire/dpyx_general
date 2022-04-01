<?php

namespace App\Http\Controllers\Announcements\AnnouncementRepository;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementRepository;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateAnnouncementRepositoryController extends Controller
{
    public function __invoke(Request $request, Int $announcementRepositoryId)
    {
        $announcementRepository = AnnouncementRepository::find($announcementRepositoryId);
        $announcementRepository->extended_final_date = $request->extended_final_date;
        $announcementRepository->save();

        Alert::success('¡Extensión de recepción registrada!');
        return redirect()->route('announcements.index');
    }
}
