@extends('layout/app')
@section('page-content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2 col-12" style="margin:auto">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><small> <i class="fa fa-list"></i> Box </small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Box</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div id="message" class="form-group col-md-12"></div>
                <div class="col-12" style="margin:auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Box </a> </h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <a data-toggle="modal" data-target=".box" href="#"> <i class="fa fa-plus"></i> Nouveau box </a>
                                </div>
                            </div>
                        </div>
                        <div id="message" class="form-group col-md-6"></div>
                    
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                          
                            <tbody>
                                @forelse ($siteData as $key => $siteDatas)



                                <tr >
                                    <td  colspan='2' style="background-color:antiquewhite"> <b> <center>  <font color="background-color:antiquewhite">{{ $siteDatas->libelle }} </font> </center> </b> </td>
                                        @php
                                            $blocData = DB::table('blocs') 
                                            ->where('siteid',$siteDatas->id) 
                                            ->orderBy('id', 'ASC')
                                            ->get();
                                        @endphp
                                        <table class="table table-striped table-bordered">
                                        
                                            @foreach ($blocData as $blocDatas)
                                            <tr>
                                             <td colspan="2"> <b>{{ $blocDatas->libelle}}</b></td>
                                            </tr>
                                             @foreach ($spece as $speces)

                                             @php
                                                $boxData = DB::table('boxes')     
                                                ->where('animalid',$speces->id) 
                                                ->where('siteid',$siteDatas->id) 
                                                ->where('blocid',$blocDatas->id) 
                                                ->orderBy('id', 'ASC')
                                                ->get();
                                            @endphp
                                            <tr>
                                                        @if($boxData->count() >0 )
                                                        <td> 
                                                            {{ $speces->libelle }}
                                                        </td>
                                                        <td>
                                                                <table class="table table-striped table-bordered">
                                                             
                                                                <tr>
                                                                @foreach ($boxData as $boxDatas)
                                                            
                                                                <a class="btn btn-app">
                                                                    <i class="fas fa-box"></i>{{ $boxDatas->title }}
                                                                    </a>
                                                                @endforeach
                                                                </tr>  
                                                            
                                                            </table>
                                                        </td>
                                                        @endif
                                            </tr> 
                                        @endforeach
                                             </tr>
                                            @endforeach
                                            
                                        
                                        </table>
                                </tr>
                                       

                                     


                              
                                @empty
                                <tr>
                                    <td colspan="2">
                                        <center>Ceci est vide </center>
                                    <td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade box" id="myModalparcelle" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="color-line"></div>
                <form method="POST" action="{{ route('storebox') }}">

                    @method('post')
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fa fa-plus"> </i> Ajouter box</h4>

                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="form-group col-lg-12 mb-1">
                                <label class="col-form-label">Séléctionner le site </label>
                                <select class="form-control batiment" name="batiment" id="batiment">
                                    <option value=""> Séléctionner le Site</option>
                                    @foreach ($siteData as $siteDatas)
                                    <option value="{{ $siteDatas->id }}">  {{ $siteDatas->libelle }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group col-lg-12 mb-1" id="poll">

                                <label class="col-form-label">Séléctionner bloc </label>
                                <select class="form-control blocid" name="blocid" id="blocid" data-live-search="true">
                                    <option disabled="true" selected="true" value="">Séléctionner bloc</option>

                                </select>

                            </div>

                            <div class="form-group col-lg-12 mb-1">
                              

                                <label class="col-form-label">Spece Animal </label>
                                <select class="form-control spece" name="spece" id="spece">
                                    <option value=""> Séléctionner le Site</option>
                                    @foreach ($spece as $speces)
                                    <option value="{{ $speces->id }}">{{ $speces->libelle }}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="col-md-12 mb-1">
                                <label for="example-text-input" class="col-form-label">Libellé box</label>
                                <input class="form-control" type="text" id="libelle" name="libelle" placeholder="Libellé box">

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
        });
    </script>
    @endsection