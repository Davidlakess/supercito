<template>
	<div class='main-container'>
  	<div class='grid-container'>
      <div class='card card--2x' v-if="head">
        <div>
        	<!-- IMAGEN DE LA CATEGORIA -->
          <div class='card__image'>
            <a :href="formaturl(titulo,idc)">
              <img :src="ruta+'/uploads/'+img" loading="lazy" >
            </a>
          
          </div>
        </div>
        <!-- TITULO DE LA CATEGORIA -->
        
         <div class="ui-card foot-main">
          <!-- <span class="main-item-label">{{etiqueta}}</span> -->
          <span class="main-item-title">{{titulo}}</span>
        </div>
      </div>
      
    	<!-- PRODUCTOS DE LA CATEGORIA MAXIMO 8 -->
      <div class='card' v-for="item in pro">
        <div class='card__image'>
          <a :href="formaturlItem(item.name,item.ids)">
              <img :src="ruta+'/uploads/'+item.img" loading="lazy" >
          </a>
          <!-- <a-img :to="id" :src="img" :name="name"></a-img> -->
        </div>
      </div>
    </div>
  </div>
</template>
 <script type="text/javascript">
export default {
  data () {
    return {
      ruta:url
    }
  },
	props:['img','titulo','pro','idc','head'],
  methods:{
    formaturl(value,id){
        let aux= value.split(" ").join("-");
        
        let result=this.ruta+'c/'+aux+'/'+id;

        return result;
    },
    formaturlItem(value,id){
          let aux= value.split(" ").join("-");
          let result=this.ruta+'item/'+id+'-'+aux;
          return result;
    }
  }
}
</script>

 <!--    <div class='card'>
      <div class='card__content'>
        <p><em>Travel is fatal to prejudice, bigotry, and narrow-mindedness.</em></p>
        <p>— Mark Twain</p>
      </div>
    </div>
 -->