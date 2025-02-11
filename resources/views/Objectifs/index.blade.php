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
                                <th>Code</th>
                                <th>Activites</th>
                                <th>Typologie</th>
                                <th>Valeur Cible</th>

                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Objectifs  as $key => $value)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->code}}</td>
                                    <td>{{$value->activites->libele}}</td>
                                    <td>{{$value->typologies->libele}}</td>

                                    <td>{{$value->valeur_cible}} {{$value->unite->libele}} / {{$value->periodicites->libele}}</td>

                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Options
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon" href="#" href="#"><i class="fa fa-edit"></i> Edit</a>
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
{{--        @dump($unites->domaine_valeurs_elements)--}}

        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4>Section d'ajout</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{route('objectifs.store')}}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Code : </label>
                            <input type="text" class="form-control" name="code" required placeholder="Entrez le code   ">
                        </div>
                        <div class="form-group">
                            <label>Activites </label>
                            <select class="form-control" required name="activite">
                                @foreach($activites->domaine_valeurs_elements as $key => $value)
                                    <option value="{{$value->id}}">{{ $value->libele }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Typologie </label>
                            <select class="form-control" required name="typologie">
                                @foreach($typologie->domaine_valeurs_elements as $key => $value)
                                    <option value="{{$value->id}}">{{ $value->libele }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valeur cible </label>
                            <div style="display: flex; gap: 10px;">
                                <input class="form-control" type="number" name="valeur_cible" style="flex: 2;">
                                <select class="form-control" required name="unites"  style="flex: 1;">
                                        @foreach($unites->domaine_valeurs_elements as $key => $value)
                                            <option value="{{$value->id}}">{{ $value->libele }}</option>
                                        @endforeach
                                </select>
                                <select class="form-control" required name="periodicite" style="flex: 1;">
                                    @foreach($periodicites->domaine_valeurs_elements as $key => $value)
                                        <option value="{{$value->id}}">{{ $value->libele }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Commentaire : </label>
                            <textarea type="text" class="form-control" name="commentaires" required placeholder="Entrez le commentaire"></textarea>
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
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
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
                        var url = "{{ route('objectifs.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        var xhr = new XMLHttpRequest();
                        xhr.open('DELETE', url);
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.onload = function() {
                            if (xhr.status === 200) {

                                var response = JSON.parse(xhr.responseText);
                                console.log(response);
                                if (response === 'ok') {
                                    iziToast.success({
                                        title: 'Succès !',
                                        message: "Operation Reussi !",
                                        position: 'topRight'
                                    });
                                    location.reload();
                                } else {
                                    iziToast.error({
                                        title: 'Erreur !',
                                        message: 'Une erreur est survenue',
                                        position: 'topRight'
                                    });
                                }
                            }
                        };
                        xhr.send();
                        // document.location.href = url;
                    } else {
                        iziToast.error({
                            title: 'Erreur !',
                            message: 'Une erreur est survenue',
                            position: 'topRight'
                        });
                    }
                });
        }

    </script>
@endsection


