<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{ config('app.name') }} </title>
    <link rel="stylesheet" href="{{ asset('elements/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('elements/dist/css/adminlte.min.css')}}">
    <link rel="shortcut icon" href="{{ asset('elements/dist/img/agre-ele.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="hold-transition login-page">
<div class="color-line"></div>
<div class="login-container">
    <div class="row">
        <div class="col-lx-12" >
            <div class="text-center m-b-md">
                <img src="{{ asset('elements/dist/img/agre-ele.png')}}" title="logo agr-ele" style="width:60px" />
               <br> <br>
            </div>
             
                        <div class="panel-body" style="width:350px">
                       

                            <form method="POST" action="{{ route('handlelogin') }}">
                            @method('post')
                                @csrf
                                    <div class="form-group">
                                        <label class="control-label" for="username"><i class="fa fa-user"></i> Identifiant</label>
                                        <input type="text" placeholder="Identifiant" title="Identifiant" required=""  name="email"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password"><i class=" fas fa-fingerprint"></i> Mot de passse</label>
                                        <input type="password" title="Entrer votre mot de passse" placeholder="*****************" required=""  name="password" id="password" class="form-control">
                                    
                                    </div>
                                    <!--<div class="checkbox">
                                        <input type="checkbox" class="i-checks" checked>
                                            Remember login
                                        <p class="help-block small">(if this is a private computer)</p>
                                    </div>-->
                                    <button type="submit" name="seconnecte" class="btn btn-success btn-block"><i class=" fas fa-unlock-alt"></i> Se connecter</button>
                                    <!--<a class="btn btn-default btn-block" href="#">Register</a>  -->

                                    <BR><center><small>Copyright &copy; 2023 - {{ date('Y') }} <BR> V1.2 </small>  </center>
                                </form>
                        </div>
                    </div>
                
                </div>
    </div>
    </div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- Vendor scripts -->
<script src="{{ asset('elements/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('elements/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('elements/dist/js/adminlte.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(Session::has('success'))
<script>
    toastr.success("{{ Session::get('success') }}")
</script>
@elseif(Session::has('failed'))
<script>
    toastr.error("{{ Session::get('failed') }}")
</script>
@elseif(Session::has('info'))
<script>
    toastr.info("{{ Session::get('info') }}")
</script>
@endif
</body>
</html>

