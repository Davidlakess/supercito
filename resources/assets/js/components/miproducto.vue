<template>		
	<b-col cols="12" style="margin-bottom: 15px;">
		<b-card >
		<b-row  style="padding-bottom: 15px;">
		 	<b-col cols="12" lg="6" class="text-lg-left" >
		 		<span style="font-size: 18px;">Registrado: {{formatefecha(fecha)}}</span>
		 	</b-col>
		 	<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
		 	  <b-button variant="outline-primary" >
	       			Pausar
	    	  </b-button>
	    	  <b-button variant="outline-primary" >
	       			editar
	    	  </b-button>
		 	</b-col>
		</b-row>
 			<b-row align-h="justify">
				<b-col cols="12" lg="3" style="text-align: center;display: ruby;">
			 		<figure class="card card-product"  style="width: 100px;">
                    <div class="img-wrap"> 
                      <img :src="img" alt="imagen">
                    </div>
                  </figure>	
			 	</b-col>
			 <b-col cols="12" lg="3" class="mb-custom">
			 		<div style=" height: 100%;display: inline-grid;">
						<b-col cols="12">
						<span>
							{{name}}
						</span>
			 		</b-col>
			 		</div>
			 </b-col>
			 <b-col cols="12" lg="3" class="mb-custom">
			 	<div style=" height: 100%;display: inline-grid;font-size: 18px;">
					<b-col cols="12">
						<strong>Precio</strong>
					<span >${{precio}}</span>
					</b-col>
			 	</div>
			 </b-col>
			 <b-col cols="12" lg="3">
			 	<div style=" height: 100%;display: inline-grid; font-size: 18px;">
			 			<b-col cols="12">
			 				<strong>Stock</strong>
			 				<span>#{{stock}} Unidades</span>
			 			</b-col>
			 		</div>
			 </b-col>
		</b-row>
 	</b-card>
 </b-col>
</template>
<script>
import moment from 'moment'
  export default {
    props:[
    	'stock',
    	'precio',
    	'name',
    	'img',
    	'fecha',
    	'id'
    ],
    data() {
      return {
        
      }
    },
    methods: {
		indexof(val){
			alert(val);
		},
		formatefecha (val) {
        	moment.locale('es');
        	var format =val.split(' ');
        	return val ? moment(format[0]).format('LL'): ''
      	}
    }
  }
</script>
<style>	
.card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden; 
  }
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 100px;
    text-align: center; 
  }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100px;
      object-fit: cover;

  }
  </style>