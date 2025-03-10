@extends('Layout.main-layout')
@section('styles')
    <link rel="stylesheet"  href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}">

    <style>
        .btn-icon.icon-right {
            padding-left: 10px; /* Ajustez l'espacement entre le texte et l'icône */
            padding-right: 10px;
        }

        .btn-icon.icon-right span {
            margin-right: 10px; /* Espacement entre le texte et l'icône */
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="{{route('dashboard.index')}}" style="color: white"><i class="fas fa-tachometer-alt"></i>&nbsp; Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-cog"></i>&nbsp; App</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-user-clock"></i>&nbsp; Intervenants</a></li>
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
                               aria-controls="home" aria-selected="true">Affectation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Creation</a>
                        </li>

                    </ul>


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="pt-2">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Formulaires :</h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{route('intervenant_activites')}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Intervenant : </label>
                                                            <select class="js-example-basic-single form-control"  name="intervenants[]" multiple>
                                                                @foreach($intervenants as $item)
                                                                    <option value="{{ $item->id }}"> {{ $item->firstname }} - {{ $item->lastname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                    </div>
                                                    <div class="col-4">
                                                        <label>activites : </label>
                                                        <div class="form-group" style="display: flex; gap: 10px;">
                                                            <select class="form-control select2-activities"  name="activites[]" multiple>
                                                                @foreach($activites->domaine_valeurs_elements as $item)
                                                                    <option value="{{ $item->id }}">{{$item->libele}}</option>
                                                                @endforeach
                                                            </select>
                                                            <button class="btn btn-icon icon-left btn-primary" type="submit" ><i class="fa fa-check"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Matricule</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th >Activites</th>
                                                <th></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($intervenants  as $key => $value)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$value->matricule}}</td>
                                                    <td>{{$value->lastname}}</td>
                                                    <td>{{$value->firstname}}</td>
                                                    <td>

                                                        @foreach($value->activites as $item)
                                                            <span class="badge badge-info position-relative mr-2 mb-2">
                                                            <form class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="intervenants[]" value="{{ $value->id }}">
                                                                <input type="hidden" name="activites[]" value="{{ $item->id }}">
                                                                <a href="#" class="btn btn-icon icon-right btn-danger d-flex align-items-center justify-content-between">
                                                                    <span>{{ $item->libele }}</span>
                                                                    <i class="fa fa-times-circle"></i>
                                                                </a>
                                                            </form>

                                                            </span>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row pt-2" >
                                <div class="col-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Intervenants</h4>
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
                                                    @foreach($intervenants  as $key => $value)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$value->matricule}}</td>
                                                            <td>{{$value->lastname}}</td>
                                                            <td>{{$value->firstname}}</td>
                                                            <td>{{$value->sex}}</td>
                                                            <td>{{$value->domaineElement->libele}}</td>
                                                            <td>
                                                                <div class="dropdown d-inline">
                                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Options
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item has-icon" onclick="" href="#"><i class="fa fa-edit"></i> Edit</a>
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
                                                    <label>Matricule </label>
                                                    <input type="text" class="form-control" name="matricule" required placeholder="Entrez le matricule">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nom : </label>
                                                    <input type="text" class="form-control" name="firstname" required placeholder="Entrez le nom">
                                                </div>
                                                <div class="form-group">
                                                    <label>Prenom : </label>
                                                    <input type="text" class="form-control" name="lastname" required placeholder="Entrez le prenom">
                                                </div>

                                                <div class="form-group">
                                                    <label>Fonction </label>
                                                    <select class="form-control" required name="fonction">
                                                        @foreach($domaineValeursElements->domaine_valeurs_elements as $value)
                                                            <option value="{{$value->id}}">{{$value->libele}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="additional-fields" style="display: none;">
                                                    <div class="form-group" style="display: grid; grid-template-columns: repeat(2, auto); gap: 10px; ">
                                                        <label>Sexe : </label> <br>
                                                        <div class="pretty p-default p-round" style="text-align: center">
                                                            <input type="radio" name="sex" value="1" checked> <label>Male</label>
                                                        </div>
                                                        <div class="pretty p-default p-round" style="text-align: center">
                                                            <input type="radio" name="sex" value="2">   <label>Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>date de naissance : </label>
                                                        <input type="date" class="form-control" name="date_of_birth" placeholder="Entrez la date de naissance">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Lieu de naissance : </label>
                                                        <input type="text" class="form-control" name="lieu_naissance" placeholder="Entrez le lieu de naissance">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Profession : </label>
                                                        <input type="text" class="form-control" name="profession" placeholder="Entrez la profession">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>date d'integration : </label>
                                                        <input type="date" class="form-control" name="date_integration" placeholder="Entrez la date d'integration">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Informations connexes : </label>
                                                        <input type="date" class="form-control" name="info_connexes" placeholder="Entrez les informations connexes">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Photo de Profil : </label>
                                                        <input type="file" class="form-control" name="info_connexes" placeholder="Entrez les informations connexes">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Telephone : </label>
                                                        <input type="number" class="form-control" name="phone" placeholder="Entrez les informations connexes">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email : </label>
                                                        <input type="email" class="form-control" name="email" placeholder="Entrez l'email ">
                                                    </div>
                                                </div>
                                                <div style="display: flex; align-items: end;  justify-content: end; text-decoration: underline;" >
                                                    <a type="button"  id="toggle-additional-fields">Plus</a>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" style="width: 100%">Enregister</button>
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


@endsection
@section('scripts')
    <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>

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

        $(document).ready(function() {
            // Initialiser Select2
            $('.js-example-basic-single').select2({
                placeholder: "Sélectionnez l'intervenanant",
                width: '100%'
            });
            $('.select2-activities').select2({
                placeholder: "Sélectionnez les activités",
                width: '100%'
            });



        });
        //
        function show_delete_intervenant(id) {
            event.preventDefault();
            swal({
                title: 'Attention !'
                , text: 'Voulez-vous vraiment supprimer'
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

        $(document).ready(function () {
            $(document).on('click', '.btn-danger', function (event) {
                event.preventDefault();

                const badge = $(this).closest('.badge');
                const intervenantId = badge.find('input[name="intervenants[]"]').val();
                const activiteId = badge.find('input[name="activites[]"]').val();
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                swal({
                    title: 'Attention !',
                    text: 'Voulez-vous vraiment supprimer cette activité ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '/intervenant_activites_detach',
                            type: 'POST',
                            data: {
                                '_token': csrfToken,
                                'intervenants': [intervenantId],  // Assurez-vous que c'est un tableau
                                'activites': [activiteId]         // Assurez-vous que c'est un tableau
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    iziToast.success({
                                        title: 'Succès !',
                                        message: response.message,
                                        position: 'topRight'
                                    });
                                    badge.remove();
                                } else {
                                    iziToast.error({
                                        title: 'Erreur !',
                                        message: response.message,
                                        position: 'topRight'
                                    });
                                }
                            },
                            error: function (xhr) {
                                iziToast.error({
                                    title: 'Erreur !',
                                    message: xhr.responseJSON ? xhr.responseJSON.message : 'Une erreur est survenue.',
                                    position: 'topRight'
                                });
                            }
                        });
                    }
                });
            });
        });



    </script>
@endsection


