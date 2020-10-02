<div class="mb-4" x-data="data()" x-init="mounted()">

    @section('header')
    <x-page-title title="Estadisticas de repositorio"
        description="Este módulo permite ver la evaluación final del repositorio con base en las respuestas del usuario."></x-page-title>
    @endsection

    <div class="row">
        <div class="col-12 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <canvas id="bubble-chart" width="800" height="800"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <canvas id="repositoryQualification"></canvas>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="widget-numbers mt-0 fsize-3">
                        {{-- <span>{{number_format((float)$repository->qualification, 2, '.', '');}}%</span> --}}
                        <span>{{$repository->qualification}}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($categories as $category)
        <div class="col-12 col-lg-4 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <canvas category-id="{{$category->id}}"></canvas>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="widget-numbers mt-0 fsize-3">
                        <span percentage-id="{{$category->id}}">0.00%</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function data(){
            return {

                repository: @json($repository),
                categories: @json($categories),

                mounted() {

                    this.categories.forEach(category => {

                        // Set real punctuation to the category
                        punctuations = _.map(category.questions, function(question){
                            return question.answer ? parseFloat(question.answer.choice.punctuation) : 0
                        })
                        category.punctuation = _.sum(punctuations)

                        // Set max punctuation to the category
                        max_punctuations = _.map(category.questions, function(question){
                            return parseFloat(question.max_punctuation)
                        })
                        category.max_punctuation = _.sum(max_punctuations)

                        category.percentage = category.punctuation / category.max_punctuation * 100

                        percentageSpan = document.querySelector(`span[percentage-id="${category.id}"]`);
                        percentageSpan.innerText = `${category.percentage.toFixed(2)}%`

                        if(category.percentage <= 0){
                            color = '#ff6384'
                        }else if(category.percentage > 0 && category.percentage <= 50){
                            color = '#f7b924'
                        }else{
                            color = '#3ac47d'
                        }

                        // Get category canvas
                        ctx = document.querySelector(`canvas[category-id="${category.id}"]`);
                        var myChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: [category.name],
                                datasets: [{
                                    label: '# of Votes',
                                    data: [category.percentage + 100, 100 - category.percentage],
                                    backgroundColor: [
                                        color,
                                        'rgba(220, 220, 220, 220)',
                                    ],
                                    borderColor: [
                                        color,
                                        'rgba(220, 220, 220, 220)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                rotation: 1 * Math.PI,
                                circumference: 1 * Math.PI
                            }
                        });
                    });

                    if(this.repository.qualification <= 0){
                        color = '#ff6384'
                    }else if(this.repository.qualification > 0 && this.repository.qualification <= 50){
                        color = '#f7b924'
                    }else{
                        color = '#3ac47d'
                    }

                    ctx = document.getElementById('repositoryQualification');
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Calificación del repositorio'],
                            datasets: [{
                                label: '# of Votes',
                                data: [parseFloat(this.repository.qualification) + 100, 100 - parseFloat(this.repository.qualification)],
                                backgroundColor: [
                                    color,
                                    'rgba(220, 220, 220, 220)',
                                ],
                                borderColor: [
                                    color,
                                    'rgba(220, 220, 220, 220)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            rotation: 1 * Math.PI,
                            circumference: 1 * Math.PI
                        }
                    });

                    datasets = _.map(this.categories, function(category){

                        questions = _.filter(category.questions, function(question){
                            return question.subcategory_id == 1
                        }) 

                        punctuations = _.map( questions, function(question){
                            return question.answer ? parseFloat(question.answer.choice.punctuation) : 0
                        } )

                        accesibilityPunctuation = _.sum(punctuations)

                        questions = _.filter(category.questions, function(question){
                            return question.subcategory_id == 2
                        }) 

                        punctuations = _.map( questions, function(question){
                            return question.answer ? parseFloat(question.answer.choice.punctuation) : 0
                        } )

                        preservationPunctuation = _.sum(punctuations)

                        red = Math.floor(Math.random() * 255 + 1);
                        green = Math.floor(Math.random() * 255 + 1);
                        blue = Math.floor(Math.random() * 255 + 1);

                        return {
                            label: [category.short_name],
                            backgroundColor: `rgba(${red},${green},${blue},0.2)`,
                            borderColor: `rgba(${red},${green},${blue},1)`,
                            data: [{
                                x: accesibilityPunctuation,
                                y: preservationPunctuation,
                                r: Math.abs(accesibilityPunctuation + preservationPunctuation) / 2
                            }]
                        }
                    })

                    // 
                    new Chart(document.getElementById("bubble-chart"), {
    type: 'bubble',
    data: {
      labels: "Africa",
      datasets
    },
    options: {
      title: {
        display: true,
        text: 'Análisis de riesgos y fortalezas del RI'
      }, scales: {

        // xAxes: [{
        //                     display: true,
        //                     scaleLabel: {
        //                         display: true,
        //                         labelString: 'Month'
        //                     }
        //                 }],
        //             yAxes: [{
        //                     display: true,
        //                     ticks: {
        //                         beginAtZero: true,
        //                         steps: 10,
        //                         stepValue: 5,
        //                         max: 100
        //                     }
        //                 }]

        yAxes: [{ 
          scaleLabel: {
            display: true,
            labelString: "Preservación",
            max: 110
          },
          ticks: {
                beginAtZero: true,
                // steps: 10,
                // stepValue: 5,
                max: 110
            }
        }],
        xAxes: [{ 
          scaleLabel: {
            display: true,
            labelString: "Accesibilidad",
          },
          ticks: {
                beginAtZero: true,
                // steps: 10,
                // stepValue: 5,
                max: 110
            }
        }]
      }
    }
});

                },

                
            }
        }

    </script>

</div>