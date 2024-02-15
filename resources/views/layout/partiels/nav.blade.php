<body class="hold-transition layout-top-nav" >
<div class="wrapper" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white"  >
    <div class="container">
      <a href="{{ route('bienvenu') }}" class="navbar-brand">
        <img src="{{ asset('elements/dist/img/agre-ele.png')}}" alt="Agr-ele Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
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
              <li><a href="index.php?action=home" class="dropdown-item"><i class="fas fa-home"></i> Bienvenu </a></li>
              <li class="dropdown-divider"></li>
              <li><a href="index.php?action=diaporament" class="dropdown-item"> <i class="fas fa-hippo"></i> Diaporament Elevage </a></li>
              <li class="dropdown-divider"></li>
              <li><a href="index.php?action=diaporament_agriculture" class="dropdown-item"> <i class="fab fa-pagelines"></i> Diaporament Agriculture </a></li>

              <li class="dropdown-divider"></li>
              <li><a href="index.php?action=all_recete" class="dropdown-item"> <i class="far fa-file-alt"></i> Rapport recette</a></li>


              <li class="dropdown-divider"></li>
              <li><a href="index.php?action=all_depense" class="dropdown-item"> <i class="far fa-file-alt"></i> Rapport depense </a></li>

            
              <li class="dropdown-divider"></li>
              <li><a href="index.php?action=historique" class="dropdown-item"> <i class="far fa-file-alt"></i> Rapport journalier </a></li>
            </ul>
          </li>


          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"> 

           
           
            <i class="fas fa-hippo"></i> Entrer

            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="index.php?action=accueil_site" class="dropdown-item"><i class="fas fa-hippo"></i> Animal</a></li>
              <li class="dropdown-divider"></li>
              <li><a href="index.php?action=medecine" class="dropdown-item"><i class="fas fa-thermometer-half"></i> Produit </a></li>
            </ul>
          </li>


          
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"> <i class="fab fa-pagelines"></i> Sortie</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <!-- Level two dropdown-->

              <li><a href="index.php?action=listeculture" class="dropdown-item"><i class="fas fa-file-alt"></i> Animal</a></li>
              <li class="index.php?action=dropdown-divider"></li>
              <li><a href="index.php?action=recolte" class="dropdown-item"> <i class=" far fa-file-alt"></i> Produit</a></li>
            

            </ul>


          </li>


          <li class="nav-item">
            <a href="index.php?action=approvisionnement" class="nav-link"><i class=" fas fa-shopping-cart"></i>  Stock</a>
          </li>

          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fab fa-elementor"></i> Dépense</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="index.php?action=charge" class="dropdown-item"><i class="fas fa-file-alt"></i> Générale </a></li>
              <li class="dropdown-divider"></li>
              <li><a href="index.php?action=salaire" class="dropdown-item"> <i class=" far fa-file-alt"></i> Salaire monsuel</a></li>
            </ul>
          </li>




         
          

          
          <li class="nav-item">
            <a href="index.php?action=credit" class="nav-link"><i class="fas fa-money-check"></i>  Crédit</a>
          </li>

          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Paramètre</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('fournisseur') }}" class="dropdown-item">  <i class="fa fa-users"></i>  Fournisseur </a></li>
              <li class="dropdown-divider"></li>
              <li><a href="{{ route('personnel') }}" class="dropdown-item">  <i class="fa fa-users"></i>  Personnel</a></li>
              <li class="dropdown-divider"></li>
              <li><a href="{{ route('user') }}" class="dropdown-item">  <i class="fa fa-users"></i>  Utilisateur</a></li>
            


              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Outils</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                 

                  <li><a href="index.php?action=box" class="dropdown-item">  <i class="fa fa-box"></i> Boite </a></li>
             
                  <li><a href="{{ route('fonction') }}" class="dropdown-item">  <i class="fa fa-list"></i> Fonction </a></li>
                
                  <li><a href="{{ route('site') }}" class="dropdown-item"> <i class="fa fa-globe-americas"></i>  Les sites</a></li>
                
                  <li><a href="{{ route('espece') }}" class="dropdown-item">  <i class="fa fa-kiwi-bird"></i> Especes</a></li>
                
                  <li><a href="{{ route('bloc') }}" class="dropdown-item"> <i class="fa fa-shoe-prints"></i> Parcelles</a></li>
                
                  <li><a href="{{ route('motifplante') }}" class="dropdown-item"> <i class="fa fa-pepper-hot"></i> Motif Plante</a></li>
                 
                  <li><a href="{{ route('motifstock') }}" class="dropdown-item"> <i class="fa fa-pepper-hot"></i> Motif Stock</a></li>
              
                  <li><a href="{{ route('motifdepense') }}" class="dropdown-item"> <i class="fa fa-pepper-hot"></i> Motif depense</a></li>
                  
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
            0            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
            <a href="index.php?action=historique" class="dropdown-item dropdown-footer">Voir tout l'historique</a>
          </div>
        </li>
      
        <li class="nav-item">
          <a class="nav-link"  href="{{ route('logout') }}" onclick="if(window.confirm('Attention ! Voulez-vous vous deconnecter ')){return true;}else{return false;}" title="Se deconnecter"><i
              class=" fas fa-sign-out-alt"></i></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <div class="content-wrapper">
