<template>
    <div class="thumb-wrapper">
     <wishlist :idproducto="id" :logeado="logeado" :active="wish"></wishlist>
        <div> 
          <a-img :to="id" :src="img" :name="name"></a-img>
        </div>
            <hr>
        <div class="thumb-content">
          <div class="item-titulo"> 
          <span>{{name}}</span>
          </div>              
        <!-- <div class="star-rating">
          <ul class="list-inline">
            <li class="list-inline-item"><i class="fa fa-star"></i></li>
            <li class="list-inline-item"><i class="fa fa-star"></i></li>
            <li class="list-inline-item"><i class="fa fa-star"></i></li>
            <li class="list-inline-item"><i class="fa fa-star"></i></li>
            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
          </ul>
        </div> -->
        <p class="item-price" v-if="logeado"> <!-- <strike>$400.00</strike>--><b>${{precio}}</b></p>
        <p v-else><a :href="ruta+'item/'+id+'-'+name">Ver Precio...</a></p>
  
        <!-- <btn-addcarrito  :logeado="logeado" :id="id"> </btn-addcarrito>  -->
         <div v-if=" parseFloat(stock) !== 0 ">
            <btn-addcarrito
              :id = "id"
              :logeado = "logeado"
              :cant = "1"
              :block = "true"
              >
            </btn-addcarrito>
          </div>
          <div v-else>
            <b-alert show variant="danger">Agotado</b-alert>
          </div>

      </div>             
    </div>
</template>
<script type="text/javascript">
  export default {
    data() {
      return {
        ruta:url
      }
    },
    props:['name','img','precio','id','logeado','wish','stock'],

  }
</script>
