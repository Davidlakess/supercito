<template>	
  <v-carousel-item>
    <template v-for="cat in items">
      <v-carousel-item-slide>
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
      </v-carousel-item-slide>
    </template>
  </v-carousel-item>
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