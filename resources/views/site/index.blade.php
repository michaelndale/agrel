@extends('layout/app')
@section('page-content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row col-6" style="margin:auto">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-list"></i> Sites </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Sites</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div id="message" class="form-group col-md-12"></div>
                <div class="col-6" style="margin:auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sites </a> </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <a data-toggle="modal" data-target=".bd-example-modal-lg" href="#"> <i class="fa fa-plus"></i> Nouveau site </a>
                                </div>
                            </div>
                        </div>
                        <div id="message" class="form-group col-md-6"></div>


                      





                        @if ($siteData)
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                              <tr>
                               
                                <th >Libelle</th>
                                <th >Mesure</th>   
                             
                              </tr>
                            </thead>
                            <tbody>

                            @forelse ($siteData as $key => $value) 
                             <tr> 
                              
                              <td>{{ mb_strtoupper($value->libelle) }} </td>
                              <td>{{ mb_strtoupper($value->sperficie) }} </td>
                           
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
                    <h4 class="modal-title"> <i class="fa fa-user-plus"> </i> Nouvelle Site</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('storesite') }}">
                     @method('post')
                     @csrf
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="example-text-input" class="col-form-label">Nom du site</label>
                                <input class="form-control" type="text" name="libelle" id="libelle" placeholder="libelle du site" required>
                                <span id="name_error" class="text-danger"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="example-email-input" class="col-form-label">Mesure</label>
                                <input class="form-control" type="text" name="mesure" id="mesure" placeholder="Mesure su site" id="mesure" value="0" required>
                                <span id="mesure_error" class="text-danger"></span>
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