<template>
	<div class="thumb-wrapper">
  	<wishlist :idproducto="idproducto" :logeado="logeado"></wishlist>
    <div class="img-box">
          <a-img :to="idproducto" :src="img" :name="name"></a-img>
    </div>
  	<div class="thumb-content">
      <!-- <div class="star-rating">
        <ul class="list-inline">
        	<template v-for="star in 4">
          <li class="list-inline-item" v-if="star==5"><i class="fa fa-star"></i></li>
          <li class="list-inline-item" v-else><i class="fa fa-star-o"></i></li>
        	</template>
        </ul>
      </div> -->
    	<p class="item-price" v-if="logeado"> <!-- <strike>$400.00</strike>--><b>${{precio}}</b></p>
        <p v-else><a :href="ruta+'item/'+idproducto+'-'+name">Ver Precio...</a></p>
  
      <span class="card-descripcion">{{name}}</span>  
      <div v-if=" parseInt(stock) !== 0 ">
            <btn-addcarrito
              :id = "idproducto"
              :logeado = "logeado"
              :cant = "1"
              :block = "true"
              >
            </btn-addcarrito>
          </div>
          <div v-else>
            <b-alert show variant="danger">Agotado</b-alert>
          </div>
  	</div>            
  </div>
</template>
<script>
	export default {
	props:['idproducto','img','name','precio','logeado','stock'],
		data(){
			return {
				ruta:url
			}
		}
}
</script>