@extends('Layout.main-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/prism/prism.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="{{route('dashboard.index')}}" style="color: white"><i class="fas fa-tachometer-alt"></i>&nbsp; Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-cog"></i>&nbsp; App</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-sitemap"></i>&nbsp; Organigramme</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-chalkboard-teacher"></i>&nbsp; Poste de Travail</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Intervenants</h4>
                </div>


                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Liste des postes de Travail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Liste des fiches de posts</a>
                        </li>
                    </ul>


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <!-- Table des postes de travail -->
                                <div class="col-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Liste des Postes de Travail</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>Code</th>
                                                            <th>Intitulé</th>
                                                            <th>Description</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($posts as $key => $value)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $value->code }}</td>
                                                                <td>{{ $value->intitule }}</td>
                                                                <td>{{ $value->description }}</td>
                                                                <td>
                                                                    <div class="dropdown d-inline">
                                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                                            Options
                                                                        </button>
                                                                        {{-- <div class="dropdown-menu">
                                                                            <a class="dropdown-item has-icon" href="#" onclick="edit_post({{ $value }})">
                                                                                <i class="fa fa-edit"></i> Modifier
                                                                            </a>
                                                                            <a class="dropdown-item has-icon" href="#" onclick="show_delete_users({{ $value->id }})">
                                                                                <i class="fa fa-trash"></i> Supprimer
                                                                            </a>
                                                                            <a class="dropdown-item has-icon" href="#">
                                                                                <i class="fa fa-eye"></i> Fiche de poste
                                                                            </a>
                                                                        </div> --}}
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item has-icon" href="#" onclick="edit_post({{ $value }})" href="#"><i class="fa fa-edit"></i> Modifier</a>
                                                                            <a class="dropdown-item has-icon" href="#" onclick="show_delete_users({{ $value->id }})"><i class="fa fa-edit"></i> Edit</a>
                                                                            <a class="dropdown-item has-icon" href="{{route('post_travail.show',$value->id)}}">
                                                                                <i class="fa fa-eye"></i> Fiche de poste
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

                                <!-- Formulaire d'ajout -->
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Ajouter un Poste de Travail</h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('postWork.store') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Entité :</label>
                                                    <input type="text" class="form-control" disabled value="{{ $entite->libele }}">
                                                    <input type="hidden" name="entite_id" value="{{ $entite->id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Code :</label>
                                                    <input type="text" class="form-control" name="code" placeholder="Entrez le code" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Intitulé :</label>
                                                    <input type="text" class="form-control" name="intitule" placeholder="Entrez l'intitulé" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description :</label>
                                                    <input type="text" class="form-control" name="description" placeholder="Entrez la description" required>
                                                </div>
                                                <button class="btn btn-primary" style="width: 100%">Enregistrer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal de mise à jour -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('postWork.update', ':id') }}" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le Poste de Travail</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label>Code :</label>
                            <input type="text" class="form-control" name="code" id="edit_code" required>
                        </div>
                        <div class="form-group">
                            <label>Intitulé :</label>
                            <input type="text" class="form-control" name="intitule" id="edit_intitule" required>
                        </div>
                        <div class="form-group">
                            <label>Description :</label>
                            <input type="text" class="form-control" name="description" id="edit_description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/js/page/datatables.js') }}"></script>

    <script>
        function show_delete_users(id) {
            event.preventDefault();
            swal({
                title: 'Attention !',
                text: 'Voulez-vous vraiment supprimer ce poste ?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    const url = "{{ route('postWork.destroy', ':id') }}".replace(':id', id);
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    }).then(response => {
                        console.log(response);

                        if (response.ok) {
                            iziToast.success({
                                        title: 'Succès !',
                                        message: "Operation Reussi !",
                                        position: 'topRight'
                                    });
                            location.reload();
                        } else {
                            swal('Erreur', 'Une erreur est survenue', 'error');
                            iziToast.error({
                                        title: 'Erreur !',
                                        message: 'Une erreur est survenue',
                                        position: 'topRight'
                                    });
                        }
                    });
                }
            });
        }

        function edit_post(post) {
            $('#edit_id').val(post.id);
            $('#edit_code').val(post.code);
            $('#edit_intitule').val(post.intitule);
            $('#edit_description').val(post.description);

            let url = "{{ route('postWork.update', ':id') }}".replace(':id', post.id);
            $('#editForm').attr('action', url);

            $('#editModal').modal('show');
        }
    </script>
@endsection
