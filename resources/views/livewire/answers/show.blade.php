<div class="mb-4">

    <form action="{{route('observations.store')}}" method="POST" enctype="multipart/form-data">
        
        @csrf

        <input type="hidden" name="answer_id" value="{{$answer->id}}">

        <div class="row">

            {{--  --}}

            <div class="col-12 mb-3">
                <div class="table-responsive bg-white shadow">
                    <table class="table m-0 table-bordered">
                        <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th>Puntuación</th>
                                <th>Respuesta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$answer->question->description}}</td>
                                <td>{{$answer->question->max_punctuation}}</td>
                                <td>
                                    @if ($answer->punctuation == 0)
                                    <input type="text" class="form-control" value="Sin respuesta" readonly>
                                    @endif
                                    @if ($answer->punctuation > 0)
                                    <input type="text" value="Sí" readonly>
                                    <textarea class="form-control" readonly rows="5">{{$answer->description}}</textarea>

                                    @endif
                                    @if ($answer->punctuation < 0) <input type="text" class="form-control" value="No"
                                        readonly>
                                        @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{--  --}}

            <div class="col-12 col-lg-6 mb-3">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <input type="file" name="files[]" multiple>
                    </div>
                </div>
            </div>

            {{--  --}}

            <div class="col-12 col-lg-6 mb-3">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <label for="" class="text-muted text-uppercase">Observaciones</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control" required>{{$answer->observation ? $answer->observation->description : ''}}</textarea>
                    </div>
                </div>
            </div>

            {{--  --}}

            <div class="col-12 mb-3 d-flex justify-content-end">
                <button class="btn btn-success btn-wide btn-shadow rounded-0">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>


</div>