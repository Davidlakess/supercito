
<template>
<b-col cols="12" lg="3" class="mb-2">
		<figure class="card card-product">
    <div class="img-wrap"> 
      <a-img :to="id" :src="img" :name="des"></a-img>
		</div>
          <figcaption class="info-wrap">
								<span class="price-new text-center">${{precio}}</span>
						<div class="action-wrap">
							<div class="item-titulo">	
							<span>{{des}}</span>
							</div>
							<div class="vendedor-item">	
							<span>Por merco</span>
							</div>
							<b-card-sub-title class="mb-2 " style="width: 100%"> 
		              <i class="fa fa-star text-warning"></i>
		              <i class="fa fa-star text-warning"></i>
		              <i class="fa fa-star text-warning"></i>
		              <i class="fa fa-star text-warning"></i>
		              <i class="fa fa-star "></i>
		            </b-card-sub-title>
						</div>
						
            <b-button variant="outline-primary" v-if="logeado" class="btn-car" block @click="addcarrito(id)">
              Agregar al Carrito
              <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:20px;"></i>
            </b-button> 

            <b-button variant="outline-primary" v-else class="btn-car" :href="mdruta" block>
              Agregar al Carrito
              <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:20px;"></i>
            </b-button> 

					</figcaption>
      </figure>
   </b-col>
</template>
<script>
  export default {
    	props:[
      		'img',
      		'precio',
      		'des',
      		'id',
          'mdruta',
          'logeado'
      	],
    data() {  	
      return {
    
      }
    },
    mounted() {},
    methods: {
    	addcarrito(id){
        let formd=new FormData;
        let producto={
          name:this.des,
          img:this.img,
          precio:this.precio,
          cantidad:'1',
          id_producto:this.id
        }

        formd.append('data',JSON.stringify(producto));
    		axios.post("api/addcarrito",formd).then(data => {
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
<style>
	

  .card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden; 
  }
  .card-product .price-new, .card-product .price {
    margin-right: 5px; 
		font-size: 25px;
  }
  .card-product .price-old {
    color: #999; 
  }
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center; }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; }
      
      .card-product .info-wrap {
		    overflow: hidden;
		    padding: 15px;
		    border-top: 1px solid #eee; 
				align-self: center;
				text-align: justify;
				width: 100%;
  		}
  .card-product .action-wrap {
    padding-top: 4px;
    margin-top: 4px; }
  .card-product .bottom-wrap {
    padding: 15px;
    border-top: 1px solid #eee; }
  .card-product .title {
    margin-top: 0; 
  }
	.item-titulo{
		color: #333;
		font-size: 14px;
		font-weight: 300;
		line-height: 1.29;
		margin-bottom: 5px;
	}
	.vendedor-item{
		color: #333;
		font-size: 13px;
		font-weight: 300;
		line-height: 1.29;
		margin-bottom: 13px;
	}
  .btn-car{
  	margin-top: 10px;
  }
</style>