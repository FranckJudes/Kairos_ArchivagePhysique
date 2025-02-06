@extends('Layout.main-layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> App</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Liste de valeurs</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Objectifs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Intitule</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($Objects  as $key => $value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->libele}}</td>
                                        <td>{{$value->description}}</td>

                                        <td>
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Options
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item has-icon" href="#" onclick="editObject('{{ json_encode($value) }}')">
                                                        <i class="fa fa-edit"></i> Modifier
                                                    </a>
                                                    <a class="dropdown-item has-icon"  onclick="show_delete_intervenant({{$value->id}})" href=""><i class="fa fa-trash"></i> Supprimer</a>
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

        {{-- Remplacez la colonne d'ajout existante par cette structure conditionnelle --}}
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ isset($Object) ? 'Section de modification' : 'Section d\'ajout' }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($Object) ? route('Objects.update', $Object->id) : route('Objects.store') }}">
                        @csrf
                        @if(isset($Object))
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif

                        <div class="form-group">
                            <label>Intitule : </label>
                            <input type="text"
                                   class="form-control"
                                   name="libele"
                                   required
                                   placeholder="Entrez le code"
                                   value="{{ isset($Object) ? $Object->libele : '' }}">
                        </div>

                        <div class="form-group">
                            <label>Description : </label>
                            <textarea type="text"
                                      class="form-control"
                                      name="description"
                                      required
                                      placeholder="Entrez la description">{{ isset($Object) ? $Object->description : '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" style="width: 100%">
                                {{ isset($Object) ? 'Modifier' : 'Enregistrer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'Object</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id">
                        <div class="form-group">
                            <label>Intitulé :</label>
                            <input type="text" class="form-control" id="edit_libele" name="libele">
                        </div>
                        <div class="form-group">
                            <label>Description :</label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script src="{{asset('assets/bundles/prism/prism.js')}}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        function show_delete_intervenant(id) {
            console.log(id)
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
    </script>

@endsection


