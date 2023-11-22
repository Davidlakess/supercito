<template>
   <div v-if="isMobil()" >  
        <buscar-productomobil
          :productos="productos"
          :categorias="categorias"
          :logeado="logeado"
          :query="query"
        ></buscar-productomobil> 
    </div>
      <div v-else>  
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

      </div>
</template>
<script>
 import proweb from './buscar_producto_web.vue'
 import promobil from '../mobile/buscar_producto_mobil.vue'

export default {
        components:{
    'buscar-productoweb':proweb,
    'buscar-productomobil':promobil
    
    },
    props:['productos','categorias','logeado','query','prodm','prodo'],
    data(){
      return {
        
      }
    },
    mounted() {

    },
  methods:{
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
