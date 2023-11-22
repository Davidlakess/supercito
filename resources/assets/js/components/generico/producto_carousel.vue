<template>
	<div class="thumb-wrapper">
  	<!-- <wishlist :idproducto="idproducto" :logeado="logeado"></wishlist> -->
    <div class="img-box">
          <a-img :to="idproducto" :src="img" :name="name"></a-img>
    </div>
  	<div class="thumb-content">
    	<span v-if="logeado" class="item-price">${{precio}}</span>
      <span class="card-descripcion">{{name}}</span>         
   <!--    <div class="star-rating">
        <ul class="list-inline">
        	<template v-for="star in slider.stars">
          <li class="list-inline-item" v-if="star==1"><i class="fa fa-star"></i></li>
          <li class="list-inline-item" v-else><i class="fa fa-star-o"></i></li>
        	</template>
        </ul>
      </div> -->
      <!-- <strike>${{slider.descuento}}</strike> --> 
  	</div>            
  </div>
</template>
<script>
	export default {
	props:['idproducto','img','name','precio','logeado'],
		data(){
			return {

			}
		},
		created() {
			 // this.addcarrito_componete();
		},
		mounted (){
			// console.log(this.mdruta)
		},
	methods:{
		 
	}
}
</script>