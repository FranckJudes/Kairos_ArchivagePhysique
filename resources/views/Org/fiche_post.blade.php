@extends('Layout.main-layout')

@section('styles')
    <style>
        .card-body .table-responsive {
            margin-bottom: 30px; /* Augmente l'espace entre les tableaux */
            border-radius: 8px; /* Ajoute des coins arrondis */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ajoute une ombre légère */
        }

        .card-body .table {
            width: 100%;
            border-collapse: separate; /* Utilise 'separate' pour les coins arrondis */
            border-spacing: 0;
            margin-bottom: 0;
            border-radius: 8px; /* Coins arrondis pour le tableau */
            overflow: hidden; /* Assure que les coins arrondis sont respectés */
        }

        .card-body .table th,
        .card-body .table td {
            border: 1px solid #e0e0e0; /* Bordure plus claire */
            padding: 14px 16px; /* Augmente le padding */
            text-align: left;
        }

        .card-body .table th {
            background-color: #f0f0f0; /* Couleur de fond légèrement plus sombre */
            font-weight: 600;
            color: #333; /* Couleur du texte plus foncée */
        }

        .card-body .table th[colspan="2"] {
            text-align: center;
        }

        .card-body .table td[style="text-align: center"] {
            width: 25%; /* Ajuste la largeur */
            font-weight: 500; /* Légèrement plus gras */
        }

        .card-body .table tr:nth-child(even) {
            background-color: #f9f9f9; /* Couleur de fond légèrement différente */
        }

        .card-body .table tr:hover {
            background-color: #f5f5f5; /* Couleur de fond au survol */
            transition: background-color 0.3s ease; /* Animation de transition */
        }

        /* Style pour les petits écrans */
        @media (max-width: 768px) {
            .card-body .table td[style="text-align: center"] {
                width: 40%; /* Adapte la largeur sur les petits écrans */
            }
        }
    </style>
@endsection


@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item" ><a href="{{route('dashboard.index')}}" style="color: white"><i class="fas fa-tachometer-alt"></i>&nbsp; Home</a></li>
        <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-cog"></i>&nbsp; App</a></li>
        <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-sitemap"></i>&nbsp; Organigramme</a></li>
        <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-chalkboard-teacher"></i>&nbsp; Poste de Travail</a></li>
        <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fab fa-wpforms"></i>&nbsp; Fiche de poste</a></li>
    </ol>
</nav>


<div class="row mt-sm-7">
    <div class="col-12 col-md-12 col-lg-7">
      <div class="card">
        <div class="card-header">
          <h4>Detail de la fiche</h4>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                    <tr>
                        <th  style="text-align: center" colspan="2">Intitule du poste</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">Intitule</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Position</td>
                        <td >{{$fiche->intitule}}</td>
                    </tr>

                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                    <tr>
                        <th  style="text-align: center" colspan="2">description du poste</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">Enjeux du poste</td>
                        <td>Irwansyah Saputra</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Missions</td>
                        <td>Irwansyah Saputra</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Activites et taches</td>
                        <td>Irwansyah Saputra</td>
                    </tr>


                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                    <tr>
                        <th  style="text-align: center" colspan="2">conditions d'exercice du poste</th>
                    </tr>
                    <tr>
                        <td style="text-align: center">Lieu de travail</td>
                        <td>Irwansyah Saputra</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Horaires de travail</td>
                        <td>Irwansyah Saputra</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Conditions</td>
                        <td>Irwansyah Saputra</td>
                    </tr>


                    </table>
                </div>
            </div>
      </div>
    </div>
    <div class="col-5">
      <div class="card">
        <div class="card-header">
            <h4>Formulaire d'enregistrement</h4>
        </div>

          <div class="card-body tab-content tab-bordered">
            <div class="form-group">
                <label for="nom">Intitule de travail </label>
                <input type="text" class="form-control" id="post_travail_id" name="post_travail_id">
            </div>
                <div class="form-group">
                    <label for="nom">Enjeux</label>
                    <input type="text" class="form-control" id="intitule" name="intitule">
                </div>
                <div class="form-group">
                    <label for="nom">Missions</label>
                    <input type="text" class="form-control" id="intitule" name="mission">
                </div>
                <div class="form-group">
                    <label for="nom">Activites :</label>
                    <div class="input-group">
                      <select class="custom-select"  id="inputGroupSelect05">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Button</button>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="nom">Lieu de travail </label>
                    <input type="text" class="form-control" id="lieu_du_poste" name="lieu_du_poste">
                </div>
                <div class="form-group">
                    <label for="nom">Conditions </label>
                    <input type="text" class="form-control" id="lieu_du_poste" name="lieu_du_poste">
                    {{-- <textarea name="" class="form-control" id="" cols="10" rows="10"></textarea> --}}
                </div>

                <div class="form-group">
                    <label for="nom">Horaires de travail </label>
                    <input type="text" class="form-control" id="lieu_du_poste" name="lieu_du_poste">
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
          </div>
      </div>
    </div>
</div>


@endsection


@section('scripts')
<script>
        function modifi_pass_user() {
            event.preventDefault();
            $('#editModal_update_password').modal('show');
        }
</script>

@endsection

