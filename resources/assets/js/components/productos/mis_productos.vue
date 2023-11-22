<template>  
  <b-row>
    <template v-for="producto in productos">
  		<miproducto

  		 :img="'/uploads/'+producto.img"
  		 :stock="producto.stock"
       :precio="producto.precio"
       :name="producto.name"
       :fecha="producto.fecha"
       :id="producto.id"
  		></miproducto>
    </template>
  </b-row>
</template>
<script>
  export default {
    data() {
      return {
        productos:[]
      }
    },
    mounted() {
      this.getproductos();
    },
    methods: {
    	indexof(val){
    		alert(val);
    	},
      getproductos(){
        axios.get("api/getproductos").then(data => {
          this.productos=data.data;
          console.log(this.productos);
        }).catch(error => {
             console.log(error);  
        });
      }
    }
  }
</script>