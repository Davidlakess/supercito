<template>
    <div v-if="isMobil" >  
    <productocat-mobil 
    :productos="productos"
    :query="query"
    :logeado="logeado"
    ></productocat-mobil>
  </div>
  <div v-else>
      <productocat-web
      :productos="productos"
      :categorias="categorias"
      :query="query"
      :nav="nav"
      :logeado="logeado"
      >
      </productocat-web>
  </div>

</template>
<script type="text/javascript">
import procategoweb from './producto_por_categoria_web.vue'
import procatmobil from '../mobile/producto_por_categoria_mobil.vue'
export default {
  components:{
    'productocat-web':procategoweb,
    'productocat-mobil':procatmobil
  },
  props:['productos','categorias','query','nav','logeado'],
  computed:{
    isMobil() {
      return window.isMobil()
    }
  }
}
</script>


<style>
  .andes-breadcrumb {
    margin: 0 0 24px;
    font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
    font-size: 14px;
    padding: 0;
    display: -webkit-inline-box;
    position: sticky;
    z-index: 999;

}
.icon-category{
  font-size: 15px;
font-weight: bold;
margin-left: 5px;
margin-right: 1px;
}
.link-category{
  color: #212529;
  text-decoration: none;
}

.li-sin-decoracion{
  list-style: none;
}

.text-category{
  text-transform: capitalize;
}
</style>
