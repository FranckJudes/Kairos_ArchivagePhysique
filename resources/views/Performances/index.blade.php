@extends('Layout.main-layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}">

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> App</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Performances </a></li>
        </ol>
    </nav>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Enregistrement des performances :</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store_performance_intervenants') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Intervenant : </label>
                                    <select class="select2-perf form-control"  name="intervenant"  onchange="change_intervenant(this)" >
                                        @foreach($intervenant as $item)
                                            <option value=" {{ $item->id }}"> {{ $item->firstname }} - {{ $item->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date :</label>
                                    <input type="date" class="form-control datepicker" name="date_performance" id="datepicker" />
                                </div>
                            </div>
                            <div class="col-4">

                                <div class="form-group " id="form-activities">
                                    <label>Activites : </label>
                                    <select class="form-control select2-activites" name="activites" onchange="get_objectifi_activities(this)" id="activites-container">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Performance : </label>
                                    <textarea class="form-control" name="performance_value" id="text_area_"></textarea>

                                    <p> <span style="color: red; display: flex; justify-content: flex-end;" id="span_val"></span></p>
                                </div>
                                <div class="form-group">
                                    <button  style="width: 100%" type="submit" class="btn btn-primary"> Sauvegarder</button>
                                </div>
                            </div>
                            <div class="col-4">

                                <div class="form-group"  id="typologie_documentaire">
                                    <label>Object :</label>
                                    <select id="typologie_" class="form-control select2-object" name="object" onchange="activity_change(this)">

                                    </select>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header" style="display: flex;justify-content: space-between">
                    <h4>Performances</h4>
                    <div class="">
                        <select id="periode-select" class="form-control">
                            <option value="journaliere">Journalière</option>
                            <option value="Semaine">Semaine</option>
                            <option value="Mensuelle">Mensuelle</option>
                            <option value="Trimestre">Trimestre</option>
                            <option value="Semestre">Semestre</option>
                            <option value="Annuelle">Annuelle</option>
                        </select>
                    </div>
                </div>



                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport_performances">
                            <thead>
                            <tr>
                                <th class="text-center">Intervenant</th>
                                <th class="text-center">Activité</th>
                                <th class="text-center">Performance</th>
                                <th class="text-center">Objectif Cible</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>

    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script src="{{asset('assets/bundles/prism/prism.js')}}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/jszip.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script>
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            });
            $( "#datepicker" ).datepicker({
                inline: true
            });

        });


        $(document).ready(function() {
            $('.select2-perf').select2({
                width: '100%',
                height:'100px'
            });
            $('.select2-object').select2({
                width: '100%',
                height:'100px'
            });
            $('.select2-objectif').select2({
                width: '100%',
                height:'100px'
            });
            $('.select2-activites').select2({
                placeholder: "Sélectionnez l'activites : ",
                width: '100%',
                height:'100px'
            });
            $('.select2-day').select2({
                placeholder: "Sélectionnez le jour : ",
                width: '100%',
                height:'100px'
            });


        });
        $(document).ready(function() {
            // Définir la période par défaut sur 'journaliere'
            let defaultPeriode = 'journaliere';

            let table = $('#tableExport_performances').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('performances.all') }}",
                    data: function(d) {
                        d.periode = $('#periode-select').val() || defaultPeriode; // Utiliser la période sélectionnée ou 'journaliere' par défaut
                    }
                },
                columns: [
                    { data: 'intervenant', name: 'intervenant', className: 'text-center' },
                    { data: 'activite', name: 'activite', className: 'text-center' },
                    { data: 'total_performance', name: 'total_performance', className: 'text-center' },
                    { data: 'objectif_cible', name: 'objectif_cible', className: 'text-center' }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                initComplete: function() {
                    // Sélectionner 'journaliere' par défaut dans le select
                    $('#periode-select').val(defaultPeriode).trigger('change');
                }
            });

            // Recharger la table lorsqu'on change la période
            $('#periode-select').change(function() {
                table.ajax.reload();
            });
        });






        function show_delete_intervenant(id) {
            event.preventDefault();
            swal({
                title: 'Attention !'
                , text: 'Voulez-vous vraiment supprime ??'
                , icon: 'warning'
                , buttons: true
                , dangerMode: true
                , })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{ route('Objects.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        var xhr = new XMLHttpRequest();
                        xhr.open('DELETE', url);
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.onload = function() {
                            if (xhr.status === 200) {

                                var response = JSON.parse(xhr.responseText);
                                console.log(response);
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
                        iziToast.error({
                            title: '{{ __('message._error') }} !'
                            , message: '{{ __('message._canceled') }}'
                            , position: 'topRight'
                        });
                    }
                });
        }

    </script>
    <script>
        function editObject(data1) {
            const data = JSON.parse(data1);

            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_libele').value = data.libele;
            document.getElementById('edit_description').value = data.description;
            $('#editModal').modal('show');
        }
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#edit_id').val();

            $.ajax({
                url: "{{ url('Objects') }}/" + id,
                type: 'PUT',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'libele': $('#edit_libele').val(),
                    'description': $('#edit_description').val()
                },
                success: function(response) {
                    console.log(response);
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


        function change_intervenant(id){

            var id = id.value;

            $.ajax({
                url: "{{ url('get_activite_for_single_intervenant') }}/" + id,
                type: 'GET',
                success: function(response) {
                    var html = '';

                    // if (response.data && Array.isArray(response.data)) {
                    //     response.data.forEach(function(data, index) {
                    //         html += `
                    //             <div class="custom-control custom-radio">
                    //                 <input type="radio"
                    //                        class="custom-control-input"
                    //                        id="customRadio${index}"
                    //                        name="activites[]"
                    //                        value="${data.id}" onchange="get_objectifi_activities(this)">
                    //                 <label class="custom-control-label"
                    //                        for="customRadio${index}">
                    //                     ${data.libele}
                    //                 </label>
                    //             </div>`;
                    //     });
                    // }
                    if (response.data && Array.isArray(response.data)) {
                        response.data.forEach(function(data, index) {
                            html += `
                                <option value="${data.id}"> ${data.libele}</option>
                               `;
                        });
                    }
                    $('#activites-container').html(html);
                    $('#form-activities').css('display','block');


                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function get_objectifi_activities(id) {
            const id_value = id.value;
            $.ajax({
                url: "{{ url('get_objectifi_activities') }}/" + id_value,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var html_typologie = '';

                    if (response.data && Array.isArray(response.data)) {
                        if (response.data.length > 0) {

                            response.data.forEach(function(data) {
                                html_typologie += `
                            <option value="${data.typologies.id}">
                                ${data.typologies.libele}  </option>
                        `;

                            });

                        } else {
                            html_typologie = '<option value="">Aucune typologie disponible</option>'; // Make sure it's an option element
                        }
                    } else {
                        html_typologie = '<option value="">Aucune Typologie trouvée</option>'; // Make sure it's an option element
                    }

                    $('#typologie_').html(html_typologie); // Use .html() for select elements
                    $('#typologie_').trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('Erreur de chargement des objectifs:', error);
                    $('#objectif_temps').html('<option value="">Erreur de chargement</option>');
                    $('#typologie_').html('<option value="">Erreur de chargement</option>'); // Use .html() here too
                }
            });
        }

        function activity_change(id){
                $.ajax({
                    url: "{{ url('get_objection_value') }}/" + id.value,
                    type: 'GET',
                    success: function(response) {
                        $("#span_val").html(response.html);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $("#span_val").html('');
                    }
                });

        }
    </script>

@endsection


