@extends('layouts.app2')

@section('content')
<div id="ancho-contacto">
	 <v-card height="auto"> 
		<div class="content-contacto"><h1 class="page-title"> Contáctanos</h1></div>
		<div class="subtitle-contacto">
			<span>Calle Francisco I Madero #22 Alvaro Obregon.Mich</span>
			<span>Tel:(44) 34-12-62-38</span>
			<span>Contacto@supercito.mx</span>
		</div>
	 <v-container grid-list-xl style="cursor: default;">
	  <v-layout row wrap>
	    <v-flex xs12 md6 lg6>
	    	<v-text-field
		      class="textuper"
		      autofocus
		      hint="Ingresa tu Nombre"
		      label="Nombre"
		      name="name"
		      outline>
	      </v-text-field>
	  	</v-flex>
	  	<v-flex xs12 md6 lg6>
	    	<v-text-field
	        label="Telefono"
	        mask="phone"
	        name="telefono"
	        outline>
	      </v-text-field>
	  	</v-flex>
	  	<v-flex xs12 md12 lg12>
	  	 <v-text-field
	      hint="!Ingresa tu Correo!"
	      label="Email"
	      outline>
	    	</v-text-field>
	    </v-flex>
	  	<v-flex xs12 md12 lg12>
		    <v-textarea
	        outline
	        name="mensaje"
	        label="Mensaje"
	        value=""
		    ></v-textarea>
	  	</v-flex>
	  	<v-flex xs12 md12 lg12>
  	  <v-card-actions>
        <v-btn block dark style="background-color: #000 !important;margin-bottom: 10px;">Enviar</v-btn>
      </v-card-actions>
    </v-flex>
	  </v-layout>
</v-container>
	</v-card>
</div>
@endsection
<style>
  .content-contacto{
  	text-align: center;
  	text-transform: capitalize;
  	font-family: "Nunito Sans",sans-serif;
  	font-style: normal;
  	letter-spacing: 0.0em;
  }
	.page-title {
		font-size: 46px;
  	color: #404262;
  	font-weight: bold;
  }
  .subtitle-contacto{
  	display: grid;
	  text-align: center;
	  line-height: 1.98;
	  font-size: 17px;
	  margin: 4%;
  }
</style> 
</style>


<script type="text/javascript">
  document.title ='Contáctanos — Supercito';
</script>
