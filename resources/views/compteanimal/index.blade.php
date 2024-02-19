@extends('layout/app')
@section('page-content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fas fa-torii-gate"></i> Animal Disponible </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active"> Animal Disponible</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <div id="message" class="form-group col-md-12"></div>

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list"></i>
                                Inventaire Animal
                            </h3>


                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">


                                <li class="nav-item">
                                    <a class="nav-link  active" id="custom-content-all-tab" data-toggle="pill" href="#custom-content-all" role="tab" aria-controls="custom-content-all" aria-selected="true">Tout</a>
                                </li>

                                @foreach ($site as $sites)
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-{{ $sites->libelle }}-tab" data-toggle="pill" href="#custom-content-{{ $sites->libelle }}" role="tab" aria-controls="custom-content-{{ $sites->libelle }}" aria-selected="true">{{ $sites->libelle }}</a>
                                </li>
                                @endforeach


                            </ul>


                            <div class="tab-content" id="custom-content-above-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-all" role="tabpanel" aria-labelledby="custom-content-all-tab">
                                {{ route('bienvenu') }}
                                    <div class="table-responsive">
                                        <br>
                                        <h5> Tout les stocks des sites confondues</h5>
                                        <table class="table table-striped table-bordered table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Libellé</th>
                                                    <th>Quantité</th>
                                                  

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $n=1;
                                                @endphp
                                                @forelse ($elementanimal as $elementanimals)
                                                <tr>
                                                    <th>{{ $n }}</th>
                                                    <td>{{ $elementanimals->libelle }}</td>
                                                    <td class="align:right">
                                                        @php
                                                        $idelement= $elementanimals->id;
                                                        $totalStocks= DB::table('compteanimals')
                                                        ->join('especes', 'compteanimals.motifa', '=', 'especes.id')
                                                        ->Where('motifa', $idelement)
                                                        ->SUM('quantite');


                                                        @endphp

                                                        @if($totalStocks)
                                                        {{ number_format($totalStocks,0, ',', ' ')  }}
                                                        @else
                                                        0
                                                        @endif



                                                    </td>
                                                   

                                                </tr>
                                                @php
                                                $n++;
                                                @endphp
                                                @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <center>Ceci est vide</center>
                                                    </td>
                                                </tr>

                                                @endforelse


                                            </tbody>
                                        </table>

                                    </div>


                                   

                                </div>

                                @foreach ($site as $sites)
                                    <div class="tab-pane fade show" id="custom-content-{{ $sites->libelle }}" role="tabpanel" aria-labelledby="custom-content-{{ $sites->libelle }}-tab">

                                        <br>
                                        <h5> Total générale des approvisionements disponible à <b>{{ $sites->libelle }}</b> </h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="myTable">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Libellé</th>
                                                    <th>Quantité</th>
                                                   

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                $n=1;
                                                @endphp
                                                @forelse ($elementanimal as $elementanimals)
                                                <tr>
                                                    <th>{{ $n }}</th>
                                                    <td>{{ $elementanimals->libelle }}</td>
                                                    <td class="align:right">
                                                        @php
                                                        $idelement= $elementanimals->id;
                                                        $totalStocks= DB::table('compteanimals')
                                                        ->join('especes', 'compteanimals.motifa', '=', 'especes.id')
                                                        ->Where('site', $sites->id)
                                                        ->Where('motifa', $idelement)
                                                        ->SUM('quantite');


                                                        @endphp

                                                        @if($totalStocks)
                                                        {{ number_format($totalStocks,0, ',', ' ')  }}
                                                        @else
                                                        0
                                                        @endif



                                                    </td>
                                                    

                                                </tr>
                                                @php
                                                $n++;
                                                @endphp
                                                @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <center>Ceci est vide</center>
                                                    </td>
                                                </tr>

                                                @endforelse


                                            </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    @endforeach




                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    @endsection