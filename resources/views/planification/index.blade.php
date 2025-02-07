@extends('Layout.main-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/jquery-ui.css') }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> App</a></li>
            <li class="breadcrumb-item"><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Gestions des jours Feries</a></li>
        </ol>
    </nav>
    <div class="row text-center">
        <div class="col-md-3">  <div class="card">
                <div class="card-header">
                    <h4 class="demoHeaders">Form</h4>
                </div>
                <div class="card-body d-flex flex-column align-items-center"> <form id="dateForm" action="{{ route('planification.store') }}" method="POST">
                        @csrf
                        <div id="datepicker" style="width: 100%;"></div> <input type="hidden" name="date" id="dateInput">
                        <div id="selectedDate" class="text-lightskyblue fw-bold mt-2 text-center"></div> <button type="submit" class="btn btn-primary w-100 mt-2">Enregistrer</button> </form>
                </div>
            </div>
        </div>

        <div class="col-md-9"> <div class="card">
                <div class="card-header">
                    <h4>Jour Ferier</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($joursFeries as $key => $value)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $value->date }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger" href="#" onclick="show_delete_ferrier_jours({{ $value->id }})">
                                            <i class="fa fa-trash"></i> Supprimer
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $("#datepicker").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            onSelect: function (dateText) {
                $("#selectedDate").text(dateText); // Afficher la date choisie
                $("#dateInput").val(dateText); // Mettre la date dans l'input caché
            }
        });

        function show_delete_ferrier_jours(id) {
            console.log(id)
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
                        var url = "{{ route('planification.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        var xhr = new XMLHttpRequest();
                        xhr.open('DELETE', url);
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.onload = function() {
                            if (xhr.status === 200) {

                                var response = JSON.parse(xhr.responseText);

                                if (response === 'ok') {
                                    location.reload();
                                } else {
                                    location.reload();
                                }
                            }
                        };
                        xhr.send();
                        // document.location.href = url;
                    } else {
                        {{--iziToast.error({--}}
                        {{--    title: '{{ __('message._error') }} !'--}}
                        {{--    , message: '{{ __('message._canceled') }}'--}}
                        {{--    , position: 'topRight'--}}
                        {{--});--}}
                    }
                });
        }

    </script>
@endsection
