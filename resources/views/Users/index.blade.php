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
        <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-user-alt"></i> Les Utilisateurs</a></li>
    </ol>
</nav>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h4>Liste des utilisateurs</h4>
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
                            <th>Description</th>
                            <th>Nombre de valeurs</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                       <tbody>
                           {{-- @foreach($domaineValeurs  as $key => $value)
                                   <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->libele}}</td>
                                            <td>{{$value->description}}</td>
                                            <td>{{$value->domaine_valeurs_elements->count()}}</td>
                                           <td>
                                               <div class="dropdown d-inline">
                                                   <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Options
                                                   </button>
                                                   <div class="dropdown-menu">
                                                       <a class="dropdown-item has-icon" href="{{route('domaine.show',$value)}}"><i class="fa fa-eye"></i> Voir details</a>
                                                       <a class="dropdown-item has-icon" href="#"><i class="fa fa-edit"></i> Edit</a>
                                                       @if($value->type !== '1')
                                                           <a class="dropdown-item has-icon" href=""><i class="fa fa-trash"></i> Supprimer</a>
                                                       @endif
                                                   </div>
                                               </div>
                                           </td>
                                   </tr>
                           @endforeach --}}
                       </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                    <h4>Ajouter un utilisateur</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('users.store')}}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" class="form-control"  name="firstname" placeholder="Entrez le Nom">
                    </div>
                    <div class="form-group">
                        <label>Prenom :</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Entrez le Prenom">
                    </div>
                    <div class="form-group">
                        <label>email :</label>
                        <input type="email" class="form-control" name="email" placeholder="Entrez le Email">
                    </div>
                    <div class="form-group">
                        <label>Photo de profile :</label>
                        <input type="file" class="form-control" name="profile_image" placeholder="Entrez la photo de profile">
                    </div>
                    <div class="form-group">
                        <label>Role :</label>
                        <select class="form-control" name="role" id="">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
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
@endsection
