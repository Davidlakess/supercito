<template>
  <b-col md="12" style="margin-top: 10px;" v-if="categorias[0]">
    <span><strong>Categorías</strong> </span>
    <ul style="padding: 0; margin-top: 10px;" >
      <li class="items-categoria" v-for="c in categorias"><a :href="formaturl(c.name,c.ids)">
        <span style="text-transform: capitalize;"> {{c.name}} </span> <span v-if="productoscount">({{c.n}})</span> </a></li>
    </ul>
    <a :href="ruta+allcategory"><span>Ver todo</span></a>
  </b-col>
</template>
<script type="text/javascript">
export default {
    props:{
      categorias:{type:Array},
      productoscount:{type:Boolean,default:false}
  },
    data(){
      return {
        allcategory:'categorias/AllCategorias',
        ruta:url,
        // paths:"",
      }
    },
    mounted(){
       // this.paths=window.location.pathname.split('/');
    },
  methods:{
    formaturl(value,id){
      let aux= value.split(" ").join("-");
      
      let result=this.ruta+'c/'+aux+'/'+id;
      return result;
    }
  }
}
</script>