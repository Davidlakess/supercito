<template>
  <span class="wish-icon"
   @click="addwhislist" >
   <i :class="(wishlist)?'fa fa-heart':'fa fa-heart-o'"></i>
 	</span>
</template>
<script type="text/javascript">
	export default {
		props:['idproducto'],
		data(){
			return {
			wishlist:false
			}
		},
		mounted (){
		},
	methods:{
		addwhislist(){
				// alert(this.idproducto)
				this.wishlist=!this.wishlist;
		}
	}
}
</script>