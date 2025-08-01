<template>	
  <v-carousel class ="" :interval="6000" light hide-delimiters Default style="box-shadow: none;">
    <template v-for="cat in items">
      <v-carousel-item>
        <div id="wrapper">
          <ul>
            <li v-for="item in cat">
              <a :href="formaturl(item.name,item.ids)">
                <i class="icon-list-alt">
                </i>
                <div style="text-transform: capitalize;">
                  {{item.name}}
                </div>
              </a>
            </li>
          </ul>
        </div>
      </v-carousel-item>
    </template>
  </v-carousel>
</template>
<script>
  export default {
    props:['items'],

    methods:{
      formaturl(value,id){
            let aux= value.split(" ").join("-");
            
            let result='c/'+aux+'/'+id;
            return result;
          }, 
    }
  }


</script>

<style>



/*.v-btn:not(.v-btn--depressed):not(.v-btn--flat) {
  background-color: #c9f0c9 !important;
}*/
.v-carousel__prev .v-btn:hover, .v-carousel__next .v-btn:hover {
 background-color: #e1e1e1 !important;
}
</style>