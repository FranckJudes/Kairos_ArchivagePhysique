<!doctype html>
<html lang="en" dir="ltr">

<!-- soccer/project/  07 Jan 2020 03:36:49 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('assets/bundles/izitoast/css/iziToast.min.css') }}">

    <title>Stats Kairos</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" />

    <!-- Plugins css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/charts-c3/c3.min.css')}}"/>
    @yield('styles')
    <!-- Core css -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/theme1.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/all.css')}}"/>


</head>
{{--  --}}
<body id="myBody" class="{{ Auth::user()->theme_preference ?: 'font-montserrat' }}">
<!-- Page Loader -->
{{-- <div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div> --}}

<div id="main_content">

    <div id="header_top" class="header_top">
        <div class="container">
            <div class="hleft">
                <a class="header-brand" href="{{route('dashboard.index')}}"><i class="fas fa-redo-alt"></i></a>
                <div class="dropdown">
                    <a href="{{route('dashboard.index')}}" class="nav-link user_btn">
                        <img class="avatar" src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/img/users/user-1.png') }}" alt="" data-toggle="tooltip" data-placement="right" title="{{Auth::user()->firstname .' '.Auth::user()->lastname}}"/>
                    </a>
                    <a href="{{route('performances.index')}}" class="nav-link icon xs-hide"><i class="fa fa-list-ol"></i></a>
                    <a href="{{route('intervenants.index')}}"  class="nav-link icon app_inbox xs-hide"><i class="fa fa-address-book"></i></a>
                </div>
            </div>
            <div class="hright">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fa fa-gear fa-spin" data-toggle="tooltip" data-placement="right" title="Settings"></i></a>
                    <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa  fa-align-left"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="rightsidebar" class="right_sidebar">
        <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
        <div class="p-4">
            <div class="mb-4">
                <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                <div class="custom-controls-stacked font_setting">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-opensans">
                        <span class="custom-control-label">Open Sans Font</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-montserrat" checked="">
                        <span class="custom-control-label">Montserrat Google Font</span>
                    </label>
                </div>
            </div>
            <hr>
            <div>
                <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                <ul class="setting-list list-unstyled mt-1 setting_switch">
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Night Mode</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Fix Navbar top</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Header Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader" checked="">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Min Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Icon Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Gradient Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Shadow</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">RTL Support</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Layout</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="form-group">
                <button type="button" onclick="save_my_color()" class="btn btn-primary btn-block mt-3">Enregister</button>
            </div>
        </div>
    </div>

    <div class="theme_div">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-unstyled">
                    <li class="list-group-item mb-2">
                        <p>Default Theme</p>
                        <a href="index-2.html"><img src="assets/images/themes/default.png" class="img-fluid" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>Night Mode Theme</p>
                        <a href="project-dark/index.html"><img src="assets/images/themes/dark.png" class="img-fluid" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>RTL Version</p>
                        <a href="project-rtl/index.html"><img src="assets/images/themes/rtl.png" class="img-fluid" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>



    <div id="left-sidebar" class="sidebar ">
        <h5 class="brand-name">Kairos-Monitors <a href="javascript:void(0)" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Project</li>
                <li class="active"><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i><span>&nbsp; Dashboard</span></a></li>
                <li><a href="{{route('performances.index')}}"><i class="fa fa-list-ol"></i><span>&nbsp; Performances</span></a></li>
                <li class="d">App</li>
                <li><a href="{{route('intervenants.index')}}"><i class="fa fa-address-book"></i><span>&nbsp; Intervenants</span></a></li>
                <li><a href="{{route('objectifs.index')}}"><i class="fas fa-object-ungroup"></i><span>&nbsp; Objectifs</span></a></li>
                <li><a href="{{route('domaine.index')}}"><i class="fas fa-qrcode"></i><span>&nbsp; Domaine de valeurs</span></a></li>
                <li><a href="{{route('planification.index')}}"><i class="far fa-calendar-times"></i><span>&nbsp; Planification</span></a></li>
                <li><a href="{{route('users.index')}}"><i class="fas fa-users-cog"></i><span>&nbsp; Utilisateurs</span></a></li>
                <li><a href="{{route('entity.index')}}"><i class="fas fa-users-cog"></i><span>&nbsp; Plan de classement </span></a></li>
                <li><a href="{{route('presences.index')}}"><i class="fas fa-users-cog"></i><span>&nbsp; Gestion des presences</span></a></li>
                <li><a href="{{route('etats.index')}}"><i class="fas fa-users-cog"></i><span>&nbsp; Les etats</span></a></li>

            </ul>
        </nav>
    </div>

    <div class="page">
        <div id="page_top" class="section-body top_dark">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <a href="javascript:void(0)" class="icon menu_toggle mr-3"><i class="fa  fa-align-left"></i></a>
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                    <div class="right">
                        {{-- <div class="input-icon xs-hide mr-4">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-icon-addon"><i class="fe fe-search"></i></span>
                        </div> --}}
                        <div class="notification d-flex">
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-language"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="assets/images/flags/jp.svg">Anglais</a>
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="assets/images/flags/bl.svg">France</a>
                                </div>
                            </div>
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="{{route('go_and_edit_profile')}}"><i class="dropdown-icon fas fa-user-edit"></i> Profile</a>
                                    <a class="dropdown-item" href="{{route('logout')}}"><i class="dropdown-icon fas fa-sign-out-alt"></i> Sign out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">


                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
        <form action="{{ route('update_theme') }}" method="POST"
                id="my_color_theme_form_id">
            @csrf
            <input type="hidden" name="my_color_theme" id="my_color_theme">
        </form>

        <div class="section-body">
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                        </div>
                        <div class="col-md-6 col-sm-12 text-md-right">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="doc/index.html">Kairos</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)">Version 1.0</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>


    <script src="{{asset('assets/bundles/lib.vendor.bundle.js')}}"></script>

    <script src="{{asset('assets/bundles/apexcharts.bundle.js')}}"></script>
    <script src="{{asset('assets/bundles/counterup.bundle.js')}}"></script>
    <script src="{{asset('assets/bundles/knobjs.bundle.js')}}"></script>
    <script src="{{asset('assets/bundles/c3.bundle.js')}}"></script>
    <script src="{{ asset('assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{asset('assets/js/core.js')}}"></script>
    <script src="{{asset('assets/js/all.js')}}"></script>
    <script>
         function save_my_color() {
            var bodyElement = $('#myBody');
            var classesValue = bodyElement.attr('class');

            $('#my_color_theme').val(classesValue);
            //alert(classesValue);
            $('#my_color_theme_form_id').submit();
        }
    </script>
    @yield('scripts')
</body>

<!-- soccer/project/  07 Jan 2020 03:37:22 GMT -->
</html>
