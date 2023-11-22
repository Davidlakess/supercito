<template>
	<div  class="carousel slide" data-ride="carousel" data-interval="0">
      <!-- Carousel indicators -->
	    <!-- <ol class="carousel-indicators">
	        <li v-for="n in slidesCount" @click="goto(n-1)" :class="{active: n-1==index}"></li>
	    </ol> -->   
	    <div class="carousel-inner">
			
			<slot></slot>
			
			<b-button variant="link"
                v-show="slidesCount >= 2"
			 class="carousel-control left carousel-control-prev" 
			 @click.prevent="prev">
	        	<i class="fa fa-angle-left"></i>
	      	</b-button>

	      	<b-button variant="link"
          v-show="slidesCount >= 2"
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
		},
    mounted(){
      console.log(this.slides.length);
      this.slides=this.$children;
    }
	}
</script>
<style>
	.carousel {
  margin-bottom: 30px;
/*margin-top: 22px;*/
  /*margin: 50px auto;*/
  /*padding: 0 70px;*/
}
.section-header h1{
    font-size: 26px;
    font-weight: 300;
    margin: 0 0 0 8px;
}



.carousel .item {
  color: #747d89;
  min-height: 325px;
    text-align: center;
  overflow: hidden;
}
.carousel .thumb-wrapper {
  padding: 25px 15px;
  background: #fff;
  border-radius: 6px;
  text-align: center;
  position: relative;
  box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}
.carousel .item .img-box {
  height: 170px;
  margin-bottom: 20px;
  width: 100%;
  position: relative;
}
.carousel .item img { 
  max-width: 100%;
  max-height: 100%;
  display: inline-block;
  position: absolute;
  bottom: 0;
  margin: 0 auto;
  left: 0;
  right: 0;
}
.carousel .item h4 {
  font-size: 18px;
}
.carousel .item h4, .carousel .item p, .carousel .item ul {
  margin-bottom: 5px;
}
.carousel .thumb-content .btn {
  color: #7ac400;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
    background: none;
    border: 1px solid #7ac400;
    padding: 6px 14px;
    margin-top: 5px;
    line-height: 16px;
    border-radius: 20px;
}
.carousel .thumb-content .btn:hover, .carousel .thumb-content .btn:focus {
  color: #fff;
  background: #7ac400;
  box-shadow: none;
}
.carousel .thumb-content .btn i {
  font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}
.carousel .carousel-control {
 height: 44px;
width: 44px;
background: #fff;
border-radius: 25px;
opacity: 0.8;
box-shadow: 2px 2px 3px 2px #d5dcdcb8;
margin-left: 6px;
margin-right: 6px;
margin-top: 12%;
}
.carousel .carousel-control i {
    font-size: 36px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -19px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: #0000ff96;;
  text-shadow: none;
    font-weight: bold;
}
.thumb-content{
  display: grid;
}
.card-descripcion{
font-size: 15px;
font-weight: 300;
line-height: 1.3;
height: 32px;
text-transform: capitalize;
}
/*.carousel .carousel-control:hover {
  background: #78bf00;
  opacity: 1;
}*/
/*.carousel .carousel-control i {
    font-size: 36px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -19px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: #fff;
  text-shadow: none;
    font-weight: bold;
}*/
.carousel .item-price {
  font-size: 26;
  padding: 2px 0;
  font-weight: 600;
}
.carousel .item-price strike {
  opacity: 0.7;
  margin-right: 5px;
}
.carousel .carousel-control.left i {
  margin-left: -2px;
}
.carousel .carousel-control.right i {
  margin-right: -4px;
}

.carousel .wish-icon {
  position: absolute;
  right: 10px;
  top: 10px;
  z-index: 99;
  cursor: pointer;
  font-size: 16px;
  color: #abb0b8;
}
.carousel .wish-icon .fa-heart {
  color: #ff6161;
}
.star-rating li {
  padding: 0;
}
.star-rating i {
  font-size: 14px;
  color: #ffc000;
}






.carousel .carousel-indicators {
  /*bottom: -50px;*/
}
.carousel-indicators li, .carousel-indicators li.active {
  border-radius: 50%;
  width: 10px !important;
  height: 10px !important;
  margin: 4px;
  border-radius: 50%;
  border-color: transparent;
  background-color: #000 !important;
}

</style>