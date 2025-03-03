@extends('Layout.main-layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="{{route('dashboard.index')}}" style="color: white"><i class="fas fa-tachometer-alt"></i>&nbsp; Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-cog"></i>&nbsp; App</a></li>
            <li class="breadcrumb-item" ><a href="{{route('domaine.index')}}" style="color: white"><i class="fas fa-coins"></i>&nbsp; Domaine de valeurs</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-align-center"                ></i>&nbsp; Liste des valeurs</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des valeurs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Libelle</th>
                                <th>description</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($domaineValeursElements->domaine_valeurs_elements  as $key => $value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->libele}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>
                                        <a class="btn btn-danger" onclick="show_delete_users({{$value->id}})"><i class="fa fa-trash"></i> Supprimer</a>
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
                    <h4>Section d'ajout</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('domaineElement.store')}}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Libelle </label>
                            <input type="text" class="form-control" name="libele" placeholder="Entrez le libelle">
                            <input type="hidden"  name="id_domaine" value="{{$domaineValeursElements->id}}" placeholder="Entrez le libelle">
                        </div>
                        <div class="form-group">
                            <label>Description </label>
                            <textarea class="form-control" name="description" placeholder="Entrez la description"></textarea>
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

        function show_delete_users(id) {
            event.preventDefault();
            swal({
                title: 'Attention !',
                text: 'Voulez-vous vraiment supprimer cette valeur ?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    const url = "{{ route('domaineElement.destroy', ':id') }}".replace(':id', id);
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


