@extends('layout/app')
@section('page-content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-list"></i> Historique sortie animal </small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Sortie animal</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div id="message" class="form-group col-md-12"></div>

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list"></i>
                                Historique sortie animal
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
                                        <h5> Tout stocs des sites confondues</h5>
                                        <table class="table table-striped table-bordered table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Animal</th>
                                                    <th>Numéro</th>
                                                    <th>Quantité</th>
                                                    <th>Statut</th>
                                                    <th>Nom</th>
                                                    <th>Fournisseur</th>
                                                    <th>Note</th>
                                                    <th>Date E.E</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $n=1;
                                                @endphp
                                                @forelse ($sortieanimal as $Entreanimals)
                                                <tr>
                                                    <th>{{ $n }}</th>
                                                    <td>{{ $Entreanimals->libelle }}</td>
                                                    <td>{{ $Entreanimals->numero }}</td>
                                                    <td class="align:right">{{ number_format($Entreanimals->quantite,0, ',', ' ')  }}</td>
                                                    <td>{{ ucfirst($Entreanimals->statut) }}</td>
                                                    <td>{{ ucfirst($Entreanimals->client) }}</td>
                                                    <td>{{ ucfirst($Entreanimals->sexe) }}</td>
                                                    <td>{{ ucfirst($Entreanimals->note) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($Entreanimals->date))   }} </td>
                                                </tr>
                                                @php
                                                $n++;
                                                @endphp
                                                @empty
                                                <tr>
                                                    <td colspan="9">
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
                                                    <th>Animal</th>
                                                    <th>Numéro</th>
                                                    <th>Client</th>
                                                    <th>Quantité</th>
                                                    <th>Prix Unite</th>
                                                    <th>Total</th>
                                                    <th>Note</th>
                                                    <th>Date E.E</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $ndale=1;
                                                $idsite= $sites->id;
                                                $stoc= DB::table('sortieanimals')
                                                        ->join('especes', 'sortieanimals.animalid', '=', 'especes.id')
                                                        ->select('sortieanimals.*', 'especes.libelle')   
                                                        ->where('site',$idsite)      
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
                                                
                                                @endphp
                                                @forelse ($stoc AS $stocs)
                                                <tr>
                                                    <th>{{ $ndale }}</th>
                                                    <td>{{ $stocs->libelle }}</td>
                                                    <td>{{ $stocs->numero }}</td>
                                                    <td class="align:right">{{ $stocs->quantite }} </td>
                                                    <td class="align:right">{{ number_format($stocs->prixunite,0, ',', ' ')  }} </td>
                                                    <td class="align:right">{{  $stocs->quantite*$stocs->prixunite  }} </td>
                                                    <td>{{ ucfirst($stocs->statut) }}</td>
                                                    <td>{{ ucfirst($stocs->client) }}</td>
                                                    <td>{{ ucfirst($stocs->sexe) }}</td>
                                                    <td>{{ ucfirst($stocs->note) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($stocs->date))   }} </td>
                                                </tr>
                                                @php
                                                $ndale++;
                                                @endphp
                                                @empty
                                                <tr>
                                                    <td colspan="9">
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


    <div class="modal fade bd-example-modal-lg" id="myModalparcelle" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="color-line"></div>
                <form method="POST" id="forme_parcelle" action="{{ route('storesortiesanimal') }}">
                    @method('post')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fa fa-plus-circle"> </i> Nouvelle sortie </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6 mb-1">
                                <label class="col-form-label">Séléctionner le site </label>
                                <select class="form-control batiment" name="batiment">
                                    <option value=""> Séléctionner le Site</option>
                                    @foreach ($site as $sites)
                                    <option value="{{ $sites->id }}">  {{ $sites->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6 mb-1" id="poll">
                                <label class="col-form-label">Séléctionner bloc </label>
                                <select class="form-control blocid" name="blocid" id="blocid" data-live-search="true">
                                    <option disabled="true" selected="true" value="">Séléctionner bloc</option>
                                </select>
                            </div>


                            <div class="form-group col-lg-6 mb-1">
                                <label class="col-form-label">Séléctionner animal </label>
                                <select class="form-control espece" name="espece">
                                    <option value=""> Séléctionner espece</option>
                                    @foreach ($espece as $especes)
                                    <option value="{{ $especes->id }}"> {{ $especes->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6 mb-1" id="pollbox">
                                <label class="col-form-label">Séléctionner box </label>
                                <select class="form-control boxid" name="boxid" id="boxid" data-live-search="true">
                                    <option disabled="true" selected="true" value="">Séléctionner box</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-1">
                                <label for="example-text-input" class="col-form-label">Numéro ou nom</label>
                                <input class="form-control" type="text" id="nom" name="nom" placeholder="Numéro ou nom">
                            </div>


                            <div class="form-group col-lg-6 mb-1">
                                <label class="col-form-label">Séléctionner statut </label>
                                <select class="form-control" name="statut">
                                    <option value=""> Séléctionner statut</option>
                                    @foreach ($statut as $statuts)
                                    <option value="{{ $statuts->libelle }}"> {{ $statuts->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6 mb-1">
                                <label class="col-form-label">Séléctionner sexe </label>
                                <select class="form-control sexe" name="sexe">
                                    <option value="">Aucun</option>
                                    <option value="Mâle">Mâle</option>
                                    <option value="Femelle">Femelle</option>
                                    <option value="Inconnue">Inconnue</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-1">
                                <label for="example-text-input" class="col-form-label">Date</label>
                                <input class="form-control" type="date" id="date" name="date" placeholder="Numéro ou nom">
                            </div>
                            <div class="form-group col-lg-12 mb-1">
                                <label for="example-text-input" class="col-form-label">Client</label>
                                <input class="form-control" type="text" id="client" name="client" placeholder="Client">
                            </div>

                            <div class="form-group col-lg-6 mb-1">
                                <label for="example-text-input" class="col-form-label">Quantite </label>
                                <input class="form-control" type="number" min="0" value="0" name="quantite" id="quantite" placeholder="quantite" required>
                            </div>

                            <div class="form-group col-lg-6 mb-1">
                                <label for="example-text-input" class="col-form-label">Montant</label>
                                <input class="form-control" type="number" min="0" value="0" name="prixunite" id="prixunite" placeholder="Montant" required>
                            </div>


                            <div class="col-md-12 mb-1">
                                <label for="example-text-input" class="col-form-label">Note</label>
                                <textarea class="form-control" type="text" id="note" name="note" placeholder="Note"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuller</button>
                        <button type="submit" id="envoie" name="envoie" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('change', '.batiment', function() {
                var cat_id = $(this).val();
                var div = $(this).parent();
                var op = " ";
                $.ajax({
                    type: 'get',
                    url: "{{ route ('findbloc') }}",
                    data: {
                        'id': cat_id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length == 0) {
                            op += '<option value="0" selected disabled>--Séléctionner bloc--</option>';
                            op += '<option value="0" selected disabled>Aucun </option>';
                            document.getElementById("blocid").innerHTML = op

                            alert("Attention!!\n le site n'a pas de bloc refferencer ! " + cat_id);

                        } else {
                            op += '<option value="0" selected disabled>--Séléctionner bloc--</option>';
                            for (var i = 0; i < data.length; i++) {
                                op += '<option value="' + data[i].id + '">' + data[i].libelle + '</option>';
                                document.getElementById("blocid").innerHTML = op
                            }
                        }

                    },
                    error: function() {
                        alert("Attention! \n Erreur de connexion a la base de donnee ,\n verifier votre connection");
                    }
                });
            });

            $(document).on('change', '.espece', function() {
                var ani = $(this).val();
                var batiment = $(".batiment").val();
                var blocid = $(".blocid").val(); 
                var espece = $(".espece").val(); 

                var div = $(this).parent();
                var op = " ";
                $.ajax({
                    type: 'get',
                    url: "{{ route ('findbox') }}",
                    data: {
                        'id': ani,
                        'batiment': batiment,
                        'blocid': blocid,
                        'espece': espece
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length == 0) {
                            op += '<option value="0" selected disabled>--Séléctionner box--</option>';
                            op += '<option value="0" selected disabled>Aucun </option>';
                            document.getElementById("boxid").innerHTML = op

                            alert("Attention!!\n animal n'a pas de box refferencer ! " + ani);


                        } else {
                            op += '<option value="0" selected disabled>--Séléctionner box--</option>';
                            for (var i = 0; i < data.length; i++) {
                                op += '<option value="' + data[i].id + '">' + data[i].title + '</option>';
                                document.getElementById("boxid").innerHTML = op
                            }
                        }

                    },
                    error: function() {
                        alert("Attention! \n Erreur de connexion a la base de donnee ,\n verifier votre connection");
                    }
                });
            });
        });
    </script>

    @endsection