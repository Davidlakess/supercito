<template>
  <b-container style="display: flex;flex-direction: column; margin-top: 20px;margin-bottom: 25px;">
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
  import carritoweb from '../carrito/carrito_web.vue'
export default {
    components:{
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
  }
</script>
