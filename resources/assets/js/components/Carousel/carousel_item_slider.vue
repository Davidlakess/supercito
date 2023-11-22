<template>
<transition :name="transition">
	<div  v-show="visible" class="item carousel-item active">
				<slot></slot>
   	</div>
</transition>
</template>
<script type="text/javascript">
	export default {
		data(){
			return{
				index:0,
				wishlist:false
			}
		},
		computed:{
			transition(){
				// if(this.$parent.direction){
					return 'slide-'+this.$parent.direction
				// }
			},
			visible(){

				return this.index == this.$parent.index
			
			}
		}
}
</script>
<style>
.slide-left-enter-active{
		animation: slideLeftIn .3s;
	}
	.slide-left-leave-active{
		animation: slideLeftOut .3s;
		position: absolute;
		top: 0;
		left: 0;
	}

	@keyframes slideLeftIn{
		from {transform: translateX(100%);}
		to {transform: translateX(0);}
	}

	@keyframes slideLeftOut{
		from {transform: translateX(100%);}
		to {transform: translateX(0);}
	}



	.slide-right-enter-active{
		animation: slideRightIn .3s;
	}
	.slide-right-leave-active{
		animation: slideRightOut .3s;
		position: absolute;
		top: 0;
		left: 0;
	}


	@keyframes slideRightIn{
		from {transform: translateX(-100%);}
		to {transform: translateX(0);}
	}

	@keyframes slideRightOut{
		from {transform: translateX(-100%);}
		to {transform: translateX(0);}
	}


</style>