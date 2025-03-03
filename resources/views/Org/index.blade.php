@extends('Layout.main-layout')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/ztree/zTreeStyle/zTreeStyle.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/css/ztree/awesomeStyle/awesomeStyle.css')}}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="{{route('dashboard.index')}}" style="color: white"><i class="fas fa-tachometer-alt"></i>&nbsp; Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-cog"></i>&nbsp; App</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-sitemap"></i>&nbsp; Organigramme</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Organigramme Hiérarchique</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Entités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Types d'entités</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="pt-2">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="card">
                                            <div class="card-header" style="display: flex;justify-content: space-between">
                                                <h4>({{ $num }}) Entité(s)</h4>
                                                <div class="card-header-action" style="display: flex;justify-content: space-between">
                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add_entityModal_Entite">
                                                        Ajouter
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <style>
                                                    .ztree>li>a>span {
                                                        font-size: 15px;
                                                        font-family: "Nunito", "Segoe UI", arial;
                                                    }
                                                </style>
                                                <ul id="fileplanTree" class="ztree" style="font-size: 20px"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card" id="mycard" style="display: none;">
                                            <div class="card-header">
                                                <h4>Détails de l'entité</h4>
                                            </div>
                                            <div class="card-body" id="mybody_card"></div>
                                            <div class="card-footer bg-whitesmoke" id="footery"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row pt-2">
                                <div class="col-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Types d'entités</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="tableExport_type_entity">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Numéro</th>
                                                            <th class="text-center">Libellé</th>
                                                            <th>Description</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Rows will be populated here -->
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
                                            <form method="POST" class="form-horizontal" novalidate="novalidate" action="{{ route('entity.store') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="control-label" for="libele">Libellé *</label>
                                                    <div class="mb-2">
                                                        <input type="text" class="form-control" id="libele_type_doc" name="libele" placeholder="Libellé" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="description">Description *</label>
                                                    <div class="mb-2">
                                                        <input type="text" class="form-control" id="description_doc" name="description" placeholder="Description" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" onclick="createTypeEntity()" class="btn btn-success" name="signup1" value="Sign up" style="margin-top: 10px;">Créer un type</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="add_entityModal_Entite" tabindex="-1" aria-labelledby="add_entityexampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_entityexampleModalLabel">Ajouter une entité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" class="form-horizontal" novalidate="novalidate" action="{{ route('entity.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="control-label" for="code">Code *</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="name_" name="code" placeholder="Code *" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="libele">Libellé *</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="libele_entity" name="libele" placeholder="Libellé" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description *</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="description_entity" name="description" placeholder="Description" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="type">Type *</label>
                            <div class="mb-2">
                                <select class="form-control" id="type_entity" name="type">
                                    @foreach ($type as $ty)
                                        <option value="{{ $ty->id }}">{{ $ty->libele }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="control-label" for="type">Fonction *</label>
                            <div class="mb-2">
                                <select class="form-control" id="fonction_archive_update" name="fonction_archive">
                                    <option value="2">Production</option>
                                    <option value="3">Service versant</option>
                                    <option value="4">Service d'archivage</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group modal-footer">
                            <button type="button" onclick="create_entity_store()" class="btn btn-success" name="signup1" value="Sign up" style="margin-top: 10px;">Créer une entité</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="add_my_child_entity" tabindex="-1" aria-labelledby="add_entitychildexampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_entitychildexampleModalLabel">Ajouter une sous-entité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" class="form-horizontal" novalidate="novalidate" action="{{ route('store_subentity') }}" enctype="multipart/form-data">
                        @csrf
                        <p id="add_parent_subentity"></p>

                        <input type="hidden" id="add_parent_id_sub_elt" value="">
                        <div class="form-group">
                            <label class="control-label" for="parent">Parent </label>
                            <div class="mb-2">
                                <input type="hidden" class="form-control" id="parent_for_sub_entity" name="parent_for_sub_entity">
                                <input type="text" class="form-control" id="parent_first_" name="parent_first" placeholder="Parent *" required disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="code">Code *</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="name__" name="code" placeholder="Code *" required>
                                <p id="message2" style="color: red;"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="libele">Libellé *</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="libele__up_" name="libele" placeholder="Libellé" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description *</label>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="description__up" name="description" placeholder="Description" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="type">Type *</label>
                            <div class="mb-2">
                                <select class="form-control" id="__type_sub" name="type">
                                    @foreach ($type as $ty)
                                        <option value="{{ $ty->id }}">{{ $ty->libele }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type">Fonction *</label>
                            <div class="mb-2">
                                <select class="form-control" id="__fonct_archi_" name="fonction_archive">
                                    <option value="1">Service de contrôle</option>
                                    <option value="2">Production</option>
                                    <option value="3">Service versant</option>
                                    <option value="4">Service d'archivage</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group modal-footer">
                            <button type="button" onclick="create_subentity_store()" class="btn btn-success" name="signup1" value="Sign up" style="margin-top: 10px;">Créer une sous-entité</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/ztree/jquery.ztree.core.min.js') }}"></script>
<script src="{{ asset('assets/js/ztree/jquery.ztree.excheck.min.js') }}"></script>
<script src="{{ asset('assets/js/ztree/jquery.ztree.exedit.min.js') }}"></script>
<script src="{{ asset('assets/js/ztree/jquery.ztree.exhide.min.js') }}"></script>
<script src="{{ asset('assets/js/ztree/jquery.ztree.all.min.js') }}"></script>
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
    function createTypeEntity() {
        const data = {
            libele: $('#libele_type_doc').val(),
            description: $('#description_doc').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: "{{ route('type_entity.store') }}",
            type: "POST",
            data: data,
            success: function(response) {
                if (response.msg === "success") {
                    iziToast.success({
                        title: 'Succès',
                        message: 'Type d\'entité créé avec succès',
                        position: 'topRight'
                    });
                    load_file_schemes();
                    $('#libele_type_doc').val('');
                    $('#description_doc').val('');
                } else {
                    iziToast.error({
                        title: 'Erreur',
                        message: response.message || 'Une erreur est survenue',
                        position: 'topRight'
                    });
                }
            },
            error: function(xhr, status, error) {
                iziToast.error({
                    title: 'Erreur',
                    message: 'Échec de la soumission du formulaire',
                    position: 'topRight'
                });
            }
        });
    }

    function load_file_schemes() {
    // Détruire la table si elle existe déjà
    if ($.fn.DataTable.isDataTable('#tableExport_type_entity')) {
        $('#tableExport_type_entity').DataTable().destroy();
    }

    // Initialiser DataTable
    $('#tableExport_type_entity').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('load_entity_for_js') }}",
            type: 'GET',
            dataSrc: function(json) {
                if (!json.data) {
                    console.error("Erreur : 'data' est undefined dans la réponse AJAX", json);
                    return [];
                }
                return json.data;
            }
        },
        columns: [
            { data: 'nb', name: 'id', className: 'text-center' },
            { data: 'libele', name: 'libelle', className: 'text-center' },
            { data: 'description', name: 'description', className: 'text-center' },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data) {
                    return `
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle" style="color: white;">Options</a>
                            <div class="dropdown-menu">
                                <a href="#" onclick="event.preventDefault(); edit_entity(${data.id})" class="dropdown-item has-icon"><i class="far fa-edit"></i> Modifier</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" onclick="event.preventDefault(); delete_entity(${data.id});" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i> Supprimer</a>
                            </div>
                        </div>
                    `;
                }
            }
        ],
        initComplete: function() {
            console.log("Table initialisée avec succès !");
        },
        drawCallback: function() {
            console.log("Table redessinée !");
        }
    });
}

    function create_entity_store() {
        var data = {
            code: $('#name_').val(),
            libele: $('#libele_entity').val(),
            description: $('#description_entity').val(),
            type: $('#type_entity').val(),
            fonction_archive: $('#fonction_archive_update').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: "{{ route('entity.store') }}",
            type: "POST",
            data: data,
            success: function(response) {
                console.log(response);
                if (response.msg === "success") {
                    iziToast.success({
                        title: 'Succès',
                        message: 'Entité créée avec succès',
                        position: 'topRight'
                    });
                    load_entity_on_page();
                    $('#name_').val('');
                    $('#libele_entity').val('');
                    $('#description_entity').val('');
                    $('#type_entity').val('');
                    $('#fonction_archive_update').val('');
                    $('#add_entityModal_Entite').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Erreur',
                        message: response.message || 'Une erreur est survenue',
                        position: 'topRight'
                    });
                    $('#add_entityModal_Entite').modal('hide');
                }
            },
            error: function(xhr, status, error) {
                console.log("Erreur :", error);
                iziToast.error({
                    title: 'Erreur',
                    message: 'Échec de la soumission du formulaire',
                    position: 'topRight'
                });
            }
        });
    }

    function delete_entity(id) {
        swal({
            title: 'Êtes-vous sûr ?',
            text: 'Une fois supprimé, vous ne pourrez pas récupérer cette entité !',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var url = "/destroy_entity/" + id;
                const requestData = {
                    _token: '{{ csrf_token() }}',
                };
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: JSON.stringify(requestData),
                    contentType: 'application/json',
                    success: function(response) {
                        console.log(response);
                        if (response.msg === 'success') {
                            iziToast.success({
                                title: 'Succès !',
                                message: 'Entité supprimée avec succès',
                                position: 'topRight'
                            });
                            load_file_schemes();
                        } else {
                            iziToast.error({
                                title: 'Erreur !',
                                message: 'Erreur lors de la suppression',
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            } else {
                iziToast.error({
                    title: 'Erreur !',
                    message: 'Suppression annulée',
                    position: 'topRight'
                });
            }
        });
    }

    function load_entity_on_page() {
        var entity_id = null;

        var url = "{{ route('get_type_entity_api') }}";
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(response) {
                var zNodes1 = response;
                var setting = {
                    view: {
                        selectedMulti: false
                    },
                    data: {
                        key: {
                            title: "t"
                        },
                        simpleData: {
                            enable: true
                        }
                    },
                    callback: {
                        onClick: function myOnClick(event, treeId, treeNode) {
                            event.preventDefault();

                            $("#code").append('');
                            $("#descript").append('');
                            var url = "";
                            var name = treeNode.name;
                            var description = treeNode.description;
                            var type = treeNode.type;

                            entity_id = treeNode.id;
                            var infos = "";
                            infos += "<p><b>Code :</b> " + treeNode.code + "</p>";
                            infos += "<p><b>Description :</b> " + treeNode.description + "</p>";
                            var pare = "";
                            pare += "<input type='hidden' name='parent_id' id='parent_id_sub_elt' value='" + treeNode.id + "'/>";

                            var btnn = "";
                            btnn += "<a id='add_element-" + treeNode.id + "' onclick='event.preventDefault();show_add_sub(" + treeNode.id + ")' data-toggle='modal' data-target='#add_childModal-" + treeNode.id + "' class='btn btn-success'><i class='fas fa-plus ptplkai'></i></a>&nbsp;&nbsp;";
                            btnn += "<a id='edit_element-" + treeNode.id + "' onclick='event.preventDefault();show_edit_sub(" + treeNode.id + ")' data-toggle='modal' data-target='#edit_childModal-" + treeNode.id + "' class='btn btn-warning'><i class='fas fa-edit ptplkai'></i></a>&nbsp;&nbsp;";
                            btnn += "<a id='del_element-" + treeNode.id + "' onclick='event.preventDefault();show_delete_sub(" + treeNode.id + ")' data-toggle='modal' data-target='#del_childModal-" + treeNode.id + "' class='btn btn-danger'><i class='fas fa-trash ptplkai'></i></a>&nbsp;&nbsp;";
                            btnn += `<a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><i class='fas fa-user-alt ptplkai'></i></a>
                                    <div class="dropdown-menu">
                                        <a id="add_user-${treeNode.id}" href="add_post_work/${treeNode.id}" class="dropdown-item has-icon derd"><i class="fas fa-plus" style="color: black"></i> Ajouter un utilisateur</a>
                                        <a id="view_user-${treeNode.id}" onclick="event.preventDefault();show_access_entity(${treeNode.id})" class="dropdown-item has-icon derd"><i class="fas fa-unlock"></i> Attribuer des accès</a>
                                        <a id="view_user-${treeNode.id}" href="km_entity_detail/${treeNode.id}" class="dropdown-item has-icon derd"> <strong><i class="fas fa-eye"></i> Options</strong> </a>
                                    </div>`;

                            $("#mybody_card").html(infos);
                            $("#footery").html(btnn);

                            $("#add_parent_subentity").html(pare);

                            $("#mycard").css("display", "block");
                        }
                    }
                };

                $.fn.zTree.init($("#fileplanTree"), setting, zNodes1);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function show_add_sub(id) {
        var url = "{{ route('entity.index') }}" + "/" + id + "/edit";

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                if (data === 'off') {
                    iziToast.error({
                        title: 'Erreur',
                        message: 'Erreur',
                        position: 'topRight'
                    });
                } else {
                    $("#id_entity").val(data.id);
                    $('#parent_for_sub_entity').val(data.id);
                    $("#parent_first").val(data.libele);
                    $("#parent_first_").val(data.libele);

                    $('#add_my_child_entity').modal('show');
                }
            }
        });
    }

    function create_subentity_store() {
        var data = {
            parent_for_sub_entity: $('#parent_for_sub_entity').val(),
            code: $('#name__').val(),
            libele: $('#libele__up_').val(),
            description: $('#description__up').val(),
            type: $('#__type_sub').val(),
            fonction_archive: $('#__fonct_archi_').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: "{{ route('store_subentity') }}",
            type: "POST",
            data: data,
            success: function(response) {
                console.log(response);
                if (response.msg == "success") {
                    iziToast.success({
                        title: 'Succès',
                        message: 'Sous-entité créée avec succès',
                        position: 'topRight'
                    });
                    load_entity_on_page();
                    $('#parent_for_sub_entity').val('');
                    $('#name__').val('');
                    $('#libele__up_').val('');
                    $('#description__up').val('');
                    $('#__type_sub').val('');
                    $('#__fonct_archi_').val('');
                    $('#add_my_child_entity').modal('hide');
                } else {
                    iziToast.error({
                        title: 'Erreur',
                        message: response.message || 'Une erreur est survenue',
                        position: 'topRight'
                    });
                    $('#add_my_child_entity').modal('hide');
                }
            },
            error: function(xhr, status, error) {
                console.log("Erreur :", error);
                iziToast.error({
                    title: 'Erreur',
                    message: 'Échec de la soumission du formulaire',
                    position: 'topRight'
                });
            }
        });
    }

    function show_delete_sub(id) {
        swal({
            title: 'Êtes-vous sûr ?',
            text: 'Une fois supprimé, vous ne pourrez pas récupérer cette entité !',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var url = "{{ route('entity.destroy', ':id') }}";
                url = url.replace(':id', id);

                var xhr = new XMLHttpRequest();
                xhr.open('DELETE', url);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log(response);
                        if (response.error === 'no') {
                            iziToast.success({
                                title: 'Succès !',
                                message: 'Entité supprimée avec succès',
                                position: 'topRight'
                            });
                            load_entity_on_page();
                        } else {
                            iziToast.error({
                                title: 'Erreur !',
                                message: 'Erreur lors de la suppression',
                                position: 'topRight'
                            });
                        }
                    }
                };
                xhr.send();
            } else {
                iziToast.error({
                    title: 'Erreur !',
                    message: 'Suppression annulée',
                    position: 'topRight'
                });
            }
        });
    }

    $(document).ready(function() {
        setTimeout(function() {
            load_file_schemes();
        }, 100);
        load_entity_on_page();
    });
</script>
@endsection
