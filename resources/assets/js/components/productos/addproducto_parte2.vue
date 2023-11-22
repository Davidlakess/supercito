<template>
	<detalles
		titulo="Completa la Información de tu Producto"
		:showsumary="false"
		:open="true"
		>
			  <b-row align-h="center">
			 		<b-col cols="12" lg="12" class="title-head" style="margin-bottom: 20px;">
						  ¿Cual es su Precio?
						  <div class="input-icon"> 
    						<i style="color: green;font-size: 20px;font-weight: 300;">$</i> 
						  	<b-form-input v-model="precio" type="number" id="popover-target-1" autocomplete="off" min="1" @keyup="hacer_descuento"  >	</b-form-input>
				
						 	</div>

					<small v-if="precio>1" style="font-size: 90%;">
						Por cada venta Recibes 
						<strong style="color: #059916;">${{precio_con_descuento}}</strong> 
					</small>
                 	<b-popover target="popover-target-1" triggers="hover" placement="top">
                      <template v-slot:title>Precio del producto</template>
                       <span style="text-transform: uppercase;">   	
                       {{labelprecio}}
                       </span>	
                        <!-- <strong>Ejemplo:</strong>Si su precio es de $20 recibes  y asi 	con cada producto.  -->
                  	</b-popover>
				 </b-col>
				  <b-col cols="12" lg="12" class="title-head" style="margin-bottom: 20px;">
						  ¿Cantidad Para vender?
						  	<b-form-input type="number" min="1" v-model="cantidad" max="10" value="1">	</b-form-input>
				  </b-col>
				  <b-col cols="12" lg="12" class="title-head" style="margin-bottom: 20px;">
						  Escribe una Descripción...
						  <b-form-textarea
						  v-model="descripcion"
					      placeholder="Descripcion"
					      rows="3"
					      max-rows="6"
					    ></b-form-textarea>
					    {{descripcion}}
				  </b-col>
				  	  <b-col cols="6" lg="6" style="text-align:left;">
				     <b-button variant="link" @click="regresar()">Regresar</b-button>
				  </b-col>

				  <b-col cols="6" lg="6" style="text-align: end;">
				     <b-button :variant="color" @click="guardar()">Publicar</b-button>
				  </b-col>
				</b-row>
		</detalles>
</template>
<script type="text/javascript">
	import detalles from '../Generico/detalles.vue'
	export default {
		 computed:{
		 	labelprecio(){
		 		return 'Hola, la comision para esta categorias es de $'+this.comision+' pesos por venta. escribe el precio del producto para calcular lo que recibiras por venta.'
		 	},

		 },
		 components: {
			 	'detalles':detalles
			}, 
		props:['id_producto','comision'],
		data(){
	      	return {
	   			color:'primary',
	   			precio:0,
	   			precio_con_descuento:0,
	   			descripcion:'',
	   			cantidad:1,
	      	}
		},
		mounted(){
			  // console.log(this.$parent)
		},
		methods:{
			
			guardar(){
				// var a= [this.precio,this.descripcion.trim(),this.cantidad];

				let formd=new FormData;
			    formd.append('cantidad',this.cantidad);			    
			    formd.append('des',this.descripcion.trim());			    
			    formd.append('precio',this.precio);
			    formd.append('id',this.id_producto);
				axios.post("/api/addproducto2",formd).then(data => {
			    
					swal.fire(
					  '¡EXITO!',
					  '¡Producto Publicado!',
					  'success'
					)
			      
			    }).catch(error => {
			      	swal.fire(
					  'ERROR!',
					  'No se Pudo Guardar',
					  'error'
					)
			    });  
			},

			hacer_descuento(){
			        if(this.precio>0){
			          this.precio_con_descuento=parseInt(this.precio) - parseInt(this.comision);
			        }else{
			          this.precio_con_descuento=0; 
			        }
      		},
      		regresar(){
      			this.$parent.addpro1=true;
      			this.$parent.addpro2=false;
      			this.$parent.paso=1;
      		}
		}
	}
</script>
<style>
	.input-icon { 
    position: relative; 
} 

.input-icon > i { 
    position: absolute; 
    display: block; 
    transform: translate(0, -50%); 
    top: 50%; 
    pointer-events: none; 
    width: 25px; 
    text-align: center; 
    font-style: normal; 
} 

.input-icon > input { 
    padding-left: 21px; 
    /*padding-right: 0; */
} 
</style>