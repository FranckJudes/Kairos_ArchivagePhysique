
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{asset('assets/images/monitor_kairos.jpg')}}" type="image/x-icon"/>

    <title>Talent360</title>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/theme1.css')}}"/>
    <style>
        .auth_right.full_img {
            position: fixed; /* Fixe l'image à la fenêtre du navigateur */
            top: 0;
            left: 0;
            width: 100%; /* Couvre toute la largeur de l'écran */
            height: 100%; /* Couvre toute la hauteur de l'écran */
            overflow: hidden; /* Empêche le défilement si l'image est plus grande que la fenêtre */
            z-index: -1; /* Place l'image derrière le contenu */
        }

        .auth_right.full_img img {
            width: 100%; /* L'image remplit le conteneur */
            height: 100%; /* L'image remplit le conteneur */
            object-fit: cover; /* L'image couvre tout le conteneur, en coupant si nécessaire */
        }
    </style>
</head>
<body class="font-montserrat">

<div class="auth">
    <div class="auth_left">
        <div class="card">
            <div class="text-center mb-2">
                <a class="header-brand" ><img src="{{asset('assets/images/monitor_kairos.jpg')}}" width="50" height="50" alt=""></a>
            </div>
            <div class="card-body">
                <form  method="POST" action="{{route('doLogin')}}">
                    @csrf
                    <div class="card-title">Login to your account</div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password<a href="forgot-password.html" class="float-right small">I forgot password</a></label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" />
                            <span class="custom-control-label">Remember me</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block" title="">Sign in</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="auth_right full_img">
        <img src="{{ asset('assets/images/life.png') }}">
    </div>
</div>

<script src="{{asset('assets/bundles/lib.vendor.bundle.js')}}"></script>
<script src="{{asset('assets/js/core.js')}}"></script>
</body>

</html>
