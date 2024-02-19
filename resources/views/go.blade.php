<script>
  setTimeout("location.href = '{{ route('login')}}';",2500);
</script>
<script src="{{ asset('elements/vendors/fontawesome/all.min.js') }}"></script>

<style>/* Absolute Center Spinner */
body{
    position: relative;
}
.box{
    position: absolute;
    top:10%;
    left: 50%;
    transform: translate(-50%,20%);
}
.box p{
    color:#228B22;
    font-size: 2.8rem;
    font-family: Helvetica, sans-serif;
    font-weight: bolder;
}
.text-box{
    color: white;
    background-color:#228B22;
    padding: 0px 5px;
    border-radius: 3px;
}
.y-back{
    width:160px;
    height: 2px;
    padding: 1px;
    border-radius: 2px;
    background-color: #e2dbdb;
    overflow: hidden;
    margin:auto;
}
.y-inner{
    height: 3px;
    width:40px;
    background-color: #228B22;
    transform: translateX(-60%);
    animation:anim 1.6s infinite;
}
@keyframes anim{
    50%{
        transform: translateX(360%);
    }
}
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREL</title>

</head>
<body>
    <div class="box">
        <p class="logo-text ms-2 d-none d-sm-block">
                    <img src="{{ asset('elements/dist/img/agre-ele.png') }}" title="logo agr-ele" style="margin-left:20px;" />
        </p>
        <div class="y-back">
            <div class="y-inner"></div>
        </div>
    </div>




</body>
</html>
