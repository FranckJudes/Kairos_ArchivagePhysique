@extends('Layout.main-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/jquery-ui.css') }}" />
    <link rel="{{asset('stylesheet" href="assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <style>
        /* Style pour fixer l'en-tête du tableau */
        #table-1 {
            border-collapse: collapse;
            width: 100%;
            position: relative;
        }

        #table-1 thead tr {
            position: sticky;
            top: 0;
            background: white; /* Assure la visibilité */
            z-index: 10;
        }

        /* Fixer la première colonne */
        #table-1 tbody tr td:first-child,
        #table-1 thead tr th:first-child {
            position: sticky;
            left: 0;
            background: white; /* Assure la visibilité */
            z-index: 5;
        }

        /* Ajout d'un effet d'ombre pour une meilleure visibilité */
        #table-1 thead tr th {
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        #table-1 tbody tr td:first-child {
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
        }

        /* Ajout d'un overflow si le tableau est grand */
        .table-container {
            max-height: 400px; /* Ajuste selon le besoin */
            overflow: auto;
            position: relative;
        }

    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="{{route('dashboard.index')}}" style="color: white"><i class="fas fa-tachometer-alt"></i>&nbsp; Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-cog"></i>&nbsp; App</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="far fa-calendar-alt"></i> &nbsp;Gestion des jours fériés</a></li>
        </ol>
    </nav>
    <div class="row text-center">
        <div class="col-md-3">  <div class="card">
                <div class="card-header">
                    <h4 class="demoHeaders">Calendrier</h4>
                </div>
                <div class="card-body d-flex flex-column align-items-center">
                    <form id="dateForm" action="{{ route('planification.store') }}" method="POST">
                        @csrf
                        <div id="datepicker" style="width: 100%;"></div>
                        <input type="hidden" name="date" id="dateInput">
                        <div class="form-group">
                                <label></label>
                            <input type="text" class="form-control" name="nom" placeholder="Nom du jour ferie">
                        </div>
                        <div id="selectedDate"  style="color: lightskyblue; font-weight: bold;" class="text-lightskyblue mt-2 text-center"></div> <button type="submit" class="btn btn-primary w-100 mt-2">Enregistrer</button>
                     </form>
                </div>
            </div>
        </div>

        <div class="col-md-9"> <div class="card">
                <div class="card-header">
                    <h4>Jours fériés</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-container">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Libelle</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($joursFeries as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $value->nom }}</td>
                                        <td class="text-center">{{  date('d-m-Y', strtotime($value->date))  }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-danger" href="#" onclick="show_delete_ferrier_jours({{ $value->id }})">
                                                <i class="fa fa-trash"></i> Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>

    <script>
        $("#datepicker").datepicker({
            inline: true,
            dateFormat: "mm-dd-yy",
            onSelect: function (dateText) {
                $("#selectedDate").text(dateText); // Afficher la date choisie
                $("#dateInput").val(dateText); // Mettre la date dans l'input caché
            }
        });

        function show_delete_ferrier_jours(id) {
            console.log(id)
            event.preventDefault();
            swal({
                title: 'Attention !'
                , text: 'Voulez-vous vraiment supprimer'
                , icon: 'warning'
                , buttons: true
                , dangerMode: true
                , })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{ route('planification.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        var xhr = new XMLHttpRequest();
                        xhr.open('DELETE', url);
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response === 'ok') {
                                    location.reload();
                                } else {
                                    location.reload();
                                }
                            }
                        };
                        xhr.send();
                        // document.location.href = url;
                    } else {

                    }
                });
        }



    </script>
@endsection
