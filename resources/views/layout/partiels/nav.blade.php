@php

$daten= date("Y-m-d");

$NotiseAnimal= DB::table('entreranimals')
->join('especes', 'entreranimals.animalid', '=', 'especes.id')
->join('fournisseurs', 'entreranimals.fournisseurid', '=', 'fournisseurs.id')
->select('entreranimals.*', 'especes.libelle','fournisseurs.nom')
->where('entreranimals.created_at', '=', $daten)
->get();

$Noticesortieanimal=DB::table('sortieanimals')
->join('especes', 'sortieanimals.animalid', '=', 'especes.id')
->select('sortieanimals.*', 'especes.libelle')
->where('sortieanimals.created_at', $daten)
->get();

$Noticeentrestock=DB::table('entrestocks')
->join('motifstocks', 'entrestocks.motifid', '=', 'motifstocks.id')
->join('fournisseurs', 'entrestocks.fournisseurid', '=', 'fournisseurs.id')
->select('entrestocks.*', 'motifstocks.libelle','motifstocks.unitemesure','fournisseurs.nom')
->where('entrestocks.created_at', $daten)
->get();

$Noticesortiestocks = DB::table('sortiestocks')
->join('motifstocks', 'sortiestocks.motifid', '=', 'motifstocks.id')
->select('sortiestocks.*', 'motifstocks.libelle', 'motifstocks.unitemesure')
->where('sortiestocks.created_at', $daten)
->get();

$Noticedepense=DB::table('depenses')
->join('motifdepenses', 'depenses.motif', '=', 'motifdepenses.id')
->select('depenses.*', 'motifdepenses.libelle')
->where('depenses.created_at', $daten)
->get();

$Noticesalsite= DB::table('salaires')
->join('personnels', 'salaires.persid', '=', 'personnels.id')
->select('salaires.*', 'personnels.nom', 'personnels.prenom')
->where('salaires.created_at', $daten)
->get();

$NombreTotalNotice= $NotiseAnimal->count() + $Noticesalsite->count() + $Noticedepense->count() + $Noticesortiestocks->count() + $Noticeentrestock->count() + $Noticesortieanimal->count();

@endphp

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="{{ route('bienvenu') }}" class="navbar-brand">
          <img src="{{ asset('elements/dist/img/agre-ele.png')}}" alt="Agr-ele Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Agr-Ele &nbsp;&nbsp;&nbsp;&nbsp; </span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-home"></i> Accueil</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="{{ route('bienvenu') }}" class="dropdown-item"><i class="fas fa-home"></i> Bienvenu </a></li>
                <li class="dropdown-divider"></li>
                <!--  <li><a href="{{ route('rapport')}}" class="dropdown-item"> <i class="fas fa-hippo"></i> Diaporament Elevage </a></li>
              <li class="dropdown-divider"></li>
              <li><a href="{{ route('rapport')}}" class="dropdown-item"> <i class="fab fa-pagelines"></i> Diaporament Agriculture </a></li>

              <li class="dropdown-divider"></li> -->
                <li><a href="{{ route('rapport')}}" class="dropdown-item"> <i class="far fa-file-alt"></i> Rapport</a></li>

                <li class="dropdown-divider"></li>
                <!--<li><a href="{{ route('rapport')}}" class="dropdown-item"> <i class="far fa-file-alt"></i> Journalier </a></li> -->
              </ul>
            </li>


            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">


                <i class="fas fa-download"></i> Entrer

              </a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="{{ route('entreranimal') }}" class="dropdown-item"><i class="fas fa-hippo"></i> Animal</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('entrerstock') }}" class="dropdown-item"><i class=" fab fa-product-hunt  "></i> Produit </a></li>
              </ul>
            </li>



            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"> <i class="fas fa-upload"></i> Sortie</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <!-- Level two dropdown-->

                <li><a href="{{ route('sortieanimal') }}" class="dropdown-item"><i class="fas fa-hippo"></i> Animal</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('sortiestock') }}" class="dropdown-item"> <i class=" fab fa-product-hunt "></i> Produit</a></li>


              </ul>


            </li>



            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"> <i class=" fas fa-archive "></i> Stock</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <!-- Level two dropdown-->

                <li><a href="{{ route('compteanimal') }}" class="dropdown-item"><i class="fas fa-hippo"></i> Animal</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('stock') }}" class="dropdown-item"> <i class="fab fa-product-hunt"></i> Produit</a></li>


              </ul>


            </li>




            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fab fa-elementor"></i> Dépense</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="{{ route('depense') }}" class="dropdown-item"><i class="fas fa-file-alt"></i> Générale </a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('salaire') }}" class="dropdown-item"> <i class=" far fa-file-alt"></i> Salaire monsuel</a></li>
              </ul>
            </li>








            <li class="nav-item">
              <a href="{{ route('credit') }}" class="nav-link"><i class="fas fa-money-check"></i> Crédit</a>
            </li>

            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Paramètre</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="{{ route('fournisseur') }}" class="dropdown-item"> <i class="fa fa-users"></i> Fournisseur </a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('fonction') }}" class="dropdown-item"> <i class="fa fa-user-edit"></i> Fonction</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('personnel') }}" class="dropdown-item"> <i class="fa fa-users"></i> Personnel</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="{{ route('user') }}" class="dropdown-item"> <i class="fa fa-users"></i> Utilisateur</a></li>



                <li class="dropdown-divider"></li>

                <!-- Level two dropdown-->
                <li class="dropdown-submenu dropdown-hover">
                  <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Outils</a>
                  <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                    <li><a href="{{ route('box')}}" class="dropdown-item"> <i class="fa fa-box"></i> Box</a></li>

                    <li><a href="{{ route('site') }}" class="dropdown-item"> <i class="fa fa-globe-americas"></i> Les sites</a></li>
                    <li><a href="{{ route('espece') }}" class="dropdown-item"> <i class="fas fa-hippo"></i> Especes</a></li>
                    <li><a href="{{ route('bloc') }}" class="dropdown-item"> <i class="fa fa-shoe-prints"></i> Parcelles</a></li>
                    <li><a href="{{ route('motifplante') }}" class="dropdown-item"> <i class="fa fa-edit"></i> Motif Plante</a></li>
                    <li><a href="{{ route('motifstock') }}" class="dropdown-item"> <i class="fa fa-edit"></i> Motif Stock</a></li>
                    <li><a href="{{ route('motifdepense') }}" class="dropdown-item"> <i class="fa fa-edit"></i> Motif depense</a></li>
                    <li><a href="{{ route('statut') }}" class="dropdown-item"> <i class="fa fa-edit"></i> Motif statut</a></li>
                  </ul>
                </li>
                <!-- End Level two -->
              </ul>
            </li>

          </ul>
        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" title="Ndale Michael ">
              <i class="fas fa-user-tie"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-comments"></i>
              <span class="badge badge-danger navbar-badge">
                {{ $NombreTotalNotice }}
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="{{ route('rapport') }}" class="dropdown-item dropdown-footer">Voir tout l'historique</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="if(window.confirm('Attention ! Voulez-vous vous deconnecter ')){return true;}else{return false;}" title="Se deconnecter"><i class=" fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <div class="content-wrapper">