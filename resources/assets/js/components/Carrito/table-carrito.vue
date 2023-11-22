<template>

  <b-container fluid style="margin: 0;padding: 0;" v-if="isMobil()">
       <carrito-mobil :data="data">
       <slot></slot>
         <!-- <slot></slot> -->
       </carrito-mobil> 
  </b-container>


  <b-container v-else style="display: flex;flex-direction: column; margin-top: 20px;margin-bottom: 25px;">
    <b-row align-h="center" >
      <b-col cols="12" >
         <carrito-web  :data="data">
          <slot></slot>
         </carrito-web>
      </b-col>
    </b-row>
  </b-container>

</template>
<script>
  import carritomobil from '../mobile/carrito_mobil.vue'
  import carritoweb from '../carrito/carrito_web.vue'
  
export default {
        components:{
    'carrito-mobil':carritomobil,
    'carrito-web':carritoweb
    },
    props:[
    'data'
    ],
    data(){
      return {
      
      }
    },
    mounted() {},
    methods: {
       isMobil() {
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
             return true
           } else {
             return false
           }
      }
    
    }
  }
</script>
