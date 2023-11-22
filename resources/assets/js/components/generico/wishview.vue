<template>

  <b-container fluid style="margin: 0;padding: 0;" v-if="isMobil()">
       <wishview-mobil :data="data">
         <!-- <slot></slot> -->
       </wishview-mobil> 
  </b-container>

  <b-container v-else style="display: flex;flex-direction: column; margin-top: 20px;margin-bottom: 25px;">
    <b-row align-h="center" >
      <b-col cols="12" >
         <wishview-web  :data="data"></wishview-web>
      </b-col>
    </b-row>
  </b-container>

</template>
<script>
  import wishviewmobil from '../mobile/wishview_mobil.vue'
  import wishviewweb from '../generico/wishview_web.vue'
  
export default {
        components:{
    'wishview-mobil':wishviewmobil,
    'wishview-web':wishviewweb
    },
    props:[
    'data'
    ],
    data(){
      return {
      
      }
    },
    mounted() {
          document.title ='Favoritos';},
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
