<div class="mb-4" x-data="data()" x-init="mounted()">

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <canvas id="repositoryQualification"></canvas>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="widget-numbers mt-0 fsize-3">
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
                        <span percentage-id="{{$category->id}}">90%</span>
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
                            return question.answers ? parseFloat(question.answers[0].punctuation) : 0
                        })
                        category.punctuation = _.sum(punctuations)

                        // Set max punctuation to the category
                        max_punctuations = _.map(category.questions, function(question){
                            return parseFloat(question.max_punctuation)
                        })
                        category.max_punctuation = _.sum(max_punctuations)


                        category.percentage = category.punctuation / category.max_punctuation * 100

                        percentageSpan = document.querySelector(`span[percentage-id="${category.id}"]`);
                        percentageSpan.innerText = `${category.percentage}%`

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
                                labels: ['Calificación'],
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
                },
            }
        }

    </script>

</div>