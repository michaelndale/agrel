@extends('layout/app')
@section('page-content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row col-5" style="margin:auto">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-list"></i> Motif stock </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home">Accueil</a></li>
                        <li class="breadcrumb-item active">Motif stock</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container">
            <div class="row col-5" style="margin:auto">
                <div id="message" class="form-group col-md-12"></div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Motif stock </a> </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="#"> <i class="fa fa-plus"></i> Nouvelle motif stock </a>
                                </div>
                            </div>
                        </div>
                        <div id="message" class="form-group col-md-6"></div>
                        @if ($motifData)
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Libelle</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($motifData as $key => $value)
                                <tr>
                                    <td>{{ ucfirst($value->libelle) }} </td>
                                </tr>
                                @empty

                                <tr>
                                    <td colspan="2">

                                        <center>La liste est vide </center>

                                    <td>

                                </tr>

                                @endforelse


                            </tbody>
                        </table>

                        @endif
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
                    <h4 class="modal-title"> <i class="fa fa-user-plus"> </i> Nouvelle Motif stock</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('storemotifstock') }}">
                        @method('post')
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Titre</label>
                                <input class="form-control" type="text" name="libelle" id="libelle" placeholder="libelle" required>
                               
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