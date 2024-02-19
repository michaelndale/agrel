@extends('layout/app')
@section('page-content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-users"></i> Personnel </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Personnel</li>
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
                            <h3 class="card-title">Personnel</a> </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="#"> <i class="fa fa-user-plus"></i> Nouveau  </a>
                                </div>
                            </div>
                        </div>
                        <div id="message" class="form-group col-md-6"></div>
                        @if ($userData)
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($userData as $key => $value)
                                <tr>
                                    <td>{{ mb_strtoupper($value->nom) }} </td>
                                    <td>{{ mb_strtoupper($value->prenom) }} </td>
                                    <td>{{ mb_strtoupper($value->phone) }} </td>
                                    <td>{{ mb_strtoupper($value->created_at) }} </td>
                                </tr>
                                @empty

                                <tr>
                                    <td colspan="4">

                                        <center>La liste est vide </center>

                                    </td>

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
                    <h4 class="modal-title"> <i class="fa fa-user-plus"> </i> Nouveau Personnel</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('storepersonnel') }}">
                        @method('post')
                        @csrf
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Sites</label>
                                <select class="form-control" type="text" name="site" id="site" placeholder="sites" required>
                                <option  disabled="true" selected="true">--Aucun--</option>
                                @foreach ($site as  $sites)
                                    <option value="{{ $sites->id }}">{{ $sites->libelle }}</option>
                                @endforeach
                                </select>
                              
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Prenom</label>
                                <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Prenom" required>
                         
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="example-text-input" class="col-form-label">Nom</label>
                                <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom" required>
                            
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Telephone</label>
                                <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone" required>
                               
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