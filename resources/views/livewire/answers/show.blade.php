<div class="mb-4" x-data="data()">

    @section('header')
        <x-page-title title="Mostrar respuesta"
            description="Este módulo permite desplegar la información y observaciones de la respuesta seleccionada.">
        </x-page-title>
    @endsection

    @if ($errors->first())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    {{--  --}}

    <div class="col-12 mb-3 d-flex justify-content-end">
        @if ($answer->observation)
            <form action="{{ route('observations.delete', [$answer->observation]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        @endif
    </div>

    <form action="{{ route('observations.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <input type="hidden" name="answer_id" value="{{ $answer->id }}">

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
                                <td>{{ $answer->question->description }}</td>
                                <td>{{ $answer->question->max_punctuation }}</td>
                                <td>
                                    <input type="text" class="form-control"
                                        value="{{ $answer->choice ? $answer->choice->description : 'Sin respuesta' }}"
                                        readonly>
                                    @if ($answer->punctuation > 0)
                                        <textarea class="form-control" readonly
                                            rows="5">{{ $answer->description }}</textarea>
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
                        <div class="row">
                            <div class="col-12 mb-3">
                                @can('edit evaluations')
                                    <input type="file" name="files[]" multiple>
                                @endcan
                            </div>
                        </div>
                        @if ($answer->observation && $answer->observation->files_paths)
                            <div class="row">
                                @foreach ($answer->observation->files_paths as $file)

                                    <template x-if="!filesToDelete.includes('{{ $file['file_name'] }}')">
                                        <div class="col-12 col-lg-4">
                                            {{-- <form action=> --}}
                                            {{-- @csrf --}}
                                            <small><a
                                                    href="{{ route('observations.files.download', [$answer->observation, $file['file_name']]) }}">{{ $file['file_name'] }}</a></small>
                                            <img src="https://img.icons8.com/cotton/2x/file.png"
                                                class="img-thumbnail mb-3">
                                            <a href="{{ route('observations.files.download', [$answer->observation, $file['file_name']]) }}"
                                                class="btn btn-info btn-shadow rounded-0 mr-auto">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button type="button" filename="{{ $file['file_name'] }}"
                                                x-on:click="deleteFile($event)"
                                                class="btn btn-primary btn-shadow rounded-0 mr-auto">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            {{-- </form> --}}
                                        </div>
                                    </template>
                                @endforeach
                            </div>
                            <template x-for="file in filesToDelete">
                                <div>
                                    <span class="text-uppercase text-muted">Files to delete</span>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="filesToDelete[]"
                                                x-bind:value="file" readonly>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        @else
                            <div class="alert alert-info">
                                No hay ningún archivo subido.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{--  --}}

            <div class="col-12 col-lg-6 mb-3">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <label for="" class="text-muted text-uppercase">Observaciones</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control"
                            {{ Auth::user()->can('edit evaluations') ? '' : 'disabled' }}>{{ $answer->observation ? $answer->observation->description : '' }}</textarea>
                    </div>
                </div>
            </div>

            {{--  --}}

            @can('edit evaluations')
                <div class="col-12 mb-3 d-flex justify-content-end">
                    <a href="{{ route('evaluations.categories.questions.index', [$answer->evaluation, $answer->question->category]) }}" class="btn btn-outline-danger btn-shadow rounded-0 mr-3">
                        <i class="fas fa-window-close"></i> Cancelar
                    </a>
                    <button class="btn btn-success btn-wide btn-shadow rounded-0">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            @endcan
        </div>
    </form>

    <script>
        function data() {
            return {
                filesToDelete: [],

                async deleteFile(event) {
                    const filename = event.target.attributes.getNamedItem('filename').value
                    await this.filesToDelete.push(filename)
                }
            }
        }

    </script>

</div>
