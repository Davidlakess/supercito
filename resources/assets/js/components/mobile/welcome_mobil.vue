<!-- 
RED HOT
https://www.youtube.com/watch?v=HI-8CVixZ5o
https://www.youtube.com/watch?v=a9eNQZbjpJk
https://www.youtube.com/watch?v=0XcN12uVHeQ
this is de place red hot

 -->
<template>	
  <div> 
    <!-- controls -->
  <b-carousel
    id="carousel-1"
    :interval="6000"          
    indicators
    controls
    background="#ababab"
    img-width="984"
    img-height="450"
    style="text-shadow: 1px 1px 2px #333; margin:0; padding: 0;"
  >    
    <b-carousel-slide
      v-for="(slide,indx) in slider"
      :img-src="ruta +slide.img"
      :key="indx"
      >
    </b-carousel-slide>   
  </b-carousel>

  <template v-if="historial.length!=0">  
      <div class="super-titulo-m" style="padding-left: 15px;"><span>Productos vistos recientemente</span>
      </div>
      <div class="carousel-h">
        <div  v-for="pro in historial">
          <productos-swiper 
          :name="pro.name"
          :id="pro.ids"
          :img="pro.img"
          :precio="pro.precio"
          ></productos-swiper>
        </div>
      </div>
  </template>

    <template v-if="productosnuevos">  
      <div class="super-titulo-m" style="padding-left: 15px;"><span>Productos nuevos</span>
      </div>
      <div class="carousel-h" style=" margin-bottom: 10px;">
        <div  v-for="pro in productosnuevos">
           <productos-swiper 
          :name="pro.name"
          :id="pro.id_producto"
          :img="pro.img"
          :precio="pro.precio"
          ></productos-swiper>
        </div>
      </div>
    </template>
   <!--  <pre>
      
    {{productos}}
    </pre> -->
    <template v-for="item in productos">  
      <producto-card-mobil v-if="item.items.length!=0" :items="item.items" :categoria="item.categoria">
      </producto-card-mobil>
    </template>



  </div>
</template>
<script>
import procard from '../Generico/producto-card-mobil.vue'
import proswiper from '../Generico/productos-swiper.vue'
  
	export default {
    components: {
        'productos-swiper':proswiper,
        'producto-card-mobil':procard 
    }, 
	props:['productos','productosnuevos',"historial"],
        
	data(){
			return {
        ruta: url,
				pro:[],
        slider:[
        {
          // img:'https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:low/1621832516061-home-slidermobile.jpg'
          img:'/slide-mobil1.jpg'
        },
        {
          // img:'https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:low/1621825896624-home-slider-landscapeapp-1234x7.jpg'
          img:'/slide-mobil2.jpg'
        },
        {
          // img:'https://http2.mlstatic.com/storage/splinter-admin/o:f_webp,q_auto:low/1621550159111-home-slidermobile.jpg'
          img:'/slide-mobil3.jpg'
        }
        ],
				mdruta:"/middlecarrito",
				// ismobil:false,
			}
		},
}
</script>
<style>	
html {

    overflow-x: hidden;
}
.text-gray {
    color: #aaa
}

.imgitem {
    height: 170px;
    width: 140px
}


/*img*/
 .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 100px;
    text-align: center; }
  
  .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; 
  }
      
.name-producto{
    margin: 0;padding: 0;
    position: static;
    font-size: 14px;
    font-weight: 400;
    color: #424242;
    line-height: 18px;
    height: 73px;
    /*word-break: break-all;*/
}

.carousel-h img {
    max-width: 100%;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.carousel img {
    width: 360px !important;
    height: 163px !important;
}

.carousel-h > div {
    flex: 0 0 auto;
max-width: 185px;
height: 100px;
scroll-snap-align: start;
/*    flex: 0 0 auto;
    max-width: 320px;height: 100%;
    scroll-snap-align: start;*/
}

.carousel-h{
/*  display: flex;
  flex-wrap: nowrap;

  width: 100%;
  max-width: 320px;
  height: 200px;
  overflow: scroll;

  scroll-snap-type: x mandatory;
  scroll-behavior: smooth;*/

  display: inline-flex;
flex-wrap: nowrap;
width: 100%;
/*max-width: 320px;*/
height: 135px;
overflow: scroll;
scroll-snap-type: x mandatory;
scroll-behavior: smooth;
margin-bottom: 10px; 
overflow-y: hidden;
}


/*
  papel    parent MNL7890
  MNL6589

  
body #wrapper {
  width: 100%;
  height: 69%;
  margin-top: 20px;

}

body #wrapper ul {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0 auto;
  padding: 0;
  height: 118px;
  font-size: 0px;
}


body #wrapper ul li {
 display: inline-block;
float: left;
width: 50%;
-moz-transition: all 0.1s;
-o-transition: all 0.1s;
-webkit-transition: all 0.1s;
transition: all 0.1s;
text-align: center;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
text-shadow: 0px 1px 3px white;
border-right: thin solid lightgray;
border-bottom: thin solid lightgray;
background-color: white;
height: 141px;
}
body #wrapper ul li:last-child {
  border-right: none;
}

body #wrapper ul li:hover {
  -moz-box-shadow: inset 10px 10px 10px -10px rgba(0, 0, 0, 0.3), inset -10px 10px 10px -10px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: inset 10px 10px 10px -10px rgba(0, 0, 0, 0.3), inset -10px 10px 10px -10px rgba(0, 0, 0, 0.3);
  box-shadow: inset 10px 10px 10px -10px rgba(0, 0, 0, 0.3), inset -10px 10px 10px -10px rgba(0, 0, 0, 0.3);
}

body #wrapper ul li a:hover {
   background-color: #3483fa;
   color: #fff !important;

}


body #wrapper ul li a {
  display: flex;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
text-decoration: none;
font-size: 38px;
outline: 1px solid #eae6e6;
padding: 50px;
flex-direction: column;
height: 100%;
}
body #wrapper ul li a:visited {
  color: gray;
}
body #wrapper ul li div {
  margin-top: 5px;
  font-weight: 600;
  font-size: 13px;
}*/
</style>

