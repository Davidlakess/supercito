<template>	
	<div>	
	    <b-carousel
	        id="carousel-slide"
	        :interval="3000"
	        indicators
	        controls
	        background="#ababab"
	        style="text-shadow: 1px 1px 2px #333; margin:0; padding: 0;"
	      >
	        <!-- Text slides with image -->
	      <b-carousel-slide

	        :img-src="ruta+'slide-1.jpg'"
	        >
	      </b-carousel-slide>
	      <b-carousel-slide 
	        :img-src="ruta+'slide-2.jpg'">
	      </b-carousel-slide>
	      <b-carousel-slide>
	        <template v-slot:img>
	            <img
	              class="d-block img-fluid w-100"
	              :src="ruta+'slide-3.jpg'"
	            >
	        </template>
	      </b-carousel-slide>
	    </b-carousel>
		
		<b-container id="content-p"  fluid>
  		<b-row align-h="center">
    	
		 <b-col md="12" v-if="historial.length!=0">
			<div class="super-titulo"><span>Productos Vistos Recientemente</span></div>
			  <s-carousel>
			    <template v-for="(item,indx) in historial">  
			    <s-carousel-slide :index="indx">
		          <div class="row">
		            <div class="col-sm-12 col-md-3"  v-for="slider in item">
		              <producto-carousel
		              :idproducto="slider.ids"
		              :img="slider.img"
		              :name="slider.name"
		              :precio="slider.precio"
		              :logeado="logeado"
		              >
		              </producto-carousel>
		            </div>
		          </div>
			    </s-carousel-slide>
			    </template>
			  </s-carousel>
			</b-col>

	<b-col md="12" style="padding: 0;margin-bottom: 50px;">
		<div class="super-titulo" style="padding-left: 15px; display: flex;">
			<span>Categorias:</span>
		<b-form-select  class="mb-3" @input="onselected()"  v-model="selected" style="width: 20%;">
		<!-- <b-form-select-option :value="null">selecciona tu localidad</b-form-select-option> -->
		
		<b-form-select-option 
			v-for="(op,key) in options" 
			:value="op.id"
			:key="key"
			>{{op.name}}
		</b-form-select-option>
		</b-form-select>
					
			</div>
		<coleccion-cetgoria 
		:titulo="coleccion[0].name"
		:img="coleccion[0].img"
		:pro="coleccion[0].items"
		:idc="coleccion[0].ids"
		:head="true"
		></coleccion-cetgoria>
	</b-col>
	
		<productos-nuevos :items="productosnuevos"></productos-nuevos>
		
<!-- 
		<template v-for="pro in productos">	
			<b-col md="12" v-if="pro.items.length!=0">
				<div class="super-titulo"><span>Gran variedad en {{pro.categoria.name}}</span></div>
				  <s-carousel>
				    <template v-for="(item,indx) in pro.items">  
				    <s-carousel-slide :index="indx">
			          <div class="row">
			            <div class="col-sm-12 col-md-3"  v-for="slider in item">
			            	
			              <producto-carousel
			              :idproducto="slider.ids"
			              :img="slider.img"
			              :name="slider.name"
			              :precio="slider.precio"
			              :logeado="logeado"
			              >
			              </producto-carousel>
			            </div>
			          </div>
				    </s-carousel-slide>
				    </template>
				</s-carousel>
			</b-col>
		</template> -->
		
		<template v-for="(pro,k) in productos">	
		<div class="super-titulo"><span>Gran variedad en {{pro.categoria.name}}</span></div>
		<v-carousel  class ="carousel-pro" :interval="6000+k"  light hide-delimiters Default style="box-shadow: none;">
			  <template v-for="(item,indx) in pro.items"> 
      <v-carousel-item :key="indx">
        <v-container fluid grid-list-sm>
          <v-layout>
          	<template v-for="(slider,key) in item">
          	<v-flex xs3 md3 :key="key">
            	<v-card height="auto" style="padding: 10px; margin: 9px; box-shadow: none;"> 
         		    <producto-carousel
	              :idproducto="slider.ids"
	              :img="slider.img"
	              :name="slider.name"
	              :precio="slider.precio"
	              :logeado="logeado"
	              >
	              </producto-carousel>
            	</v-card>
        		</v-flex>
          	</template>
      		</v-layout>
    		</v-container>
      </v-carousel-item>
    </template>
    </v-carousel>
  </template>



	<!-- Historial de navegacion -->
	
	<!-- {{promos}} -->
	<!-- <promociones :promos="promos" :logeado="logeado"></promociones> -->


			<b-col md="12">
				<div class="super-titulo"><span>Categorías </span></div>
					<welcome-categorias :items="categorias">
					</welcome-categorias>
		   	</b-col>
		</b-row>
		</b-container>
	</div>		
</template>
<script>
	import coleccion_categoria  from '../categorias/coleccion_categoria.vue'
 	import productosnuevos from '../welcome/productos_nuevos.vue'
 	import welcomcategori from '../Generico/welcome_categorias.vue'

	export default {
		components: {
			 	'coleccion-cetgoria':coleccion_categoria,
			 	'productos-nuevos':productosnuevos,
			 	'welcome-categorias':welcomcategori
		},

	props:['productos','productosnuevos','categorias','collection','historial','logeado'],
	data(){
			return {
				pro: [],
				ruta: url,
				selected: 'MNL6841',
				coleccion: [],
			        options: [
			        {name:'Despensa',id:'MNL6841'},
			        {name:'Hogar y Lavanderia',id:'MNL1636'},
			        {name:'Higiene Personal',id:'MNL7890'}]
			}
		},
		created() {
			this.coleccion=this.collection;
		},
	methods:{
      onselected(){	
      	axios.post(url+"coleccion",{id:this.selected}).then(data => {
 		    if(data.status==200){
		    	if(data.data.length!=0){    
		        	this.coleccion=data.data;   
		    	}
			}else {
				const toast = swal.mixin({
	            toast: true,
	            position: 'top-end',
	            showConfirmButton: false,
	            timer: 3000
	          	});

		         toast.fire({
		          icon:'Error',
		          title: '¡error intente de nuevo!'
	        	})
			}
		          
		}).catch(error => {
               
    	});
      },
	}
}
</script>

<style>



.carousel-indicators {
  left: none;
}

#carousel-slide img {
	width: auto !important;
	height: auto !important;  
}   
body #wrapper {
  width: 100%;
}
body #wrapper ul {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0 auto;
  padding: 0;
  height: 118px;
  background-color: #fff;
  font-size: 0px;
}


body #wrapper ul li {
  display: inline-block;
  float: left;
  width: 16.66667%;
  -moz-transition: all 0.1s;
  -o-transition: all 0.1s;
  -webkit-transition: all 0.1s;
  transition: all 0.1s;
  text-align: center;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  text-shadow: 0px 1px 3px white;
  border-right: thin solid lightgray;
  border-bottom: thin solid lightgray;
  background-color: white;
height: 170px;
}
body #wrapper ul li:last-child {
  border-right: none;
}
body #wrapper ul li:hover {
  
}

body #wrapper ul li a:hover {
   background-color: #3483fa;
   color: #fff !important;
}


body #wrapper ul li a {
  display: flex;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
text-decoration: none;
font-size: 38px;
outline: 1px solid #eae6e6;
padding: 50px;
flex-direction: column;
height: 100%;
}
body #wrapper ul li a:visited {
  color: gray;
}
body #wrapper ul li div {
  margin-top: 5px;
  font-weight: 600;
  font-size: 13px;
}

</style>

