<template>
  <div>
 <v-btn 
  @click="addcarrito()"
  style="background-color: #1867c0  !important;"
  round
  :block="block"
:small="(small)?true:false"
  v-if="logeado"
   color="success"
   dark
  >
    Agregar al carrito
  </v-btn>
  <v-btn 
  style="background-color: #1867c0  !important;"
  round
  :block="block"
  :small="(small)?true:false"
  v-else
  :href="ruta+ 'carrito'"
   color="success"
   dark
  >
    Agregar al carrito
  </v-btn>
</div>
</template>
<script>
  export default {
    props:['id','logeado','block','cant','small'],
    data(){
      return{
        ruta:url,
        text1: ' unidad agregada al carrito',
        text2: ' unidades agregadas al carrito'
      }
    },
    methods: {
      addcarrito(){  
    		axios.post(url+"addcarrito",{id_producto:this.id,cant:this.cant}).then(data => {
          if(data.data.res){
           toast.fire({
            icon:'success',
            title: (this.cant >= 1) ? '¡Exito! '+this.cant + this.text1: '¡Exito! '+this.cant + this.text2
            })
          }else{
            toast.fire({
              icon:'error',
              title: 'Sin Stock!'
            })
          }
        }).catch(error => {
          toast.fire({
            icon:'error',
            title: 'Hubo un error!'
          })
        });
      }
    }
  }
</script>