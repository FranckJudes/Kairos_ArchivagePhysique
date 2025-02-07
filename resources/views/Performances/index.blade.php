@extends('Layout.main-layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Intervenant : </label>
                                <select class="select2-perf form-control"   onchange="change_intervenant(this)" >
                                    @foreach($intervenants as $item)
                                        <option value=" {{ $item->id }}"> {{ $item->firstname }} - {{ $item->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date :</label>
                                <input type="text" class="form-control" name="birthday" id="input_date_" />

                            </div>
                        </div>
                        <div class="col-4">

                            <div class="form-group " id="form-activities">
                                <label>Activites : </label>
                                <select class="form-control select2-activites" onchange="get_objectifi_activities(this)" id="activites-container">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Performance : </label>
                                <textarea class="form-control" id="text_area_"></textarea>

                                <p> <span style="color: red; display: flex; justify-content: flex-end;" id="span_val"></span></p>
                            </div>
                            <div class="form-group">
                                    <button  style="width: 100%" type="submit" class="btn btn-primary"> Sauvegarder</button>
                            </div>
                        </div>
                        <div class="col-4">

                            <div class="form-group"  id="typologie_documentaire">
                                <label>Object :</label>
                                <select id="typologie_" class="form-control select2-object" onchange="activity_change(this)">

                                </select>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label>Objectifs</label>--}}
{{--                                <select class="form-control select2-objectif" id="objectif_temps"  disabled id="activites-container">--}}

{{--                                </select>--}}
{{--                            </div>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header" style="display: flex;justify-content: space-between">
                    <h4>Performances</h4>
                    <div class="">
                       <select class="form-control .select2-day">
                           <option>journaliere</option>
                           <option>Semaine</option>
                           <option>Mensuelle</option>
                           <option>Trimestre</option>
                           <option>Semestre</option>
                           <option>Annuelle</option>
                       </select>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        Intervenant
                                    </th>
                                    <th>Intitule</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($intervenants as $item)

                                <tr>
                                        <td>{{$item->firstname}}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script src="{{asset('assets/bundles/prism/prism.js')}}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
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
                            <option value="${data.id}">
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


