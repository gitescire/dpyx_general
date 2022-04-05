<div class="row mb-4">
    <div class="col-12 backbutton-container">
        <a href="{{url('')}}" class="btn btn-link text-dark float-left d-none d-md-block"><i class="fas fa-globe"></i></a>/<a href="{{url( $redirect )}}" class="btn btn-link">{{ $message }}</a>/@if($repository_name) <span class="text-info">{{$repository_name}}</span> @endif
        <a href="{{url( $redirect )}}" class="btn btn-info btn-small btn-sm shadow-sm float-right"><i class="fas fa-chevron-left"></i> Volver</a>
    </div>
</div>
