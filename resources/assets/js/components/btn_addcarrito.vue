<template>
	<b-button variant="outline-primary" @click="addcarrito()">Agregar al carrito</b-button>
</template>
<script>
  export default {
    props:['items'],
    data(){
      return{

      }
    },
    mounted() {
    
    },
    methods: {
      addcarrito(){
     // console.log(this.items);

        let formd=new FormData;
        let producto={
          name:this.items.name,
          img:this.items.img,
          precio:this.items.precio,
          cantidad:'1',
          id_producto:this.items.id
        }

        formd.append('data',JSON.stringify(producto));
    		axios.post(url+"api/addcarrito",formd).then(data => {
          
         toast.fire({
          icon:'success',
          title: 'Producto agregado!'
        })
        }).catch(error => {
          console.log(error);  
        });
      }
    }
  }
</script>