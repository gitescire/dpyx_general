<div class="modal fade" id="deleteAnnouncement{{$announcementChoosed->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalAriaLabelledby" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar convocatoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('announcements.destroy',[$announcementChoosed]) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="alert alert-light fade show" role="alert">
                                <i>
                                    ¿Realmente desea eliminar la convocatoria <strong>{{$announcementChoosed->motive}}</strong>?
                                </i>
                            </div>
                            <hr>
                            <p class="text-center">
                                Una vez eliminada la convocatoria no podrá ser recuperada
                            </p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger btn-shadow rounded-0">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>