@extends('layout/app')
@section('page-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><small> <i class="fa fa-shoe-prints"></i> Parcelle 
            
            
        
        </small>  </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('bienvenu') }}">Accueil</a></li>

              <li class="breadcrumb-item active">Parcelle</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container">

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="hpanel">
                    <div class="panel-heading">
                        <h4 class="header-title"> 

                        <button type="button" class="btn btn-primary mb-3 " data-toggle="modal" data-target=".bd-example-modal-lg"> <i class="fa fa-plus"></i> Créer un bloc 
                            </button>

                            <button type="button" class="btn btn-primary mb-3 " data-toggle="modal" data-target=".parcelle"> <i class="fa fa-plus"></i> Créer un parcelle
                            </button>

                         
                        </h4>
                    </div>
                    <div id="message" class="form-group col-md-12"></div> 
                        
                        <div class="panel-body" id="listebloc">
                        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="text-uppercase" style="border:1px solid black">
                <tr style="border:1px solid black">
                    <th style="border:1px solid black" >ID</th>
                    <th style="border:1px solid black">Site</th>           
                    <th style="border:1px solid black"></th>
                </tr>
            </thead>
            <tbody>
            @php
                $n=1;
                foreach ($siteData as $key => $value):
            @endphp
                    <tr>
                        <th style="border:1px solid black">{{ $n }}  </th>
                        <td style="border:1px solid black">{{ mb_strtoupper($value->libelle) }} <br>
                        {{ mb_strtoupper($value->sperficie) }} </td>
                        <td style="border:1px solid black">
                        <table class="table table-striped" style="border:1px solid black">
                                @php
                                    $idsite= $value->id;
                                    $parcelle= DB::table('blocs')->where('siteid',$idsite)->orderBy('id', 'ASC')->get();      
                                   
                                    if($parcelle):
                                        foreach ($parcelle as $key => $parcelles):
                                           
                                            @endphp
                                            <tr style="border:1px solid black">
                                                    <td style="border:1px solid black">{{ mb_strtoupper($parcelles->libelle) }} &nbsp; &nbsp; &nbsp; ( {{ $parcelles->superficie }} )</td> 
                                                    <td style="border:1px solid black">
                                                    @php  
                                                            $idparcelle= $parcelles->id ;
                                                            $idsite= $value->id;
                                                        
                                                            $parcebalc= DB::table('parcelles')
                                                                ->where('siteid',$idsite)
                                                                ->where('blocid',$idparcelle)
                                                                ->orderBy('id', 'ASC')->get();           
                                                        @endphp

                                                        <table class="table table-striped">
                                                                    @php
                                                                        if($parcebalc):
                                                                            foreach ($parcebalc as $key =>$parcebalcs):
                                                                    @endphp
                                                                                <tr style="border:1px solid black">
                                                                                    <td style="border:1px solid black"> {{ mb_strtoupper($parcebalcs->parcelle_libelle) }} &nbsp; &nbsp; &nbsp; ( {{ $parcebalcs->superficie }} )</td> 
                                                                                </tr>
                                                                    @php
                                                                            endforeach;
                                                                   
                                                                        endif;
                                                                         
                                                                    @endphp
                                                                </table>
                                                    </td>
                                                </tr>
                                            @php
                                        endforeach;
                                    endif;
                                
                            
                                @endphp
                            </table>
                        </td>
                    </tr>
                @php
                    $n++;
                endforeach
                @endphp
                
            </tbody>
        </table>
    </div>
                        </div>
                </div>
            </div>
    </div>
</div>
</div>
</div>
</div>
</div>









<div class="modal fade bd-example-modal-lg" id="myModalbloc" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <form method="POST" id="forme_bloc" action="{{ route('storebloc') }}">   
            @method('post')
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fa fa-plus"> </i> Nouvelle bloc </h4>
                   
                </div>
                <div class="modal-body">
              
                    <div class="row">

                    <div class="form-group col-lg-12">
                    <small class="font-bold"> Toutes les champs sont obligateur.</small> <br>
                            
                            <label class="col-form-label">Séléctionner le site </label>
                            <select class="form-control"  id="site_id" name="site_id" >
                                <option value="">Séléctionner le Site</option>
                                @foreach ($siteData as $siteDatas)
                                    <option value="{{  $siteDatas->id }}">{{  $siteDatas->libelle }}</option>
                                @endforeach
                                                            </select>
                                
                        </div>

                  
               
                        <div class="col-md-12 mb-3">
                            <label for="example-text-input" class="col-form-label">Libellé bloc</label>
                            <input class="form-control" type="text" id="name_bloc"  name="name_bloc" placeholder="Libellé bloc">
                            
                        </div> 

                        <div class="col-md-12 mb-3">
                            <br>
                            <label for="example-text-input" class="col-form-label">Superficie du bloc</label>
                            <input class="form-control" type="text" id="superficie_bloc"  name="superficie_bloc" placeholder="Supeficie du bloc">
                         
                        </div> 
                    </div>  
                    </div>        
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuller</button>
                    <button type="submit"  id="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
             </form>
            </div>
           
        </div>
    </div>


<div class="modal fade parcelle" id="myModalparcelle" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <form method="POST" id="forme_parcelle" action="{{ route('storeparcelle') }}">  

                @method('post')
                @csrf 

                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fa fa-plus"> </i> Ajouter parcelle</h4>
                
                </div>
                <div class="modal-body">
              
              <div class="row">

              <div class="form-group col-lg-12">
              <small class="font-bold"> Toutes les champs sont obligateur.</small> <br>
                      
                      <label class="col-form-label">Séléctionner le site </label>
                      <select class="form-control batiment"  name="batiment" >
                          <option value=""> Séléctionner le Site</option>
                          @foreach ($siteData as $siteDatas)
                                    <option value="{{ $siteDatas->id }}"> {{  $siteDatas->id }} {{  $siteDatas->libelle }}</option>
                                @endforeach
                        </select>
                        
                  </div>

                  <div class="form-group col-lg-12" id="poll">
                      
                      <label class="col-form-label">Séléctionner bloc </label>
                      <select class="form-control blocid"  name="blocid" id="blocid" data-live-search="true" >
                          <option disabled="true" selected="true"value="">Séléctionner bloc</option>
                        
                      </select>
                       
                  </div>
         
                  <div class="col-md-12 mb-3">
                      <label for="example-text-input" class="col-form-label">Parcelle</label>
                      <input class="form-control" type="text" id="libelle"  name="libelle" placeholder="Libellé parcelle">
                    
                  </div> 

                  <div class="col-md-12 mb-3">
                      <label for="example-text-input" class="col-form-label">Superficie parcelle</label>
                      <input class="form-control" type="text" id="superficie"  name="superficie" placeholder="Supeficie du parcelle">
                    
                  </div> 
              </div>  
              </div>         
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuller</button>
                    <button type="submit"  id="envoie" name="envoie" class="btn btn-primary">Enregistrer</button>
                </div>
             </form>
            </div>
           
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','.batiment',function(){
			var cat_id=$(this).val();
			var div=$(this).parent();
			var op=" ";
			$.ajax({
				type:'get',
				url:"{{ route ('findbloc') }}",
				data:{'id':cat_id},
				success:function(data){
          console.log(data);
          if(data.length == 0){
            op+='<option value="0" selected disabled>--Séléctionner bloc--</option>';
            op+='<option value="0" selected disabled>Aucun </option>';
            document.getElementById("blocid").innerHTML = op

            alert("Attention!!\n le site n'a pas de bloc refferencer ! "+cat_id);

            
          }else{
            op+='<option value="0" selected disabled>--Séléctionner bloc--</option>';
					for(var i=0;i<data.length;i++){
					op+='<option value="'+data[i].id+'">'+data[i].libelle+'</option>';
          document.getElementById("blocid").innerHTML = op
          }
          }
				 
				},
				error:function(){
          alert("Attention! \n Erreur de connexion a la base de donnee ,\n verifier votre connection");
				}
			});
		});
    });
</script>

    @endsection