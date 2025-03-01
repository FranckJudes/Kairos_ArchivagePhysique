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
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-user-alt"></i> Les Etats</a></li>
        </ol>
    </nav>
    <div class="row">

    <div class="table-responsive">
        <table class="table table-striped table-hover" id="table-1">
            <thead>
            <tr>
                <th class="text-center">N-</th>
                <th class="text-center">Intervenants</th>
                <th class="text-center">Jour</th>
                <th class="text-center">Heure d'arrivee</th>
                <th class="text-center">Heure de depart</th>
                <th class="text-center">Performances</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection
