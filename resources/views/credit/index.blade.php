@extends('layout/app')
@section('page-content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-users"></i> Credit contracte </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Credit contracte</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Credit contracte</a> </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="#"> <i class="fa fa-plus-circle"></i> Nouvelle </a>
                                </div>
                            </div>
                        </div>
                        <div id="message" class="form-group col-md-6"></div>

                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Motif du crédit</th>
                                    <th>Montant</th>
                                    <th>Reste à payer</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Action</th>
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
                                    <td>

                                    <div class="card-footer">
                                        <div class="row">
                                          <!--  <div class="col-sm">
                                            <a href=""
                                        class="btn btn-primary btn-sm">Edit</a>
                                            </div>  -->
                                            <div class="col-sm">
                                                <form action="{{ route('deletecredit', $value->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                       
                                    </td>
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
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="myModal7" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="color-line"></div>
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fa fa-user-plus"> </i> Nouveau Credit contracte</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('storecredit') }}">
                        @method('post')
                        @csrf
                        <div class="row">



                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Motif du crédit</label>
                                <textarea class="form-control" type="text" name="motif" id="motif" placeholder="motif" required></textarea>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Montant</label>
                                <input class="form-control" type="number" min="1" name="montant" id="montant" placeholder="Montant" required>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Montant déjà payé</label>
                                <input class="form-control" type="number" min="0" value="0" name="montantpayer" id="montantpayer" placeholder="Montant" required>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Date</label>
                                <input class="form-control" type="date" value="{{ date('d/m/Y') }}" name="datepaye" id="datepaye" placeholder="Date" required>

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Statut</label>
                                <select class="form-control" type="text" name="statut" id="stutut" placeholder="statut" required>
                                    <option value="">Aucune</option>
                                    <option value="Payé">Payé</option>
                                    <option value="Non Payé">Non Payé</option>
                                    <option value="Payé moitie">Payé moitie</option>
                                </select>

                            </div>



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
    @endsection