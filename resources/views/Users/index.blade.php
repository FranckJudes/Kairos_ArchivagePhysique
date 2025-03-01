@extends('Layout.main-layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/prism/prism.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> App</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-user-alt"></i> Les Utilisateurs</a></li>
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
                                    <th class="text-center">#</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->firstname }}</td>
                                        <td>{{ $value->lastname }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->role }}</td>
                                        <td>
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Options
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item has-icon" onclick="edit_user( {{$value}})" href="#">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    @if($value->type !== '1')
                                                        <a class="dropdown-item has-icon" onclick="show_delete_users({{ $value->id }})" href="#">
                                                            <i class="fa fa-trash"></i> Supprimer
                                                        </a>
                                                    @endif
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
                    <h4>Ajouter un utilisateur</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nom :</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Entrez le Nom" required>
                        </div>
                        <div class="form-group">
                            <label>Prenom :</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Entrez le Prenom" required>
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" class="form-control" name="email" placeholder="Entrez le Email" required>
                        </div>
                        <div class="form-group">
                            <label>Photo de profile :</label>
                            <input type="file" class="form-control" accept="image/jpeg, image/jpg, image/png" name="profile_image">
                        </div>
                        <div class="form-group">
                            <label>Role :</label>
                            <select class="form-control" name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" style="width: 100%">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'édition -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nom :</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Entrez le Nom" required>
                        </div>
                        <div class="form-group">
                            <label>Prenom :</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Entrez le Prenom" required>
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" class="form-control" name="email" placeholder="Entrez le Email" required>
                        </div>
                        <div class="form-group">
                            <label>Photo de profile :</label>
                            <input type="file" class="form-control" accept="image/jpeg, image/jpg, image/png" name="profile_image">
                        </div>
                        <div class="form-group">
                            <label>Role :</label>
                            <select class="form-control" name="role" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" style="width: 100%">Modifier</button>
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
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        function edit_user(data) {
            const form = document.getElementById('editForm');
            form.action = "{{ route('users.update', ':id') }}".replace(':id', data.id);
            form.querySelector('input[name="firstname"]').value = data.firstname;
            form.querySelector('input[name="lastname"]').value = data.lastname;
            form.querySelector('input[name="email"]').value = data.email;
            form.querySelector('select[name="role"]').value = data.role;
            $('#editModal').modal('show');
        }

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
                    const url = "{{ route('users.destroy', ':id') }}".replace(':id', id);
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
