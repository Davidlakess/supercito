<template>
	 <div v-if="isMobil">  
      <detalle-compra-mobil
      :items="detalle"
      :venta="venta"
      >
      </detalle-compra-mobil>
    </div>
    <div v-else> 
      <b-container   fluid> 
          <detalle-compra-web
          :items="detalle"
          :venta="venta"
        ></detalle-compra-web>
      </b-container>
    </div>
</template>
<script>
  import detalle_compra from '../compras/items_comprados.vue'
  import detalle_compra_mobil from '../mobile/detalle_compra_mobil.vue'
  export default {
  	props:['detalle','venta'],
    components: {
       'detalle-compra-web':detalle_compra,
       'detalle-compra-mobil':detalle_compra_mobil
    },
    computed:{
      isMobil() {
        return window.isMobil()
      }
    }
}
</script>