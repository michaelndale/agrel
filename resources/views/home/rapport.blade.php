@extends('layout/app')
@section('page-content')
<div class="content-wrapper">
    <div class="content">
        <div class="container">
            <div class="row">
                <div id="message" class="form-group col-md-12"></div>
                <div class="col-5" style="margin:auto">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('rechercher') }}">
                                @method('post')
                                @csrf
                                <div class="row">

                                    <div class="form-group col-lg-12 mb-1">
                                        <label for="example-text-input" class="col-form-label">Operation</label>
                                        <select class="form-control" type="text" name="operation" required>
                                            <option disabled="true" selected="true">--Aucun--</option>
                                            <option value="Tout">Tout</option>
                                            <option value="Entrer animal">Entrer Animal</option>
                                            <option value="Sortie animal">Sortie Animal</option>
                                            <option value="Entrer produit">Entrer Produit</option>
                                            <option value="Sortie produit">Sortie Produit</option>
                                            <option value="Depense generale">Depense generale</option>
                                            <option value="Payement salaire">Payement salaire</option>
                                            <option value="Credit">Credit</option>

                                        </select>
                                    </div>

                                   <!-- <div class="form-group col-lg-6 mb-1">
                                        <label for="example-text-input" class="col-form-label">Date debut</label>
                                        <input class="form-control" type="date" name="dateone">
                                    </div>

                                    <div class="form-group col-lg-6 mb-1">
                                        <label for="example-text-input" class="col-form-label">Date fin</label>
                                        <input class="form-control" type="date" name="datedeux">
                                    </div>  -->


                                </div>
                        </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button>
                        </form>
                    </div>
                </div>


                @if (isset($alldata))
                <div class="col-12">
                    <BR>
                </div>
                @if (isset($entreanimal))
                <div class="col-12">
                    <H6>Operation Entrer animal.</H6>
                    <div class="card card-primary card-outline">
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
                                @forelse ($entreanimal as $Entreanimals)
                                <tr>
                                    <th>{{ $n }}</th>
                                    <td>{{ $Entreanimals->libelle }}</td>
                                    <td>{{ $Entreanimals->numero }}</td>
                                    <td class="align:right">{{ number_format($Entreanimals->quantitea,0, ',', ' ')  }}</td>
                                    <td>{{ ucfirst($Entreanimals->statutid) }}</td>
                                    <td>{{ ucfirst($Entreanimals->nom) }}</td>
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
                @endif


                @if (isset($sortieanimal))

                <div class="col-12">
                    <H6>Operation sortie animal.</H6>
                    <div class="card card-primary card-outline">
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

                @endif



                @if (isset($Entrestock))

                <div class="col-12">
                    <H6>Operation entrer animal.</H6>
                    <div class="card card-primary card-outline">
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
                </div>

                @endif


                @if (isset($Sortiestocks))
                <div class="col-12">
                    <H6>Operation sortie produit</H6>
                    <div class="card card-primary card-outline">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Motif</th>
                                    <th>Statut</th>
                                    <th>Quantite</th>
                                    <th>Client</th>
                                    <th>Note</th>
                                    <th>Date E.S</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $n=1;
                                @endphp
                                @forelse ($Sortiestocks as $Sortiestockss)
                                <tr>
                                    <th>{{ $n }}</th>
                                    <td>{{ $Sortiestockss->libelle }}</td>
                                    <td>{{ $Sortiestockss->statutid }}</td>
                                    <td class="align:right">{{ number_format($Sortiestockss->quantite,0, ',', ' ')  }} {{ $Sortiestockss->unitemesure }}</td>
                                    <td>{{ ucfirst($Sortiestockss->client) }}</td>
                                    <td>{{ ucfirst($Sortiestockss->note) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($Sortiestockss->date))   }} </td>
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

                @endif


                @if (isset($depense))

                <div class="col-12">
                    <H6>Operation Depense generale</H6>
                    <div class="card card-primary card-outline">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Motif</th>
                                    <th>Montant</th>
                                    <th>Note</th>
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $n=1;
                                @endphp
                                @forelse ($depense as $depenses)
                                <tr>
                                    <th>{{ $n }}</th>
                                    <td>{{ $depenses->libelle }}</td>
                                    <td class="align:right">{{ number_format($depenses->montant,0, ',', ' ')  }} BIF </td>
                                    <td>{{ $depenses->note }} </td>
                                    <td>{{ date('d-m-Y', strtotime($depenses->date))   }} </td>


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

                @endif



                @if (isset($salaire ))

                <div class="col-12">
                    <H6>Operation payement salaire</H6>
                    <div class="card card-primary card-outline">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom & Prénom</th>
                                    <th>Montant</th>
                                    <th>Mois & Année</th>
                                    <th>Note</th>
                                    <th>Date</th>

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

                @endif


                @if (isset($credit))

                <div class="col-12">
                    <H6>Operation credit</H6>
                    <div class="card card-primary card-outline">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Motif du crédit</th>
                                    <th>Montant</th>
                                    <th>Reste à payer</th>
                                    <th>Date</th>
                                    <th>Statut</th>

                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($credit as $key => $value)
                                <tr>
                                    <td>{{ ucfirst($value->motifid) }} </td>
                                    <td>{{ number_format($value->montant,0, ',', ' ') }} </td>
                                    <td>{{ number_format($value->montant-$value->montantdonne,0, ',', ' ')  }} </td>
                                    <td>{{ date('d-m-Y', strtotime($value->created_at))   }} </td>
                                    <td>{{$value->statut }} </td>

                                </tr>
                                @empty

                                <tr>
                                    <td colspan="6">

                                        <center>Ceci est vide </center>

                                    </td>

                                </tr>

                                @endforelse


                            </tbody>
                        </table>

                    </div>
                </div>


                @endif

                @else
                <div class="col-12" style="margin:auto ; color:#c0c0c0">
                    <center>
                        <br>
                        <font size="20px"><i class="far fa-trash-alt"></i></font>
                        <br>
                        Entrer les elements de la recherche
                    </center>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection