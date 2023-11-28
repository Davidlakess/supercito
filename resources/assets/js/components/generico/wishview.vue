<template>
  <b-container style="display: flex;flex-direction: column; margin-top: 20px;margin-bottom: 25px;">
    <b-row align-h="center" >
      <b-col cols="12" >
         <wishview-web  :data="data"></wishview-web>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
  import wishviewweb from '../generico/wishview_web.vue'
export default {
    components:{
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
      document.title ='Favoritos';
    }
  }
</script>
