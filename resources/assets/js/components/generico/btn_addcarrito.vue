<template>
  <div >
	<b-button 
    v-if="logeado"
    :class="(block)?'btn-block':''"
    variant="outline-primary" 
    @click="addcarrito()">
    Agregar al carrito
  </b-button>

  <b-button 
    v-else
    :class="(block)?'btn-block':''"
    variant="outline-primary" 
    :href="mdruta">
    Agregar al carrito
  </b-button>

</div>
</template>
<script>
  export default {
    props:['id','logeado','block','cant'],
    // props:{
    //   id: {
    //     type: Number,
    //     default: 4
    //   },

    //   logeado: {
    //     type: Boolean,
    //     default: false
    //   },

    //   block: {
    //     type: Boolean,
    //     default: false
    //   },

    //   cant: {
    //     type: String,
    //     default: '1'
    //   }
    // },
    data(){
      return{
        mdruta:"/middlecarrito"
      }
    },
    mounted() {
    
    },
    methods: {
      addcarrito(){
        
    		axios.post(url+"api/addcarrito",{id:this.id,cant:this.cant}).then(data => {
          if(data.data.res){

           toast.fire({
            icon:'success',
            title: 'Producto agregado!'
            })
          }else{
            toast.fire({
              icon:'error',
              title: 'Sin Stock!'
            })
          }
      
        }).catch(error => {
          // console.log(error);  
          toast.fire({
            icon:'error',
            title: 'Hubo un error!'
          })
        
        });
      }
    }
  }
</script>