@extends('layout/app')
@section('page-content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-users"></i> Gestion de salaire</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Salaire</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div id="message" class="form-group col-md-12"></div>

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list"></i>
                                Liste de versement de salaire

                            </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:voide()"> <i class="fa fa-plus-circle"></i> Ajouter </a>
                                </div>
                            </div>

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

                                    <div class="table-responsive">
                                        <br>
                                        <h5> Tout salaires des sites confondues</h5>
                                        <table class="table table-striped table-bordered table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nom & Prénom</th>
                                                    <th>Montant</th>
                                                    <th>Mois & Année</th>
                                                    <th>Note</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $n=1;
                                                @endphp
                                                @forelse ($salaire as $salaires)
                                                <tr>
                                                    <th>{{ $n }}</th>
                                                    <td>{{ ucfirst($salaires->nom) }} {{ ucfirst($salaires->prenom) }}</td>
                                                    <td class="align:right">{{ number_format($salaires->montant,0, ',', ' ')  }} BIF </td>
                                                    <td>{{ $salaires->mois }}-{{ $salaires->anne }}</td>
                                                
                                                    <td>{{ $salaires->note }} </td>
                                                    <td>{{ date('d-m-Y', strtotime($salaires->date))   }} </td>
                                                    <td>
                                                        <div class="card-footer">
                                                            <div class="row">
                                                                
                                                                <div class="col-sm">
                                                                    <form action="{{ route('deletesalaire', $salaires->id) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

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
                                    <h5>{{ $sites->libelle }}</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Motif</th>
                                                    <th>Montant</th>
                                                    <th>Note</th>
                                                    <th>Date</th>
                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php
                                                $n=1;
                                                $idsite= $sites->id;
                                                $salsites= DB::table('salaires')
                                                ->join('personnels', 'salaires.persid', '=', 'personnels.id')
                                                ->select('salaires.*', 'personnels.nom', 'personnels.prenom')
                                                ->where('site',$idsite)
                                                ->orderBy('id', 'ASC')
                                                ->get();
                                                @endphp

                                                @forelse ($salsites AS $salsite)
                                                <tr>
                                                <th>{{ $n }}</th>
                                                    <td>{{ ucfirst($salsite->nom) }} {{ ucfirst($salsite->prenom) }}</td>
                                                    <td class="align:right">{{ number_format($salsite->montant,0, ',', ' ')  }} BIF </td>
                                                    <td>{{ $salsite->mois }}-{{ $salsite->anne }}</td>
                                                    <td>{{ $salsite->note }} </td>
                                                    <td>{{ date('d-m-Y', strtotime($salsite->date))   }} </td>
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
    <div class="modal fade bd-example-modal-lg" id="myModal7" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="color-line"></div>
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fa fa-plus-circle"> </i> Nouveau payement </h4>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('storesalaire') }}">
                        @method('post')
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Site</label>
                                <select class="form-control" type="text" name="site" id="site" placeholder="Site" required>
                                    <option value="">Séléctionner le site</option>
                                    @foreach ($site as $sites)
                                    <option value="{{ $sites->id }}">{{ $sites->libelle }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Personnel</label>
                                <select class="form-control" type="text" name="persid" id="persid" placeholder="personnel" required>
                                    <option value="">Séléctionner le personnel</option>
                                    @foreach ($personnel as $personnels)
                                    <option value="{{ $personnels->id }}">{{ ucfirst($personnels->nom) }} {{ ucfirst($personnels->prenom) }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Mois payé</label>
                                <select class="form-control" type="text" id="mois"  name="mois"  >
                                    <option selected>Janvier</option>
                                    <option>Février</option>
                                    <option>Mars</option>
                                    <option>Avril</option>
                                    <option>Mai</option>
                                    <option>Juin</option>
                                    <option>Juillet</option>
                                    <option>Août</option>
                                    <option>Septembre</option>
                                    <option>Octobre</option>
                                    <option>Novembre</option>
                                    <option>Décembre</option>
                            </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Annee </label>
                                <input class="form-control" type="number" id="anne"  name="anne" value="{{ date('Y')}}" >

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Date du payement </label>
                                <input class="form-control" type="date" value="{{ date('d/m/Y') }}" name="date" id="date" placeholder="Date" required>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Montant payer</label>
                                <input class="form-control" type="number" id="montant"  name="montant" placeholder="Montant">

                            </div>

                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Note</label>
                                <textarea class="form-control" type="text" name="note" id="note" placeholder="note"></textarea>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuller</button>
                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    @endsection