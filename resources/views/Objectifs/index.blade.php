@extends('Layout.main-layout')
@section('styles')
    <link rel="{{asset('stylesheet" href="assets/bundles/datatables/datatables.min.css')}}">
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
                                <th>Matricule</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Sexe</th>
                                <th>Fonction</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
{{--                            @foreach($intervenants  as $key => $value)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$key+1}}</td>--}}
{{--                                    <td>{{$value->matricule}}</td>--}}
{{--                                    <td>{{$value->lastname}}</td>--}}
{{--                                    <td>{{$value->firstname}}</td>--}}
{{--                                    <td>{{$value->sex}}</td>--}}
{{--                                    <td>{{$value->domaineElement->libele}}</td>--}}
{{--                                    <td>--}}
{{--                                        <div class="dropdown d-inline">--}}
{{--                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"--}}
{{--                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                Options--}}
{{--                                            </button>--}}
{{--                                            <div class="dropdown-menu">--}}
{{--                                                <a class="dropdown-item has-icon" ><i class="fa fa-eye"></i> Voir details</a>--}}
{{--                                                <a class="dropdown-item has-icon" href="{{route('intervenants.show',$value)}}" href="#"><i class="fa fa-edit"></i> Edit</a>--}}
{{--                                                <a class="dropdown-item has-icon"  onclick="show_delete_intervenant({{json_encode($value)}})" href=""><i class="fa fa-trash"></i> Supprimer</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4>Section d'ajout</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{route('intervenants.store')}}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Code : </label>
                            <input type="text" class="form-control" name="matricule" required placeholder="Entrez le code   ">
                        </div>
                        <div class="form-group">
                            <label>Activites </label>
                            <select class="form-control" required name="fonction">

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Typologie </label>
                            <select class="form-control" required name="fonction">

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Objectifs </label>
                            <select class="form-control" required name="fonction">

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Commentaire : </label>
                            <textarea type="text" class="form-control" name="matricule" required placeholder="Entrez le commentaire"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" style="width: 100%">Enregister</button>
                        </div>

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
        document.getElementById('toggle-additional-fields').addEventListener('click', function() {
            var additionalFields = document.querySelector('.additional-fields');
            if (additionalFields.style.display === 'none') {
                additionalFields.style.display = 'block';
                this.textContent = 'Moins';
            } else {
                additionalFields.style.display = 'none';
                this.textContent = 'Plus';
            }
        });

        function show_delete_intervenant(id) {
            console.log(id)
            event.preventDefault();
            swal({
                title: '{{ __('message._are_you_sure_you_want_to_delete') }}'
                , text: '{{ __('message._once_deleted') }}'
                , icon: 'warning'
                , buttons: true
                , dangerMode: true
                , })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{ route('intervenants.destroy', ':id') }}";
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
@endsection


