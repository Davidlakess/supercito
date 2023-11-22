<template>
<div>	
<!-- 

****** 														           	******
****** AGREGAR UN LIMITE DE COMPRA PARA SU PRIMERA VALIDACION COMPRA   	******	
******														    	    ******
-->
	


	<div style="margin-top: 70px;margin-bottom: 55px;width: 77%;font-size: 27px;margin-left:24%;">
		<span style="font-size: 18px;font-weight: 400;color: #969595;">	Paso {{paso}} de 2</span><br>
		<span>	Publicar Un Producto Nuevo</span>
	</div>

	<div v-show="addpro1">

		<detalles
		titulo="¿escribe Nombre,marca y modelo del producto?"
		:showsumary="true"
		:open="details.name"
		>
	  	<b-row align-h="center">
		 		<b-col cols="10" lg="10">
				  <b-form-input placeholder="ej:Aceite vegetal comestible Ave 900ml" v-model="nameproducto" ></b-form-input>
			    	<!-- {{value}} -->
			  	</b-col>
			  	<b-col cols="2" lg="2" style="text-align: end;">
			     <b-button @click="mostrarsiguiente()" :variant="color">Siguiente</b-button>			  		
				</b-col>
			</b-row>
		</detalles>

		<detalles
		titulo="¿Cual categoria lo describe?"
		:showsumary="true"
		:open="open.categoria"
		v-show="details.categoria"
		>
		<!-- <a @click="Regresar(orias[0].ids,categorias[0].name)"><span class="text-category">Regresar</span></a> -->

		<b-list-group v-show="showbtns.categori" id="categoria-lista">
			<template v-for="(cat,key) in categorias">
		  		
		  		<b-list-group-item 
		  			class="categoria-hija"
				  	v-if="cat.hijos!=null" 
				  	@click="nextcategori(cat.ids,cat.name)"  
				  	:disabled="btndisable"
				  	button :key="key">
				  		{{cat.name}}
				</b-list-group-item>

				<b-list-group-item 
					class="categoria-hija"
				 	v-else 
				 	@click="selectcategoria(cat.ids,cat.name)"  
				 	button 
				 	:key="key">
						{{cat.name}}
				 	</b-list-group-item>

					</template>
				</b-list-group>

				   <b-col cols="12" lg="12" style="text-align: end;margin-top: 15px;display: grid;" v-show="showbtns.confirm">
				   		<ol class="andes-breadcrumb">
					        <template v-for="(n,key) in nav">      
					          <li class="li-sin-decoracion">
					            <i class="fa fa-angle-right icon-category" v-if="key!=0"></i>
					            <a href="#"><span class="text-category">{{n.name}}</span></a>
					          </li>
					        </template>
				      	</ol>
				 			<span class="text-estilo">Es Importante elegir la categoria correcta para que los compradores puedan encontrar tu producto mas facilmente..</span>
					 		<b-button :variant="color" @click.once="confirmarcategoria()">Confirmar</b-button>	
					</b-col>
		</detalles>

	<detalles
		titulo="información de tu producto"
		:showsumary="true"
		:open="open.fichatecnica"
		v-show="details.fichatecnica"
		>

	    	<b-row align-h="center">
	    		<template v-for="a in attrib">
			 		  <b-col cols="6" lg="6" class="title-head" style="margin-bottom: 25px;">
	             <span>
	             {{a.name}}..    
	             </span>
	       
	             <!-- <b-form-input  ></b-form-input> -->
	            <template v-if="a.name=='marca'">	
	             <vue-bootstrap-typeahead 
					v-model="a.value"
					:data="marcas"
					:serializer="s => s.name"
					:placeholder="a.name"
						/> 
	            </template>
				
				<template v-else>	
					<b-form-input type="text"
					v-model="a.value" 
					>	
					</b-form-input>
				</template>
	           </b-col>
	    		</template>
	    		{{attrib}}
	    	   <b-col cols="12" lg="12" style="text-align: end;display: grid;">	    	   	
				     <b-button :variant="color" @click="guardaratributos()">Siguiente</b-button>		  		
				</b-col>
	   	</b-row>
		</detalles>
		
		<detalles
		titulo="Imagen del Producto"
		:showsumary="true"
		:open="open.imgs"
		v-show="details.imgs"
		>

				<div style="margin-top: 20px;">
					 <b-overlay style="width: 100px;height: 100px;" :show="showoverlay" rounded="sm">
						<div class="image-upload-wrap">
								<b-form method="POST" enctype="multipart/form-data" action="/storage/create" >
							  <input type="file" @input="subirimg($event.target.files[0])" class="file-upload-input" />
							</b-form>
							    <div class="drag-text">
							    	<i class="fa fa-camera" style="font-size: 24px;"></i>
							      <span>Subir Imagen</span>
							    </div>
						</div>
					</b-overlay>
					<ul style="display: flex; list-style: none; padding: 0;margin: 0;">	
					  		<li v-for="(img,key) in imgs" style="margin: 10px;">	
					   		<figure class="card card-product" @mouseleave="img.show=false"  @mouseover="img.show=true">
				              <div class="img-wrap">
				              	<div :class="(img.show)?'btn-delete-img':''">	
				              			<i @click="functionsi()" :class="(img.show)?'ic fa fa-trash':''">	</i>
				              	</div>
				  
				        			<div class="text-center" v-if="key==0" >
				              		<b-badge class="bange-portada" variant="success"><span style="margin-left: 10px;">Portada</span></b-badge>
				           		</div>
				    				
				                <img :src="'/uploads/'+img.src">
				              </div>
				            </figure>
					  		</li>	
					  </ul>	
				     	<b-col cols="12" lg="12" style="text-align: end;display: grid; margin-top: 20px;">
				     		<b-button :variant="color" @click="showaddproducto2()" >Siguiente</b-button>	
						</b-col>
				</div>
			</detalles>
	</div>
	<addproducto-parte2 
	:id_producto="id_producto" 
	:comision="comision" 
	v-show="addpro2" 
	>
	</addproducto-parte2>
</div>
</template>
<script type="text/javascript">
	import producto2  from './addproducto_parte2.vue'
	import detalles from '../Generico/detalles.vue'
	// import variantes  from './variantes/variante_color_talla.vue'
 
	export default {
			 
			 components: {
			 	'addproducto-parte2':producto2,
			 	'detalles':detalles
			 	// 'variante-talla-color':variantes
			}, 
		 	data(){
      	return {
        	value: [],
        	paso:1,
      		addpro1:true,
      		showoverlay:false,
      		addpro2:false,
      		color:'primary',
      		btndisable:false,
      		// variantes:{value:null,set:false},
      		comision:1,
      		marcas:[],
      		showbtns:{
      			confirm:false,
      			categori:true,
      		},
      		id_categoria:'',
      		id_producto:'',
      		showbuttondelete:false,
      		nameproducto:'',
      		details:{
      			name:true,
      			categoria:false,
      			fichatecnica:false,
      			imgs:false,
      		},
      		open:{
      			categoria:false,
      			fichatecnica:false,
      			imgs:false,
      		},
      		val:'',
      		categorias:[],
      		nav:[],
      		imgs:[],
		    	attrib:[],
		    	atributos:[]
      	}
		},
			mounted(){
				this.getcategorias(0);
				// this.getatributos(this.id_categoria);
			},
			methods:{
				bajarscroll(){
					const objDiv = document.getElementById("bd");
    				objDiv.scrollTop = objDiv.scrollHeight;
				},
				showaddproducto2(){
						this.addpro1=false;
						this.addpro2=true;
						this.paso=2;
				},
				subirimg(file){
					let formd=new FormData;
			      formd.append('file',file);
			      formd.append('id',this.id_producto);
			      this.showoverlay=true;
			      axios.post("/storage/create",formd).then(data => {
			           
			      	this.imgs.push({src:data.data.img,id:data.data.id,show:false});
			      	this.showoverlay=false;
			      }).catch(error => {
			      	this.showoverlay=false;
			             console.log(error);  
			      });  
				},
				addnombreproducto(){
					axios.post("api/addname",{name:this.nameproducto}).then(data => {
		 				
		 				this.id_producto=data.data.id;
			 			this.details.categoria=true;
						this.open.categoria=true;
						this.details.name=false;
					
		        	}).catch(error => {
		         	
		         	});
				},
				mostrarsiguiente(){

					this.addnombreproducto();
					
					Vue.nextTick(() =>{
						this.bajarscroll();
                	});
                   
				},
				Regresar(id,name){
					/*
					
					METODO REGRESAR CATEGORIA 
			
					EN BASE A LA VARIABLE * NAV * UTIIZAR EL ULTIMO VALOR GUARDADO DE LA CATEGORIA 
					PARA REGRESARY CONSULTAR LAS DEMAS CATEGORIAS Y DESPUES QUUITAR ESE VALOR DE
					LA VARIABLE NAV PARA AGREGAR EL NUEVO
					
					*/

					// this.nav.pop({id:id,name:name});
					// this.getcategorias(id);
				
				},
				nextcategori(id,name){

					this.nav.push({id:id,name:name});
					this.getcategorias(id);
				},
				getcategorias(id){
					// ormd.append('data',JSON.stringify(producto));
		    		axios.post("api/categoriaspd",{id:id}).then(data => {
		 				this.categorias=data.data;
		 				this.btndisable=false;
		        	}).catch(error => {
		         	
		         });
				},
				confirmarcategoria(){
					this.getatributos(this.id_categoria);

					this.details.fichatecnica=true;
					this.open.categoria=false;

					axios.post("api/categoripro",{id:this.id_producto,id_categoria:this.id_categoria}).then(() => {
		 				Vue.nextTick(() =>{
							this.open.fichatecnica=true;
							this.bajarscroll();
                		});
		 			}).catch(error => {
		         	




		         	});

				},
		
				selectcategoria(id,name){
					this.nav.push({id:id,name:name});
					this.id_categoria=id;
					this.showbtns.confirm=true;
					this.showbtns.categori=false;	
				},
				
		
				guardaratributos(){
				 // console.log(this.attrib)
				 var atributos=[];
				 var indx=0;
				 for(var i=0; i< this.attrib.length;i++){
				 	
				 	if(this.attrib[i].value!=''){
					 	atributos[indx]={
					 		id_atributo:this.attrib[i].id,
					 		id_producto:this.id_producto,
					 		valor:this.attrib[i].value
					 	}
					 	indx++;
				 	}

				 }

					axios.post("api/addatributos",{data:JSON.stringify(atributos)}).then(() => {
			 		
						this.open.imgs=true;
						this.details.imgs=true;
						this.open.fichatecnica=false;

						Vue.nextTick(() =>{
							this.bajarscroll();
	        	});
		   	
		 			}).catch(error => {
		        
		      });
				
				},
		
				getatributos(id){
					// ormd.append('data',JSON.stringify(producto));
		    		axios.post("api/atributos",{id:id}).then(data => {
		 				
		 				this.attrib=data.data.atri;
		 				this.marcas=data.data.marc;
		 				this.comision=(data.data.com.valor)?data.data.com.valor:1;
		 				// this.variantes.set=data.data.var.set;
		 				// this.variantes.value=data.data.var.value;
		 				
		 				// console.log(data.data);
		        	}).catch(error => {
		         	
		         });
				}
				
			}
		}
</script>
<style>
.bange-portada{
	z-index: 1024;
	display: flex;
	position: absolute;
	width: 100px;
	margin-top: 60%;
}
.text-estilo{
    text-align: justify;
    font-size: 18px;
    text-transform: capitalize;
    margin-bottom: 10px;
}
.espacio-box{
margin-bottom: 50px;
margin-top: 50px;
}
	body {
  font-family: "IBM Plex Sans", sans-serif;
  background-color: rgba(0,0,0,.1);
}

h2 {
  margin: 20px auto 80px;
  font-size: 38px;
  font-weight: 300;
  text-align: center;
  letter-spacing: 2px;
  line-height: 1.5;
}

details {
  width: 75%;
  min-height: 5px;
  max-width: 700px;
  padding: 45px 70px 45px 45px;
  margin: 0 auto;
  position: relative;
  font-size: 22px;
  border: 1px solid rgba(0,0,0,.1);
  border-radius: 15px;
  box-sizing: border-box;
  transition: all .3s;
}

details + details {
  margin-top: 20px;
}

details[open] {
  min-height: 50px;
  background-color: #fff;
  box-shadow: 2px 2px 20px rgba(0,0,0,.2);
}

details p {
  color: #96999d;
  font-weight: 300;
}

summary {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 500;
  cursor: pointer;
  margin-bottom: 35px;
}

summary:focus {
  outline: none;
  
}

summary:focus::after {
  content: "";
  height: 100%;
  width: 100%;
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  /*box-shadow: 0 0 0 5px rebeccapurple;*/
}

summary::-webkit-details-marker {
  display: none
}

.control-icon {
  fill: rebeccapurple;
  transition: .3s ease;
  pointer-events: none;
}

.control-icon-close {
  display: none;
}

details[open] .control-icon-close {
  display: initial;
  transition: .3s ease;
}

details[open] .control-icon-expand {
  display: none;
}



.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.bt{
  border: 2px solid gray;
  color: gray;
  background-color: white;
  /*padding: 8px 20px;*/
  border-radius: 8px;
  font-size: 15px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor: pointer !important;
}
/*Imagen*/
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
/*Imagen*/

/*.btn-delete-img{
	width: 100px;
	height: 100px;
	/*background-color: transparent;	
}*/

.btn-delete-img{
	display: 	block;
	position: fixed;
	width: 100px;
	height: 100px;
	background-color:#57555575;
}

.ic{
	margin: 30px;
	color: #fff;
	cursor:pointer; 
	font-size: 33px;
	/*display: block;*/
}



.andes-breadcrumb {
    margin: 20px 0 20px;
    font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
    font-size: 17px;
    padding: 0;
    display: -webkit-inline-box;
    position: sticky;
    z-index: 999;

}
.icon-category{
  font-size: 17px;
font-weight: bold;
margin-left: 5px;
margin-right: 1px;
}

.li-sin-decoracion{
  list-style: none;
}

.text-category{
  text-transform: capitalize;
}


/*display color*/
.text-truncate{
display:flex;	
}

.custom-chip{
border-radius: 20px;
margin-top: 10px;
background-color: transparent;
border: 1px solid darkcyan;
color: #060606;
}

.custom-chips{
border-radius: 20px;
margin-top: 10px;
background-color: transparent;
border: 1px solid darkcyan;
color: #060606;
height: 32px;
}
.stilo-chip{
	background-color: #CD5C5C;
	border-radius: 100px;
	height: 20px;
	width: 20px;
	 margin-right: 3px;
	border: 1px solid #9f9696;
}


#tags-component-select{
 border: 0;
}
.rem .close{
	display: none;
}
.b-form-tag > button.b-form-tag-remove {
    font-size: 24px !important	;
}

#categoria-lista{

	height: 300px;
	/*width: 200px;*/
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;

}

.categoria-hija{
	height: auto;
}
</style>


<style>
.file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;

}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #1FB264;
  position: relative;
      width: 100px;
    height: 100px;
}



.drag-text {
  text-align: center;
  margin: 13 0;
  display: grid;
}

.drag-text span {
  font-weight: 100;
  text-transform: uppercase;
  color: #15824B;
  font-size: 17px;
  /*padding: 60px 0;*/
}



</style>

<!-- Latitud y Long Alvaro  -

 lat:19.816657, lng: -101.045920 };

->