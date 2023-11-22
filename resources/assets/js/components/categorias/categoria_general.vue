<template>
	<div style="display: flex;">
    <b-container id="content-p"  style="margin-right: 80px;margin-left: 80px;margin-top: 30px;" fluid>
      <b-row align-h="center">
        <b-col md="12" style="padding-bottom: 10px;">
          <p class="super-titulo">Busca por departamento</p>
        </b-col>
        <categorias-item :logeado="logeado"></categorias-item>

        <b-col md="12" style="padding-top: 15px;">
          <div class="super-titulo"><span>Promociones..</span></div>
					  <v-carousel>
					    <template v-for="(producto,indx) in pro">  
					    	<v-carousel-slide :index="indx">
				          <div class="row">
				            <div class="col-sm-3"  v-for="slider in producto">
				              <div class="thumb-wrapper">

				              	<wishlist :idproducto="slider.id_producto" :logeado="logeado"></wishlist>
				                <div class="img-box">
				                	<a :href="'/detalle/'+slider.id_producto">
				                  		<img :src="'uploads/'+slider.img" class="img-responsive img-fluid" alt="">                  
				              		</a>
				                </div>
				                <div class="thumb-content">
				                  <h4>{{slider.name}}</h4>                 
				                  <div class="star-rating">
				                    <ul class="list-inline">
				                    	<template v-for="star in slider.stars">
				                      <li class="list-inline-item" v-if="star==1"><i class="fa fa-star"></i></li>
				                      <li class="list-inline-item" v-else><i class="fa fa-star-o"></i></li>
				                    	</template>
				                    </ul>
				                  </div>
					                  <p class="item-price"><strike>${{slider.precio}}</strike> <b>${{slider.descuento}}</b></p>

					          	      <b-button variant="link" v-if="logeado"
					                 @click="addcarrito(slider.id_producto)" class="btn btn-primary"
					                 >Agregar al Carrito</b-button>
					                  
					                  <b-button variant="link" v-else :href="mdruta" 
					                  class="btn btn-primary">Agregar al Carrito</b-button>
					                </div>            
					              </div>
					            </div>
					          </div>
				    		</v-carousel-slide>
				    	</template>
				  	</v-carousel>
        	</b-col>
      	</b-row>
   		</b-container> 
  	</div>
	</template>
<script>
export default {
	props:['logeado'],
		data(){
			return {
				pro:[],
				mdruta:"/middlecarrito",
				categorias:[
					
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_976573-MLA41891261737_052020-F.jpg',
						titulo:'Tu Cuidado',
						subtitulo:'Personal',
						url:''
					},

					{
						img:'https://http2.mlstatic.com/D_NQ_NP_780504-MLA41891261616_052020-F.jpg',
						titulo:'para tu',
						subtitulo:'Hogar',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_902301-MLA41891261603_052020-F.jpg',
						titulo:'Para tu',
						subtitulo:'Bebe',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_672109-MLA41891261730_052020-F.jpg',
						titulo:'Para Tu',
						subtitulo:'Despensa',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_834495-MLA41891261732_052020-F.jpg',
						titulo:'Variedad EN',
						subtitulo:'Bebidas',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_712289-MLA41891261733_052020-F.jpg',
						titulo:'PARA TU',
						subtitulo:'Mascota',
						url:''
					},
				]
			}
		},
		created (){
			console.log(this.logeado)
			this.getpromociones();
		},
	methods:{
		getpromociones(){
				axios.post("api/getpromociones").then(data => {
      		this.pro=data.data;
      	});
		},
		addcarrito(id_pro){
    		axios.post("api/addcarrito",{'id':id_pro}).then(data => {
          const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });

         toast.fire({
          icon:'success',
          title: 'Producto agregado!'
        })
        }).catch(error => {
          console.log(error);  
        });
    	}
	}
}
</script>