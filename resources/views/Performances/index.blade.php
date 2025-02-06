@extends('Layout.main-layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}">
    <style>
        .calendar-container {
            background: #fff;
            width: 300px; /* Reduced from 450px */
            border-radius: 8px; /* Slightly reduced */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); /* Adjusted shadow */
        }

        .calendar-container header {
            display: flex;
            align-items: center;
            padding: 15px 20px 5px; /* Reduced padding */
            justify-content: space-between;
        }

        header .calendar-navigation {
            display: flex;
        }

        header .calendar-navigation span {
            height: 30px; /* Reduced height */
            width: 30px; /* Reduced width */
            margin: 0 1px;
            cursor: pointer;
            text-align: center;
            line-height: 30px; /* Adjust line-height to match height */
            border-radius: 50%;
            user-select: none;
            color: #aeabab;
            font-size: 1.5rem; /* Reduced font size */
        }

        .calendar-navigation span:last-child {
            margin-right: -5px; /* Adjusted margin */
        }

        header .calendar-navigation span:hover {
            background: #f2f2f2;
        }

        header .calendar-current-date {
            font-weight: 300;
            font-size: 0.9rem; /* Reduced font size */
        }

        .calendar-body {
            padding: 10px; /* Reduced padding */
        }

        .calendar-body ul {
            list-style: none;
            flex-wrap: wrap;
            display: flex;
            text-align: center;
        }

        .calendar-body .calendar-dates {
            margin-bottom: 10px; /* Reduced margin */
        }

        .calendar-body li {
            width: calc(100% / 7);
            font-size: 0.9rem; /* Reduced font size */
            color: #414141;
        }

        .calendar-body .calendar-weekdays li {
            cursor: default;
            font-weight: 500;
        }

        .calendar-body .calendar-dates li {
            margin-top: 20px; /* Reduced margin */
            position: relative;
            z-index: 1;
            cursor: pointer;
        }

        .calendar-dates li.inactive {
            color: #aaa;
        }

        .calendar-dates li.active {
            color: #fff;
        }

        .calendar-dates li.selected {
            background-color: #28a745;
            color: #fff;
        }

        .calendar-dates li::before {
            position: absolute;
            content: "";
            z-index: -1;
            top: 50%;
            left: 50%;
            width: 30px; /* Reduced width */
            height: 30px; /* Reduced height */
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .calendar-dates li.active::before {
            background: #6332c5;
        }

        .calendar-dates li:not(.active):hover::before {
            background: #e4e1e1;
        }

        .selected-date-display {
            margin-top: 10px; /* Reduced margin */
            font-weight: bold;
            font-size: 1rem; /* Reduced font size */
        }
    </style>


@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary text-white-all">
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> App</a></li>
            <li class="breadcrumb-item" ><a href="#" style="color: white"><i class="fas fa-tachometer-alt"></i> Liste de valeurs</a></li>
        </ol>
    </nav>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Formulaires :</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Intervenant : </label>
                                <select class="select2-perf form-control"  onchange="change_intervenant(this)" >
                                    @foreach($intervenants as $item)
                                        <option value=" {{ $item->id }}"> {{ $item->firstname }} - {{ $item->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control">
                                <div class="calendar-container">
                                    <header class="calendar-header">
                                        <p class="calendar-current-date"></p>
                                        <div class="calendar-navigation">
                                            <span id="calendar-prev" style="font-size: small;" class="fa fa-chevron-left"></span>
                                            <span id="calendar-next" style="font-size: small;" class="fa fa-chevron-right"></span>
                                        </div>
                                    </header>

                                    <div class="calendar-body">
                                        <ul class="calendar-weekdays">
                                            <li>Dim</li>
                                            <li>Lun</li>
                                            <li>Mar</li>
                                            <li>Mer</li>
                                            <li>Jeu</li>
                                            <li>Ven</li>
                                            <li>Sam</li>
                                        </ul>
                                        <ul class="calendar-dates"></ul>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="col-4">
{{--                            <div class="form-group">--}}
{{--                                <label>Intitule : </label>--}}
{{--                                <input type="text" class="form-control" placeholder="intitute">--}}
{{--                            </div>--}}
                            <div class="form-group" id="form-activities">
                                <label>Activites : </label>
                                <select class="form-control" onchange="get_objectifi_activities(this)" id="activites-container">

                                </select>
                            </div>
                            <div class="form-group"">
                                <label>Performance : </label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Objectifs</label>
                                <select class="form-control" id="objectif_temps" onchange="get_activitites_domaine_valeurs(this)" id="activites-container">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Performances</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Intitule</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'Object</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id">
                        <div class="form-group">
                            <label>Intitulé :</label>
                            <input type="text" class="form-control" id="edit_libele" name="libele">
                        </div>
                        <div class="form-group">
                            <label>Description :</label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/page/datatables.js')}}"></script>
    <script src="{{asset('assets/bundles/prism/prism.js')}}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-perf').select2({
                placeholder: "Sélectionnez l'intervenanant",
                width: '100%',
                height:'100px'
            });
        });
        function show_delete_intervenant(id) {
            event.preventDefault();
            swal({
                title: 'Attention !'
                , text: 'Voulez-vous vraiment supprime ??'
                , icon: 'warning'
                , buttons: true
                , dangerMode: true
                , })
                .then((willDelete) => {
                    if (willDelete) {
                        var url = "{{ route('Objects.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        var xhr = new XMLHttpRequest();
                        xhr.open('DELETE', url);
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.onload = function() {
                            if (xhr.status === 200) {

                                var response = JSON.parse(xhr.responseText);
                                console.log(response);
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
                        iziToast.error({
                            title: '{{ __('message._error') }} !'
                            , message: '{{ __('message._canceled') }}'
                            , position: 'topRight'
                        });
                    }
                });
        }

    </script>
    <script>
        function editObject(data1) {
            const data = JSON.parse(data1);

            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_libele').value = data.libele;
            document.getElementById('edit_description').value = data.description;
            $('#editModal').modal('show');
        }
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#edit_id').val();

            $.ajax({
                url: "{{ url('Objects') }}/" + id,
                type: 'PUT',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'libele': $('#edit_libele').val(),
                    'description': $('#edit_description').val()
                },
                success: function(response) {
                    console.log(response);
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


        function change_intervenant(id){

            var id = id.value;

            $.ajax({
                url: "{{ url('get_activite_for_single_intervenant') }}/" + id,
                type: 'GET',
                success: function(response) {
                    var html = '';

                    // if (response.data && Array.isArray(response.data)) {
                    //     response.data.forEach(function(data, index) {
                    //         html += `
                    //             <div class="custom-control custom-radio">
                    //                 <input type="radio"
                    //                        class="custom-control-input"
                    //                        id="customRadio${index}"
                    //                        name="activites[]"
                    //                        value="${data.id}" onchange="get_objectifi_activities(this)">
                    //                 <label class="custom-control-label"
                    //                        for="customRadio${index}">
                    //                     ${data.libele}
                    //                 </label>
                    //             </div>`;
                    //     });
                    // }
                    if (response.data && Array.isArray(response.data)) {
                        response.data.forEach(function(data, index) {
                            html += `
                                <option value="${data.id}"> ${data.libele}</option>
                               `;
                        });
                    }
                    $('#activites-container').html(html);
                    $('#form-activities').css('display','block');


                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function get_objectifi_activities(id) {
            const id_value = id.value;
            $.ajax({
                url: "{{ url('get_objectifi_activities') }}/" + id_value,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var html = '';


                    if (response.data && Array.isArray(response.data)) {
                        if (response.data.length > 0) {

                            response.data.forEach(function(data, index) {
                                html += `
                            <option value="${data.id}">
                                ${data.code || 'Objectif ' + (index + 1)}
                            </option>
                        `;
                            });
                        } else {

                            html = '<option value="">Aucun Objectif disponible</option>';
                        }
                    } else {

                        html = '<option value="">Aucun Objectif trouvé</option>';
                    }

                    $('#objectif_temps').html(html);


                    $('#objectif_temps').trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('Erreur de chargement des objectifs:', error);
                    $('#objectif_temps').html('<option value="">Erreur de chargement</option>');


                }
            });
        }
    </script>
    <script>
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        const day = document.querySelector(".calendar-dates");
        const currdate = document.querySelector(".calendar-current-date");
        const prenexIcons = document.querySelectorAll(".calendar-navigation span");
        const selectedDateDisplay = document.getElementById("selected-date");

        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        // Function to generate the calendar
        const manipulate = () => {
            let dayone = new Date(year, month, 1).getDay();
            let lastdate = new Date(year, month + 1, 0).getDate();
            let dayend = new Date(year, month, lastdate).getDay();
            let monthlastdate = new Date(year, month, 0).getDate();

            let lit = "";

            // Loop for last dates of the previous month
            for (let i = dayone; i > 0; i--) {
                lit += `<li class="inactive">${monthlastdate - i + 1}</li>`;
            }

            // Loop for current month's dates
            for (let i = 1; i <= lastdate; i++) {
                let isToday = i === date.getDate() && month === new Date().getMonth() && year === new Date().getFullYear() ? "active" : "";
                lit += `<li class="${isToday}" data-date="${year}-${month+1}-${i}">${i}</li>`;
            }

            // Loop for first dates of the next month
            for (let i = dayend; i < 6; i++) {
                lit += `<li class="inactive">${i - dayend + 1}</li>`;
            }

            currdate.innerText = `${months[month]} ${year}`;
            day.innerHTML = lit;
        }

        manipulate();

        // Navigation icons click event listener
        prenexIcons.forEach(icon => {
            icon.addEventListener("click", () => {
                month = icon.id === "calendar-prev" ? month - 1 : month + 1;

                if (month < 0 || month > 11) {
                    date = new Date(year, month, new Date().getDate());
                    year = date.getFullYear();
                    month = date.getMonth();
                } else {
                    date = new Date();
                }

                manipulate();
            });
        });

        // Add click event to each date
        day.addEventListener('click', function(event) {
            if (event.target.tagName.toLowerCase() === 'li' && !event.target.classList.contains('inactive')) {
                const selectedDate = event.target.getAttribute('data-date');
                selectedDateDisplay.innerText = `Selected Date: ${selectedDate}`;

                // Remove previous selection and add the new selected class
                const allDays = document.querySelectorAll('.calendar-dates li');
                allDays.forEach(day => day.classList.remove('selected'));
                event.target.classList.add('selected');
            }
        });
    </script>
@endsection


