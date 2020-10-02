<div class="mb-4">

    @section('header')
    <x-page-title title="Lista de usuarios"
        description="Este módulo permite listar las preguntas que aparecerán en las evaluaciones."></x-page-title>
    @endsection

    <div class="row">
        @foreach ($categories as $category)
        @foreach ($category->subcategories as $subcategory)
        @if ($subcategory->total_punctuation != 100)
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content border-0 shadow">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading text-uppercase">{{$category->name}}</div>
                            <div class="widget-subheading text-uppercase">{{$subcategory->name}}</div>
                        </div>
                        <div class="widget-content-right">
                            @if ($subcategory->total_punctuation > 100)
                            <div class="widget-numbers text-danger">{{$subcategory->total_punctuation}}%</div>
                            {{-- @elseif($subcategory->total_punctuation == 100)
                                <div class="widget-numbers text-success">{{$subcategory->total_punctuation}}%</div>
                        --}}
                        @else
                        <div class="widget-numbers text-warning">{{$subcategory->total_punctuation}}%</div>
                        @endif
                    </div>
                </div>
                <div class="widget-progress-wrapper">
                    <div class="progress-bar-sm progress">
                        @if ($subcategory->total_punctuation > 100)
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{$subcategory->total_punctuation}}%;"></div>
                        {{-- @elseif($subcategory->total_punctuation == 100)
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="71" aria-valuemin="0"
                                aria-valuemax="100" style="width: {{$subcategory->total_punctuation}}%;"></div> --}}
                    @else
                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="71" aria-valuemin="0"
                        aria-valuemax="100" style="width: {{$subcategory->total_punctuation}}%;"></div>
                    @endif
                </div>
                <div class="progress-sub-label">
                    <div class="sub-label-left">Máximo porcentaje</div>
                    <div class="sub-label-right">{{$subcategory->total_punctuation}}%</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endforeach
</div>

<div class="row d-flext justify-content-between mb-3">
    <div class="col-12 col-lg-4">
        <x-input-search/>
    </div>
    <div class="col-12 col-lg-3">
        <a href="{{route('questions.create')}}" class="btn btn-success btn-wide btn-shadow rounded-0 float-right">
            <i class="fas fa-plus"></i> Agregar
        </a>
    </div>
</div>

<div class="table-responsive shadow bg-white mb-3">
    <table class="table m-0">
        <thead>
            <tr>
                <th class="text-uppercase">ID</th>
                <th class="text-uppercase">Descripción</th>
                <th class="text-uppercase">Puntuación</th>
                <th class="text-uppercase">Órden</th>
                <th class="text-uppercase">Categoría</th>
                <th class="text-uppercase">Subcategoría</th>
                <th class="text-uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
            <tr>
                <td>{{$question->id}}</td>
                <td>{!! str_replace(['\n\r','\n','\r'], '<br/>', $question->description) !!}</td>
                <td>Max. {{$question->max_punctuation}}%</td>
                <td>{{$question->order}}</td>
                <td>{{$question->category->name}}</td>
                <td>{{$question->subcategory->name}}</td>
                <td class="d-flex justify-content-between">
                    <form action="{{route('questions.destroy',[$question])}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-shadow rounded-0">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{route('questions.edit',[$question])}}" class="btn btn-warning btn-shadow rounded-0 ml-1">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$questions->links()}}

</div>