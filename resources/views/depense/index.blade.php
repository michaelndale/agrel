@extends('layout/app')
@section('page-content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-users"></i> Dépense </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Dépense</li>
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
                                Liste Charge générale

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
                                        <h5> Tout Dépenses des sites confondues</h5>
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
                                                @endphp
                                                @forelse ($depense as $depenses)
                                                <tr>
                                                    <th>{{ $n }}</th>
                                                    <td>{{ $depenses->libelle }}</td>
                                                    <td class="align:right">{{ number_format($depenses->montant,0, ',', ' ')  }} BIF </td>
                                                    <td>{{ $depenses->note }} </td>
                                                    <td>{{ date('d-m-Y', strtotime($depenses->date))   }} </td>
                                                    <td>
                                                    <div class="card-footer">
                                        <div class="row">
                                          <!--  <div class="col-sm">
                                            <a href=""
                                        class="btn btn-primary btn-sm">Edit</a>
                                            </div>  -->
                                            <div class="col-sm">
                                                <form action="{{ route('deletedepense', $depenses->id) }}" method="post">
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
                                                    <th>Montant</th>
                                                    <th>Note</th>
                                                    <th>Date</th>
                                                    <!--<th >Action</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @php
                                                $ndale=1;
                                                    $idsite= $sites->id;
                                                    $Dépense= DB::table('depenses')
                                                                ->join('motifdepenses', 'depenses.motif', '=', 'motifdepenses.id')
                                                                ->select('depenses.*', 'motifdepenses.libelle')         
                                                                ->where('site',$idsite)
                                                                ->orderBy('id', 'ASC')
                                                                ->get();
                                                @endphp

                                                @forelse ($Dépense AS $Dépenses)
                                                <tr>
                                                    <th>{{ $ndale }}</th>
                                                    <td>{{ $depenses->libelle }}</td>
                                                    <td>{{ number_format($depenses->montant,0, ',', ' ') }} BIF </td>
                                                    <td>{{ $depenses->note }} </td>
                                                    <td>{{ date('d-m-Y', strtotime($depenses->created_at))   }}</td>
                                                </tr>
                                                @php
                                                    $ndale++;
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
                    <h4 class="modal-title"> <i class="fa fa-plus-circle"> </i> Nouvelle Dépense</h4>
                </div>
                <div class="modal-body">

                <form method="POST" action="{{ route('storedepense') }}">
                        @method('post')
                        @csrf
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
                                <label for="example-text-input" class="col-form-label">Motif du dépense</label>
                                <select class="form-control" type="text" name="motif" id="motif" placeholder="Motif" required>
                                    <option value="">Séléctionner le motif</option>
                                    @foreach ($motif as $motifs)
                                    <option value="{{ $motifs->id }}">{{ $motifs->libelle }}</option>
                                    @endforeach
                                    
                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Montant </label>
                                <input class="form-control" type="number" min="0" value="0" name="montant" id="montant" placeholder="Montant" required>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Date</label>
                                <input class="form-control" type="date" value="{{ date('d/m/Y') }}" name="date" id="date" placeholder="Date" required>

                            </div>

                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Note</label>
                                <textarea class="form-control" type="text"  name="note" id="note" placeholder="note"></textarea>

                            </div>

                        </div>
                        <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuller</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
    @endsection