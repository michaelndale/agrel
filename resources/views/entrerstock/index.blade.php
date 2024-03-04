@extends('layout/app')
@section('page-content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-list"></i> Historique entrer stock </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Entrer dans le stock</li>
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
                                Historique entrer stock

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
                                                    <th>Motif</th>
                                                    <th>Statut</th>
                                                    <th>Quantite</th>
                                                    <th>Fournisseur</th>
                                                    <th>Note</th>
                                                    <th>Date E.S</th>
                                                    <!-- <th >Action</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $n=1;
                                                @endphp
                                                @forelse ($Entrestock as $Entrestocks)
                                                <tr>
                                                    <th>{{ $n }}</th>
                                                    <td>{{ $Entrestocks->libelle }}</td>
                                                    <td>{{ $Entrestocks->statutid }}</td>
                                                    <td class="align:right">{{ number_format($Entrestocks->quantite,0, ',', ' ')  }} {{ $Entrestocks->unitemesure }}</td>
                                                    <td>{{ ucfirst($Entrestocks->nom) }}</td>
                                                    <td>{{ ucfirst($Entrestocks->note) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($Entrestocks->date))   }} </td>
                                                    <!--  <td>
                                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm">
                                            <a href=""
                                        class="btn btn-primary btn-sm">Edit</a>
                                            </div>  
                                            <div class="col-sm">
                                                <form action="{{ route('deletestock', $Entrestocks->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                       -->
                                                    </td>

                                                </tr>
                                                @php
                                                $n++;
                                                @endphp
                                                @empty
                                                <tr>
                                                    <td colspan="7">
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
                                                    <th>Statut</th>
                                                    <th>Quantite</th>
                                                    <th>Fournisseur</th>
                                                    <th>Note</th>
                                                    <th>Date E.S</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php
                                                $ndale=1;
                                                $idsite= $sites->id;
                                                $stoc= DB::table('entrestocks')
                                                ->join('motifstocks', 'entrestocks.motifid', '=', 'motifstocks.id')
                                                ->join('fournisseurs', 'entrestocks.fournisseurid', '=', 'fournisseurs.id')
                                                ->select('entrestocks.*', 'motifstocks.libelle','motifstocks.unitemesure','fournisseurs.nom')
                                                ->where('site',$idsite)
                                                ->orderBy('id', 'DESC')
                                                ->get();

                                                @endphp

                                                @forelse ($stoc AS $stocs)
                                                <tr>
                                                    <th>{{ $ndale }}</th>
                                                    <td>{{ $stocs->libelle }}</td>
                                                    <td>{{ $stocs->statutid }}</td>
                                                    <td class="align:right">{{ number_format($stocs->quantite,0, ',', ' ')  }} {{ $stocs->unitemesure }}</td>
                                                    <td>{{ ucfirst($stocs->nom) }}</td>
                                                    <td>{{ ucfirst($stocs->note) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($stocs->date))   }} </td>
                                                </tr>
                                                @php
                                                $ndale++;
                                                @endphp
                                                @empty
                                                <tr>
                                                    <td colspan="7">
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
    <div class="modal fade bd-example-modal-lg" id="myModal7" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="exampleModalScrollableTitle">
    <form method="POST" action="{{ route('storestock') }}">
                        @method('post')
                        @csrf 
    <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="color-line"></div>
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fa fa-plus-circle"> </i> Nouvelle entrer en stock</h4>
                </div>
                <div class="modal-body">

                    
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Site</label>
                                <select class="form-control" type="text" name="site" id="site" placeholder="Site" required>
                                    <option value="">Séléctionner le site</option>
                                    @foreach ($site as $sites)
                                    <option value="{{ $sites->id }}">{{ $sites->libelle }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Motif du stock</label>
                                <select class="form-control" type="text" name="motif" id="motif" placeholder="Motif" required>
                                    <option value="">Séléctionner le motif</option>
                                    @foreach ($motifstock as $motifs)
                                    <option value="{{ $motifs->id }}">{{ $motifs->libelle }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Statut</label>
                                <select class="form-control" type="text" name="statut" id="statut" placeholder="statut" required>
                                    <option value="">Séléctionner le statut</option>
                                    @foreach ($statut as $statuts)
                                    <option value="{{ $statuts->libelle }}">{{ $statuts->libelle }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Fournisseur</label>
                                <select class="form-control" type="text" name="fournisseur" id="fournisseur" placeholder="Site" required>
                                    <option value="">Séléctionner le fournisseur</option>
                                    @foreach ($fournisseur as $fournisseurs)
                                    <option value="{{ $fournisseurs->id }}">{{ ucfirst($fournisseurs->nom) }}</option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Quantite </label>
                                <input class="form-control" type="number" min="0" value="0" name="quantite" id="quantite" placeholder="quantite" required>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Date entrer en stock</label>
                                <input class="form-control" type="date" value="{{ date('m/d/Y') }}" name="date" id="date" placeholder="Date" required>

                            </div>

                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Note</label>
                                <textarea class="form-control" type="text" name="note" id="note" placeholder="note"></textarea>

                            </div>
                    
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuller</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
        </form>
    </div>
   
</div>
@endsection