<template>
<v-container fluid>
        <v-layout wrap class="producto-carousel-layout">
           <v-flex md12>
  	         <wishlist :idproducto="idproducto" :logeado="logeado"></wishlist>
            </v-flex>
             <v-flex md12>
              <a-img :to="idproducto" :src="img" :name="name"></a-img>
            </v-flex>
             <v-card-actions>
               <v-layout wrap style="width: 100%;">
              	<v-flex md12>
                  <div class="item-price" v-if="logeado"> <!-- <strike>$400.00</strike>-->${{formato(precio)}}</div>
                  <div v-else><a :href="ruta+'item/'+idproducto+'-'+name">Ver Precio...</a></div>
                </v-flex>
                <v-flex md12>
                <div class="card-descripcion">
                  <span>{{name}}</span>  
                </div>
                </v-flex>
                <v-flex md12>
                <div v-if=" parseInt(stock) !== 0 ">
                  <btn-addcarrito
                    :id = "idproducto"
                    :logeado = "logeado"
                    :cant = "1"
                    :block = "true"
                    >
                  </btn-addcarrito>
                </div>
                  <div v-else>
                    <b-alert show variant="danger">Agotado</b-alert>
                  </div>
                </v-flex>
              </v-layout>
          </v-card-actions>
        </v-layout>
      </v-container>
</template>
<script>
	export default {
	props:['idproducto','img','name','precio','logeado','stock'],
		data(){
			return {
				ruta:url
			}
		},
    mounted (){
      this.formato()
    },
    methods:{
      formato(val){
        return window.formatPrice(val)
      },
    }
}
</script>