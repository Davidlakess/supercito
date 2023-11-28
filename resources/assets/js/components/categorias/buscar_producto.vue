<template>  
    <b-container id="content-p"  fluid>
      <buscar-productoweb
      :productos="productos"
      :categorias="categorias"
      :logeado="logeado"
      :query="query"
      >
      </buscar-productoweb>


      <productos-extra 
      :prodm="prodm" 
      :prodo="prodo"
      ></productos-extra>  
    </b-container>
</template>
<script>
 import proweb from './buscar_producto_web.vue'
export default {
        components:{
    'buscar-productoweb':proweb
    },
    props:['productos','categorias','logeado','query','prodm','prodo'],
    data(){
      return {
        
      }
    },
    mounted() {

    },
}
</script>
