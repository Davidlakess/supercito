<template>

<div id="ap" v-if="mobil">
  <div class="row">
    <div class="col-md-12">
      <!-- <div class="swiper-container"> -->
   <!--      <p class="swiper-control">
          <button type="button" class="btn btn-default btn-sm prev-slide">Prev</button>
          <button type="button" class="btn btn-default btn-sm next-slide">Next</button>
        </p> -->
        <div class="swiper-wrapper timeline">
          <div :id="'popover-target-'+key" class="swiper-slidem" v-for="(item,key) in statusventa">
            <div class="timestampm" style="display: inline-block;
font-size: 28px;
margin-right: 24px;">
              <!-- <span class="date">{{item.dateLabel}}</span> -->
              <i :class="steps[key].icono"></i>
            </div>
            <div class="status" >
                  
                  <b-popover :target="'popover-target-'+key" triggers="hover" placement="top">
                      <template v-slot:title>{{steps[key].head}}</template>
                      <strong>{{steps[key].descrip}}</strong>
                  </b-popover>

              <span class='activo'>{{steps[key].title}}</span>
              
            </div>
          </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      <!-- </div> -->
    </div>
  </div>
</div >
<div id="ap" v-else> 
    <div class="row">
    <div class="col-md-12">
      <!-- <div class="swiper-container"> -->
   <!--      <p class="swiper-control">
          <button type="button" class="btn btn-default btn-sm prev-slide">Prev</button>
          <button type="button" class="btn btn-default btn-sm next-slide">Next</button>
        </p> -->
        <div class="swiper-wrapper timeline">
          <div :id="'popover-target-'+key" class="swiper-slide" v-for="(item,key) in statusventa">
            <div class="timestamp" style="display: inline-block;
font-size: 35px;
margin-right: 24px;">
              <!-- <span class="date">{{item.dateLabel}}</span> -->
              <i :class="steps[key].icono"></i>
            </div>
            <div class="status" >
                  
                  <b-popover :target="'popover-target-'+key" triggers="hover" placement="top">
                      <template v-slot:title>{{steps[key].head}}</template>
                      <strong>{{steps[key].descrip}}</strong>
                  </b-popover>

              <span class='activo'>{{steps[key].title}}</span>
              
            </div>
          </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      <!-- </div> -->
    </div>
  </div>
</div>
</template>

<script>
export default {
    props:['status','mobil'],
    data() {
      return {
        statusventa:0,
        steps:[
               {title:'Preparando tu pedido',
               descrip:'Tu pedido se esta preparando. espera la actualizacion de tu pedido.',
               head:'Alistando',
               icono:'fa fa-check-circle text-success'},
               {title:'Pedido en camino',
               descrip:'Tu pedido va en camino.',
               head:'En camino',
               icono:'fa fa-truck text-secondary'},
               {
                title:'Pedido entregado',
                descrip:'Entregamos tu pedido,te esperamos pronto :)',
                head:'Finalizado',
                icono:'fa fa-handshake-o text-dark'},
              ]
      }
    },
      mounted() {
        this.statusventa=parseInt(this.status);
        // var swiper = new Swiper('.swiper-container', {
        //   //pagination: '.swiper-pagination',
        //   slidesPerView: 4,
        //   paginationClickable: true,
        //   grabCursor: true,
        //   paginationClickable: true,
        //   nextButton: '.next-slide',
        //   prevButton: '.prev-slide',
        // });    
    },
    methods: {
    	
    }
  }
</script>

<style>
/*#ap {
  padding: 50px 0;
}
*/
.timeline {
  margin: 50px 0;
  list-style-type: none;
  display: flex;
  padding: 0;
  text-align: center;
}

.timeline li {
  transition: all 200ms ease-in;
}

.timestamp {
  width: 200px;
  margin-bottom: 20px;
  padding: 0px 40px;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-weight: 100;
}
.timestampm {
width: 0px;
margin-bottom: 20px;
padding: 0px 40px;
display: flex;
flex-direction: column;
align-items: center;
font-weight: 100;
}

.status {
  padding: 0px 40px;
  display: flex;
  justify-content: center;
  border-top: 4px solid #3e70ff;
  position: relative;
  transition: all 200ms ease-in;
}

.status span {
  font-weight: 600;
  padding-top: 20px;
}

.status span:before {
  content: "";
  width: 25px;
  height: 25px;
  background-color: #e8eeff;
  border-radius: 25px;
  border: 4px solid #3e70ff;
  position: absolute;
  top: -15px;
  left: 42%;
  transition: all 200ms ease-in;
}

 .activo:before {
  background-color: chartreuse !important;
}

.swiper-control {
  text-align: right;
}

.swiper-container {
  width: 100%;
  height: 250px;
  margin: 50px 0;
  overflow: hidden;
  padding: 0 20px 30px 20px;
}

.swiper-slide {
  width: 33%;
  /*width: 200px;*/
  text-align: center;
  font-size: 18px;
}
.swiper-slidem {
  width: 33%;
  /*width: 200px;*/
  text-align: center;
  font-size: 12px;
}
.swiper-slide:nth-child(2n) {
  /*width: 40%;*/
  width: 33%;
}

.swiper-slide:nth-child(3n) {
  /*width: 20%;*/
  width: 33%;
}
</style>