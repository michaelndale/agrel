@extends('layout/app')
@section('page-content')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- =========================================================== -->
          <h5 class="mt-4 mb-2">Info global</h5>
          <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box bg-info">
                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Recettes </span>
                  <span class="info-box-number"> {{ number_format( $totalrecette,0, ',', ' ')  }} BIF </span>

                  <div class="progress">
                    <div class="progress-bar" style="width: {{ $pourcentage_recette}}%"></div>
                  </div>
                  <span class="progress-description">
                    Montant globale des recettes 
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>


            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box bg-info">
                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Depenses</span>
                  <span class="info-box-number">{{ number_format( $totaldepense,0, ',', ' ')  }} BIF </span>

                  <div class="progress">
                    <div class="progress-bar" style="width: {{ $pourcentage_depense}}%"></div>
                  </div>
                  <span class="progress-description">
                    Montant globale des depenses 
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            @if ($totalrecette>$totaldepense)
            @php
            $color='success';
            @endphp
            @else
            @php
            $color='danger';
            @endphp
            @endif


            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box bg-{{ $color}}">
                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">La ballance</span>
                  <span class="info-box-number">{{ number_format( $totalrecette-$totaldepense,0, ',', ' ')  }} BIF</span>

                  <div class="progress">

                  @php
                   $ballance = $totalrecette-$totaldepense ;
                   $dballance = $totalrecette+$totaldepense ;
                   $pb = round($ballance*100)/$dballance ;
                  @endphp

                    <div class="progress-bar" style="width: {{ $pb }}%"></div>
                  </div>
                  <span class="progress-description">
                    La difference 
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Rapport montant globale repartie</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->

                <!-- ./card-body -->

                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      @php
                      
                      if($totalrecette==0){
                        $poucetagerectte =0;
                      }else{
                        $poucetagerectte= round(($recetteproduit*100)/$totalrecette);
                      }

                      if($poucetagerectte>70 and $poucetagerectte<100){ $coloriconrecette="success" ; }elseif($poucetagerectte>50 and $poucetagerectte<50){ $coloriconrecette="warning" ; }else{ $coloriconrecette="danger" ; } @endphp <div class="description-block border-right">
                          <span class="description-percentage text-{{ $coloriconrecette }}"><i class="fas fa-caret-up"></i> {{ $poucetagerectte }}%</span>
                          <h5 class="description-header">{{ number_format( $recetteproduit,0, ',', ' ')  }} BIF</h5>
                          <span class="description-text">Recette produit</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->

                  @php
                 

                  if($totalrecette==0){
                      $Precetteanimal =0;
                      }else{
                        $Precetteanimal= round(($recetteanimal*100)/$totalrecette);
                      }

                  if($Precetteanimal>70 and $Precetteanimal<100){ $coloriconrecettea="success" ; }elseif($Precetteanimal>50 and $Precetteanimal<50){ $coloriconrecettea="warning" ; }else{ $coloriconrecettea="danger" ; } @endphp 
                  
                  <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-{{ $coloriconrecettea }}"><i class="fas fa-caret-left"></i> {{ $Precetteanimal }}%</span>
                        <h5 class="description-header">{{ number_format( $recetteanimal,0, ',', ' ')  }} BIF</h5>
                        <span class="description-text">RECETTE DES ANIMAUX</span>
                      </div>
                      <!-- /.description-block -->
                </div>
                <!-- /.col -->

                @php
                if($totaldepense==0){
                  $Pdengen=0;
                      }else{
                        $Pdengen= round(($depensegenerale*100)/$totaldepense);
                      }

                
                if($Pdengen>70 and $Pdengen<100){ $coloriconrecettedg="success" ; }elseif($Pdengen>50 and $Pdengen<50){ $coloriconrecettedg="warning" ; }else{ $coloriconrecettedg="danger" ; } @endphp <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-{{ $coloriconrecettedg }}"><i class="fas fa-caret-up"></i> {{ $Pdengen }}%</span>
                      <h5 class="description-header">{{ number_format( $depensegenerale,0, ',', ' ')  }} BIF</h5>
                      <span class="description-text">DEPENSE GENERALE</span>
                    </div>
                    <!-- /.description-block -->
              </div>
              <!-- /.col -->

              @php
              
              if($totaldepense==0){
                $Pdensal=0;
                      }else{
                        $Pdensal= round(($depensesalaire*100)/$totaldepense);

                      }


              if($Pdensal>70 and $Pdensal<100){ $coloriconrecettsal="success" ; }elseif($Pdensal>50 and $Pdensal<50){ $coloriconrecettsal="warning" ; }else{ $coloriconrecettsal="danger" ; } @endphp <div class="col-sm-3 col-6">
                  <div class="description-block">
                    <span class="description-percentage text-{{ $coloriconrecettsal }}"><i class="fas fa-caret-down"></i> {{ $Pdensal }}%</span>
                    <h5 class="description-header">{{ number_format( $depensesalaire,0, ',', ' ')  }} BIF</h5>
                    <span class="description-text">DEPENSE SUR LES SALAIRES</span>
                  </div>
                  <!-- /.description-block -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>


<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Rapport credit </h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>

          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->

      <!-- ./card-body -->
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 col-6">
            <div class="description-block border-right">
              <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 100%</span>
              <h5 class="description-header">{{ number_format($totalcredit,0, ',', ' ')  }} BIF </h5>
              <span class="description-text">TOTAL CREDIT CONTRACTE</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          @php
          


          if($totalcredit==0){
            $Ptotalcredit=0;
                      }else{
                        $Ptotalcredit= round(($totalpayer*100)/$totalcredit);

                      }

          if($Ptotalcredit>70 and $Ptotalcredit<100){ $coloriconcreditp="success" ; }elseif($Ptotalcredit>50 and $Ptotalcredit<50){ $coloriconcreditp="warning" ; }else{ $coloriconcreditp="danger" ; } @endphp <div class="col-sm-4 col-6">
              <div class="description-block border-right">
                <span class="description-percentage text-{{ $coloriconcreditp }}"><i class="fas fa-caret-left"></i> {{ $Ptotalcredit }}%</span>
                <h5 class="description-header">{{ number_format($totalpayer,0, ',', ' ')  }} BIF </h5>
                <span class="description-text">CREDIT PAYER</span>
              </div>
              <!-- /.description-block -->
        </div>
        <!-- /.col -->

        @php
       

        if($totalcredit==0){
          $PtotalcreditNP=0;
                      }else{
                        $PtotalcreditNP= round(($nonpayer*100)/$totalcredit);

                      }


        if($PtotalcreditNP >70 and $PtotalcreditNP<100){ $coloriconcreditNP="success" ; }elseif($PtotalcreditNP>50 and $PtotalcreditNP<50){ $coloriconcreditNP="warning" ; }else{ $coloriconcreditNP="danger" ; } @endphp <div class="col-sm-4 col-6">

            <span class="description-percentage text-{{ $coloriconcreditNP }}"><i class="fas fa-caret-up"></i> {{ $PtotalcreditNP }} %</span>
            <h5 class="description-header">{{ number_format($nonpayer,0, ',', ' ')  }} BIF </h5>
            <span class="description-text">CREDIT NON PAYER</span>
      </div>


      <!-- /.description-block -->
    </div>
    <!-- /.col -->

  </div>
  <!-- /.row -->
</div>
<!-- /.card-footer -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Rapport reccete & depense mois encours</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>

          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->

      <!-- ./card-body -->
      <div class="card-footer">
        <div class="row">


          <div class="col-sm-3 col-6">
            @php
            

            if($totalrecetteM==0){
              $poucetagerectteM=0;
                      }else{
                        $poucetagerectteM= round(($recetteproduitM*100)/$totalrecetteM);

                      }



            if($poucetagerectteM>70 and $poucetagerectteM<100){ $coloriconrecetteM="success" ; }elseif($poucetagerectteM>50 and $poucetagerectteM<50){ $coloriconrecetteM="warning" ; }else{ $coloriconrecetteM="danger" ; } @endphp <div class="description-block border-right">
                <span class="description-percentage text-{{ $coloriconrecetteM }}"><i class="fas fa-caret-up"></i> {{ $poucetagerectteM }}%</span>
                <h5 class="description-header">{{ number_format( $recetteproduitM,0, ',', ' ')  }} BIF</h5>
                <span class="description-text">Recette produit</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->







        @php
        
        if($totalrecetteM==0){
          $PrecetteanimalM=0;
                      }else{
                        $PrecetteanimalM= round(($recetteanimalM*100)/$totalrecetteM);


                      }

        if($PrecetteanimalM>70 and $PrecetteanimalM<100){ $coloriconrecetteaM="success" ; }elseif($PrecetteanimalM>50 and $PrecetteanimalM<50){ $coloriconrecetteaM="warning" ; }else{ $coloriconrecetteaM="danger" ; } @endphp <div class="col-sm-3 col-6">
            <div class="description-block border-right">
              <span class="description-percentage text-{{ $coloriconrecetteaM }}"><i class="fas fa-caret-left"></i> {{ $PrecetteanimalM }}%</span>
              <h5 class="description-header">{{ number_format( $recetteanimalM,0, ',', ' ')  }} BIF</h5>
              <span class="description-text">RECETTE DES ANIMAUX</span>
            </div>
            <!-- /.description-block -->
      </div>
      <!-- /.col -->

      @php
     
      if($totaldepenseM==0){
        $PdengenM=0;
                      }else{
                        $PdengenM= round(($depensegeneraleM*100)/$totaldepenseM);



                      }


      if($PdengenM>70 and $PdengenM<100){ $coloriconrecettedgM="success" ; }elseif($PdengenM>50 and $PdengenM<50){ $coloriconrecettedgM="warning" ; }else{ $coloriconrecettedgM="danger" ; } @endphp <div class="col-sm-3 col-6">
          <div class="description-block border-right">
            <span class="description-percentage text-{{ $coloriconrecettedgM }}"><i class="fas fa-caret-up"></i> {{ $PdengenM }}%</span>
            <h5 class="description-header">{{ number_format( $depensegeneraleM,0, ',', ' ')  }} BIF</h5>
            <span class="description-text">DEPENSE GENERALE</span>
          </div>
          <!-- /.description-block -->
    </div>
    <!-- /.col -->

    @php
   

    if($totaldepenseM==0){
      $PdensalM=0;
                      }else{
                        $PdensalM= round(($depensesalaireM*100)/$totaldepenseM);



                      }


    if($PdensalM>70 and $PdensalM<100){ $coloriconrecettsalM="success" ; }elseif($PdensalM>50 and $PdensalM<50){ $coloriconrecettsalM="warning" ; }else{ $coloriconrecettsalM="danger" ; } @endphp <div class="col-sm-3 col-6">
        <div class="description-block">
          <span class="description-percentage text-{{ $coloriconrecettsalM }}"><i class="fas fa-caret-down"></i> {{ $PdensalM }}%</span>
          <h5 class="description-header">{{ number_format( $depensesalaireM,0, ',', ' ')  }} BIF</h5>
          <span class="description-text">DEPENSE SUR LES SALAIRES</span>
        </div>
        <!-- /.description-block -->
  </div>


</div>
<!-- /.row -->
</div>
<!-- /.card-footer -->
</div>
<!-- /.card -->
</div>
<!-- /.col -->
</div>


<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Le plus vendues</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>

          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-5">
            <p class="text-center">
              <strong>Produit le plus vendu </strong>
            </p>

            @foreach ($elementproduit as $elementproduits)
            <div class="progress-group">
              {{ $elementproduits->libelle }}

              @php

              $idelement= $elementproduits->id;
              $produittotalStocks= DB::table('stocks')
              ->Where('motifid', $idelement)
              ->SUM('quantite');

              $produitvendutotalStocks= DB::table('sortiestocks')
              ->Where('motifid', $idelement)
              ->SUM('quantite');

              $allproduit= $produittotalStocks+$produitvendutotalStocks;

              if($allproduit==0){
              $allproduitpour=0;
              }else{
              $allproduitpour = round(($produitvendutotalStocks*100))/$allproduit;
              }

              if($allproduitpour > 70 and $allproduitpour <= 100){ $colorventeproduit="success" ; }elseif( $allproduitpour >= 50 and $allproduitpour < 50){ $colorventeproduit="info" ; }else{ $colorventeproduit="danger" ; }
              @endphp 
              
              <span class="float-right"><b>{{ $produitvendutotalStocks }}</b> / {{ $allproduit }} </span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-{{ $colorventeproduit }}" style="width:{{ $allproduitpour }}%"></div>
                  </div>
            </div>
            @endforeach










          </div>

          <div class="col-md-2">
          </div>

          <div class="col-md-5">
            <p class="text-center">
              <strong>Animal le plus vendu </strong>
            </p>


            @foreach ($elementanimal as $elementanimals)

                <div class="progress-group">
                  {{$elementanimals->libelle}}

                  @php
                  $idelement= $elementanimals->id;
                  $totalStocksanimal= DB::table('compteanimals')
                  ->Where('motifa', $idelement)
                  ->SUM('quantite');

                  $animalvendutotalStocks= DB::table('sortieanimals')
                  ->Where('animalid', $idelement)
                  ->SUM('quantite');

                  $allanimal= $totalStocksanimal+$animalvendutotalStocks ;

                  if($allanimal==0){
                    $allanimalpour =0;
                  }else{
                  $allanimalpour = round(($animalvendutotalStocks*100))/$allanimal;

                  
                  }
                  if($allanimalpour > 70 and $allanimalpour <= 100){ $colorventean ="success" ; } elseif( $allanimalpour >= 50 and $allanimalpour < 70){ $colorventean="info" ; }else{ $colorventean="danger" ; } 
                 

                  @endphp
                  <span class="float-right"><b>{{ $animalvendutotalStocks }}</b>/{{ $allanimal }} </span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-{{ $colorventean }}" style="width: {{ $allanimalpour }}%"></div>
                  </div>
                </div>

           


            @endforeach






          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- ./card-body -->
      <div class="card-footer">
        <div class="row">

        <div class="col-sm-6 col-6">
                      @php
                      

                      if($totalrecette==0){
                        $poucetagerectte=0;
                      }else{
                        $poucetagerectte= round(($recetteproduit*100)/$totalrecette);



                      }


                      if($poucetagerectte>70 and $poucetagerectte<100){ $coloriconrecette="success" ; }elseif($poucetagerectte>50 and $poucetagerectte<50){ $coloriconrecette="warning" ; }else{ $coloriconrecette="danger" ; } @endphp <div class="description-block border-right">
                          <span class="description-percentage text-{{ $coloriconrecette }}"><i class="fas fa-caret-up"></i> {{ $poucetagerectte }}%</span>
                          <h5 class="description-header">{{ number_format( $recetteproduit,0, ',', ' ')  }} BIF</h5>
                          <span class="description-text">Recette produit</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->

                  @php
                  

                  if($totalrecette==0){
                    $Precetteanimal=0;
                      }else{
                        $Precetteanimal= round(($recetteanimal*100)/$totalrecette);



                      }
                  if($Precetteanimal>70 and $Precetteanimal<100){ $coloriconrecettea="success" ; }elseif($Precetteanimal>50 and $Precetteanimal<50){ $coloriconrecettea="warning" ; }else{ $coloriconrecettea="danger" ; } @endphp 
                  
                  <div class="col-sm-6 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-{{ $coloriconrecettea }}"><i class="fas fa-caret-left"></i> {{ $Precetteanimal }}%</span>
                        <h5 class="description-header">{{ number_format( $recetteanimal,0, ',', ' ')  }} BIF</h5>
                        <span class="description-text">RECETTE DES ANIMAUX</span>
                      </div>
                      <!-- /.description-block -->
                </div>
         


        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
  <i class="fas fa-chevron-up"></i>
</a>
</div>

@endsection