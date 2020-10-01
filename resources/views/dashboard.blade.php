<x-app-layout>

    @section('header')
    <x-page-title title="Dashboard"
        description="Bienvenido a dPyx. Debajo tienes una seria de pasos  para realizar tu evaluación"></x-page-title>
    @endsection

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-8">
            <h2 class="text-uppercase text-center text-info">¿Cómo realizar tu evaluación? 📓</h2>
            <div class="main-card mb-3 card border-0 shadow">
                <div class="card-body">
                    <div
                        class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-info"> </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title text-info">
                                        Entra a tu evaluación
                                    </h4>
                                    <p>
                                        Entra en la sección <b><i class="metismenu-icon fas fa-box-open"></i>
                                            Repositorios</b>
                                        y da click en el boton <a
                                            class="btn btn-sm btn-primary btn-shadow rounded-0 text-white"
                                            href="javascript:void(0)"> <i class="fas fa-edit"></i></a>
                                        del repositorio que desees.
                                        {{-- Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a> --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-info"> </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title text-info">
                                        Contesta tu evaluación
                                    </h4>
                                    <p>
                                        Las preguntas están seccionadas por categorias. Así que por cada categoría que
                                        contestes
                                        deberás presionar el botón
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-success btn-wide shadow rounded-0">
                                            <i class="fas fa-save"></i> Continuar
                                        </a>
                                        para que los cambios sean guardados.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-info"> </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title text-info">
                                        Envía tu evaliación
                                    </h4>
                                    <p>
                                        Cuando has finalizado las preguntas, <b>si hay alguna convocatoria activa en el
                                            momento</b>, podrás enviar tus respuestas a CONCYTEC.
                                        dentro de tu evaluación aparecerá el botón
                                        <a href="javascript:void(0)"
                                            class="btn btn-success btn-sm btn-wide btn-shadow rounded-0">
                                            <i class="fas fa-paper-plane"></i> ENVIAR A CONCYTEC
                                        </a>
                                        que te permitirá enviar tu cuestionario a uno de nuestros evaluadores para su
                                        revisión
                                        que previamente le fue asignado.

                                        {{-- Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a> --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-info"> </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title text-info">
                                        Recibe una respuesta por parte de concytec
                                    </h4>
                                    <p>
                                        Una vez que el evaluador que se te ha asignado ha revisado su repositorio,
                                        entonces se
                                        le enviará una notificación al correo que nos proporcionó.
                                        Existen 3 posibles respuestas: <br>
                                        1) El repositorio fue <span class="text-success"><b>aceptado</b></span> <br>
                                        2) El repositorio tiene <span class="text-warning"><b>observaciones</b></span> y
                                        debe
                                        vover responder las preguntas que tienen observaciones <br>
                                        3) El repositorio fue <span class="text-danger"><b>rechazado</b></span> <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>