<template>  
    <div v-if="isMobil" >  
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

          <div style="padding-bottom: 7%;">
          <productos-extra 
          :prodm="prodm" 
          :prodo="prodo"
          ></productos-extra>  
          </div>
        </b-container>
      </div>
</template>
<script>
 import proweb from './buscar_producto_web.vue'
 import promobil from '../mobile/buscar_producto_mobil.vue'
 import productosextra from './productos_extra.vue'
export default {
    components:{
      'buscar-productoweb':proweb,
      'productos-extra': productosextra,
      'buscar-productomobil':promobil
    },
    props:['productos','categorias','logeado','query','prodm','prodo'],
    computed:{
      isMobil(){
        return window.isMobil()
      }
    }
}
</script>
