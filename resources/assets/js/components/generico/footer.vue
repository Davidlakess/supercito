<template>
  <v-footer height="auto" dark id="footer" absolute>
    <v-layout
      justify-center
      row
      wrap
    >
      <v-btn
        v-for="(link,key) in links"
        :key="key"
        color="white"
        flat
        round
        :href="ruta+link.ruta"
      >
        {{ link.name }}
      </v-btn>
      <v-flex
        color="teal"
        py-3
        text-xs-center
        white--text
        xs12
      >
        &copy; Todos los Derechos Reservados. 2024 — <strong>SupercitoMx</strong>
      </v-flex>
    </v-layout>
  </v-footer>
</template>
<script>
  export default {
    created (){
      window.eventBus.$on('footer', (val) => {
        this.absolute = val
      })
    },
    data: () => ({
      absolute: false,
      ruta:url,
      links: [
        {name:'Inicio',ruta:''},
        {name:'Mis Compras', ruta:'register'},
        {name:'Carrito', ruta:'carrito'},
        {name:'Contacto',ruta:'contacto'}
      ]
    })
  }
</script>