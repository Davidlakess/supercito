<template>
      <v-layout wrap style="width: 100%;">
          <!-- IMAGEN DE LA CATEGORIA -->
        <v-flex md4 style="padding-right: 15px;">
            <v-card height="auto" style="width: 108%;"> 
            <a :href="formaturl(titulo,idc)">
                <img :src="ruta+'uploads/'+img" loading="lazy" >
              </a>
          <!-- TITULO DE LA CATEGORIA -->
          <v-card-actions>
              <span class="main-item-title">{{titulo}}</span>
          </v-card-actions>
        </v-card>
      </v-flex>
      <!-- </div> -->
      
    	<!-- PRODUCTOS DE LA CATEGORIA MAXIMO 8 -->
      <v-flex md8>
      <v-layout row wrap>
        <template v-for="(item,key) in pro" >
            <v-flex style="margin:3px; max-width: 24%;">
              <v-card height="auto" class="card-collection " :key="key" > 
                    <!-- <a :href="formaturlItem(item.name,item.ids)">
                        <img style="height: 215px;" :src="ruta+'/uploads/'+item.img" loading="lazy" >
                    </a> -->
                    <a-img height="215" :to="item.ids" :src="item.img" :name="item.name"></a-img>

              </v-card>
            </v-flex>
        </template>
      </v-layout>
    </v-flex>
</v-layout>
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
 <style>
   .card-collection{
    /*width: 200px;*/
    height: 188px; 
    width: 188px;
    margin-left: 16%;
   }
 </style>

