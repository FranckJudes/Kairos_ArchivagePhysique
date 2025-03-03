@extends('Layout.main-layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <div class="mb-4">
        <h4>Welcome {{Auth::user()->firstname . ' '. Auth::user()->lastname }} !</h4>
        {{-- <small>Measure How Fast You’re Growing Monthly Recurring Revenue. <a href="#">Learn More</a></small> --}}
    </div>
    <div class="row ">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card p-3">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15"> Intervenants</h5>
                                    <h2 class="mb-3 font-18">{{$breIntervenant->count()}}</h2>
                                    {{-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="assets/img/banner/1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card p-3">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">  Activites</h5>
                                    <h2 class="mb-3 font-18">{{$brActivites->domaine_valeurs_elements->count()}}</h2>
                                    {{-- <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="assets/img/banner/2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card p-3">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Objectifs</h5>
                                    <h2 class="mb-3 font-18">{{$brObjectifs}}</h2>
                                    {{-- <p class="mb-0"><span class="col-green">18%</span>
                                        Increase</p> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="assets/img/banner/3.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card p-3">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ml-2">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Objects</h5>
                                    <h2 class="mb-3 font-18">{{$Objects->domaine_valeurs_elements->count()}}</h2>
                                    <p class="mb-0"><span class="col-green"></span></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="assets/img/banner/4.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="container row" style="margin-top: 40px;">
            <div class="col-lg-4">
                <h4>Statistiques : </h4>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Intervenant</label>
                    <select class="form-control js-example-basic-single" id="intervenants" multiple>
                        @foreach($breIntervenant as $item)
                            <option value="{{$item->id}}">{{$item->firstname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Periodicite</label>
                    <select class="form-control js-example-basic-single" style="padding: 20px;" id="periode">
                        <option value="journaliere">Journalière</option>
                        <option value="Semaine">Semaine</option>
                        <option value="Mensuelle">Mensuelle</option>
                        <option value="Trimestre">Trimestre</option>
                        <option value="Semestre">Semestre</option>
                        <option value="Annuelle">Annuelle</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-body">
                            <canvas id="barChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-body">
                            <canvas id="lineChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="radarChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts')
    <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/chart.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Sélectionnez l'intervenant",
                width: '100%'
            });

            let barChart, lineChart, radarChart;

            function fetchData(periode, intervenants) {
                fetch(`/get_peformance_user_chart?periode=${periode}&intervenants=${intervenants.join(',')}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur réseau');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const labels = data.map(item => item.intervenant + ' - ' + item.activite);
                        const performanceData = data.map(item => item.total_performance);
                        const targetData = data.map(item => item.objectif_cible);

                        // Détruire les anciens graphiques s'ils existent
                        if (barChart) barChart.destroy();
                        if (lineChart) lineChart.destroy();
                        if (radarChart) radarChart.destroy();

                        // Graphique en barres
                        const barCtx = document.getElementById('barChart').getContext('2d');
                        barChart = new Chart(barCtx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Performance',
                                    data: performanceData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Objectif Cible',
                                    data: targetData,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });

                        // Graphique en ligne
                        const lineCtx = document.getElementById('lineChart').getContext('2d');
                        lineChart = new Chart(lineCtx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Performance',
                                    data: performanceData,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    fill: false
                                }, {
                                    label: 'Objectif Cible',
                                    data: targetData,
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    fill: false
                                }]
                            },
                            options: {
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });

                        // Graphique combiné (bar + line)
                        const radarCtx = document.getElementById('radarChart').getContext('2d');
                        radarChart = new Chart(radarCtx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    type: 'bar',
                                    label: 'Performance',
                                    data: performanceData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }, {
                                    type: 'line',
                                    label: 'Objectif Cible',
                                    data: targetData,
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    fill: false
                                }]
                            },
                            options: {
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des données :', error);
                    });
            }


            $('#periode').on('change', function() {
                const periode = $('#periode').val();
                const intervenants = $('#intervenants').val();
                fetchData(periode, intervenants);
            });

            $('#intervenants').on('change', function() {
                const periode = document.getElementById('periode').value;
                const intervenants = $(this).val();
                fetchData(periode, intervenants);
            });

            // Charger les données initiales avec tous les intervenants
            const allIntervenants = Array.from(document.getElementById('intervenants').options)
                .map(option => option.value);
            fetchData('journaliere', allIntervenants);
        });
    </script>
@endsection
