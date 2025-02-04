@extends('Layout.main-layout')
@section('styles')
    <link rel="{{asset('stylesheet" href="assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">

@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Les valeurs  {{$domaineValeursElements->libele}}</h4>
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
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($domaineValeursElements->domaine_valeurs_elements  as $key => $value)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->libele}}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Options
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon" href="#"><i class="fa fa-edit"></i> Edit</a>
                                                <a class="dropdown-item has-icon" href=""><i class="fa fa-trash"></i> Supprimer</a>
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
                    <form method="POST" action="{{route('domaineElement.store')}}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Libelle </label>
                            <input type="text" class="form-control" name="libele" placeholder="Entrez le libelle">
                            <input type="hidden"  name="id_domaine" value="{{$domaineValeursElements->id}}" placeholder="Entrez le libelle">
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

@endsection


