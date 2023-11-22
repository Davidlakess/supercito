<template>
	<div  class="carousel slide" data-ride="carouse" data-interval="0">
      <!-- Carousel indicators -->
	    <ol class="carouse-indicators">
	        <li v-for="n in slidesCount" @click="goto(n-1)" :class="{active: n-1==index}"></li>
	    </ol>   
	    <div class="carousel-inner">
			
			<slot></slot>
			
			<b-button variant="link"
			 class="carousel-control left carousel-control-prev" 
			 @click.prevent="prev">
	        	<i class="fa fa-angle-left"></i>
	      	</b-button>
	      	<b-button variant="link"
	  	     	class="carousel-control right carousel-control-next" 
		       	@click.prevent="next">
		        <i class="fa fa-angle-right"></i>
	      	</b-button>	
		</div>
	</div>
</template>
<script type="text/javascript">
	export default {
		data (){
			return {
			 index:0,
			 slides:[],
			 direction:'left'
			}
		},
		mounted(){
			this.slides=this.$children
			this.slides.forEach((slide,i)=>{
				slide.index=i
			})
		},
		computed:{
			slidesCount(){ return this.slides.length}
		},
		methods:{
			next(){
				this.index++
				this.direction = 'right'
				if(this.index >= this.slidesCount){
					this.index=0
				}
				// console.log('next');
			},
			prev(){
				this.index--
				this.direction = 'left'
				if(this.index < 0){
					this.index=this.slidesCount-1
				}
			},
			goto(index){
				this.direction = index > this.index ?'right':'left' 
				this.index=index
			}
		}
	}
</script>
<style>

.carousel .carouse-indicators {
  	position: inherit;
	z-index: 15;
	display: flex;
	justify-content: end;
	list-style: none;
	width: 100%;
	padding: 0;
	margin-bottom: 5px;
}
.carouse-indicators li.active {
  border-radius: 50%;
  width: 10px !important;
  height: 10px !important;
  margin: 4px;
  border-radius: 50%;
  border-color: transparent;
  background-color: #3483fa !important;
}
.carouse-indicators li{
	background-color: #bababa;
	border-radius: 50%;
	display: inline;
	height: 6px;
	padding: 1px;
	width: 6px;
	margin-top: 6px;
	cursor: pointer;
	margin-right: 4px;
}

</style>