@extends('Layout.main-layout')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}">

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> App</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> ENregistrements de precenses</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Presences</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                               <tr>
                                <th class="text-center">Intervenant</th>
                                <th>Date</th>
                                <th>Absent/Present</th>
                                <th>Heure D'arrivee</th>
                                <th>Heure de depart</th>
                                <th>Action</th>
                               </tr>
                            </thead>
                            <tbody>
                                @foreach($presences as $presence)
                                    <tr>
                                        <td>{{ $presence->intervenant->firstname . ' ' . $presence->intervenant->lastname }}</td>
                                        <td>{{ $presence->date }}</td>
                                        <td>{{ $presence->presentOrAbsent == 0 ? 'Présent' : 'Absent' }}</td>
                                        <td>{{ $presence->heure_depart }}</td>
                                        <td>{{ $presence->heure_depart }}</td>
                                        <td>
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Options
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item has-icon" onclick="edit_user( {{$presence}})" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                        <a class="dropdown-item has-icon" onclick="show_delete_users({{ $presence->id }})" href="#">
                                                            <i class="fa fa-trash"></i> Supprimer
                                                        </a>

                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4>Section d'ajout de presences</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{route('presences.store')}}">
                        @csrf
                        @method('POST')

                        <!-- Sélection de l'Intervenant -->
                        <div class="form-group">
                            <label>Intervenant : </label>
                            <select class="form-control js-example-basic-single" required name="intervenant_id">
                                @foreach($intervenants as $key => $value)
                                    <option value="{{$value->id}}">{{ $value->firstname .' '. $value->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date du jour :</label>
                            <input type="date" class="form-control" name="date" value="{{ today()->format('Y-m-d') }}" required>
                        </div>
                        <!-- Choix du statut -->
                        <div class="form-group" >
                            <label>Status :</label><br>
                            <div class="pretty p-default p-round" >
                                <input type="radio" name="presentOrAbsent" value="0"  id="present" checked> <label>Présent</label>
                            </div>
                            <div class="pretty p-default p-round">
                                <input type="radio" name="presentOrAbsent" value="1" id="absent"> <label>Absent</label>
                            </div>

                        </div>

                        <!-- Section de Justification (Masquée par défaut) -->
                        <div class="form-group" id="justification_section" style="display: none;">
                            <label>Absence Justifier :</label><br>
                            <div class="pretty p-default p-round">
                                <input type="radio" name="justification" value="oui"> <label>Oui</label>
                            </div>
                            <div class="pretty p-default p-round">
                                <input type="radio" name="justification" value="non" checked> <label>Non</label>
                            </div>
                        </div>

                        <!-- Section Heure d'Arrivée / Départ (Visible si Présent) -->
                        <div id="heures_section">
                            <div class="form-group">
                                <label>Heure d'arrivée :</label>
                                <input type="time" class="form-control" name="heure_arrivee" required>
                            </div>
                            <div class="form-group">
                                <label>Heure de départ :</label>
                                <input type="time" class="form-control" name="heure_depart" required>
                            </div>
                        </div>

                        <!-- Bouton Enregistrer -->
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" style="width: 100%">Enregistrer</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>



    </div>


@endsection
@section('scripts')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/page/datatables.js') }}"></script>
    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/bundles/prism/prism.js')}}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Initialiser Select2
            $('.js-example-basic-single').select2({
                placeholder: "Sélectionnez l'intervenant",
                width: '100%'
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const presentRadio = document.querySelector('input[name="presentOrAbsent"][value="0"]');
            const absentRadio = document.querySelector('input[name="presentOrAbsent"][value="1"]');
            const justificationSection = document.getElementById("justification_section");
            const heuresSection = document.getElementById("heures_section");
            const justificationRadios = document.querySelectorAll('input[name="justification"]');
            const heureArrivee = document.querySelector('input[name="heure_arrivee"]');
            const heureDepart = document.querySelector('input[name="heure_depart"]');

            function toggleFields() {
                if (presentRadio.checked) {
                    justificationSection.style.display = "none";
                    heuresSection.style.display = "block";

                    // Désactiver la justification
                    justificationRadios.forEach(radio => {
                        radio.disabled = true;
                    });

                    // Activer les heures
                    heureArrivee.required = true;
                    heureDepart.required = true;
                    heureArrivee.disabled = false;
                    heureDepart.disabled = false;

                } else {
                    justificationSection.style.display = "block";
                    heuresSection.style.display = "none";

                    // Activer la justification
                    justificationRadios.forEach(radio => {
                        radio.disabled = false;
                    });

                    // Désactiver les heures
                    heureArrivee.required = false;
                    heureDepart.required = false;
                    heureArrivee.disabled = true;
                    heureDepart.disabled = true;
                }
            }

            // Écouteurs d'événements
            presentRadio.addEventListener("change", toggleFields);
            absentRadio.addEventListener("change", toggleFields);

            // Vérification au chargement de la page
            toggleFields();
        });

        function show_delete_users(id) {
            event.preventDefault();
            swal({
                title: 'Attention !',
                text: 'Voulez-vous vraiment supprimer cet utilisateur ?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    const url = "{{ route('presences.destroy', ':id') }}".replace(':id', id);
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            swal('Erreur', 'Une erreur est survenue', 'error');
                        }
                    });
                }
            });
        }
    </script>

@endsection


