<!-- PONER UNA FECHA DE ENTREGA PARA ENTREGAR LA MERCANCIA -->
<template>	
    <b-container id="content-p" class="ancho-ideal" fluid>
      <b-row align-h="center">
        <b-col md="3" style="margin-top: 10px;">
          <b-row align-h="center">
            <b-col md="12" >
              <h1 class="titulo-breadcrumb"><span>{{query}} </span></h1>
              <small>{{productos.length}} Resultados</small>
            </b-col>

              <listar-categorias :categorias="categorias" :productoscount="false" ></listar-categorias>
          
          </b-row>
        </b-col>

        <b-col md="9" style="margin-top: 10px; padding-left: 75px">
            <b-row align-h="center" style="width: 100%;">
              <template v-for="pro in paginatedItems">
               <b-col md="4" style="margin-bottom: 18px;padding-left: 0px;">
                  <producto-solo
                  :img="pro.img"
                  :name="pro.name"
                  :precio="pro.precio"
                  :id="pro.ids"
                  :wish="pro.wish"
                  :logeado="logeado"
                  ></producto-solo>
                </b-col>
              </template>
            </b-row>
            <b-col md="12"  class="my-1" style="display: block ruby;text-align:center;">
              <b-pagination
                @change="onPageChanged"
                :total-rows="totalRows"
                :per-page="perPage"
                v-model="currentPage"
                class="my-0"
              />
            </b-col>  
        </b-col>
      </b-row>
    </b-container>
</template>
<script type="text/javascript">
import listarcategoria from '../categorias/listar_categorias.vue'
import productosolo from './producto_solo.vue'
  export default {
      components:{
      'listar-categorias':listarcategoria,
      'producto-solo':productosolo,
      },
      props:['productos','categorias','query','nav','logeado'],
        data(){
      return {
        ruta:url,
        currentPage: 1,
        perPage: 30,
        totalRows: 0,
        paginatedItems:[],
      }
    },mounted() {
        this.paginatedItems=this.productos ;
          this.totalRows= this.paginatedItems.length;
          this.paginate(this.perPage, 0);
    },methods:{
          paginate(page_size, page_number) {
          let itemsToParse = this.productos;
          this.paginatedItems = itemsToParse.slice(
            page_number * page_size,
            (page_number + 1) * page_size
          );
        },
        onPageChanged(page) {
          this.paginate(this.perPage, page - 1);
        },
        reverse_array(array){
          if(array.length>1){
            return array.reverse();
          }else{
            return array;
          }
        },
      formaturl(value,id){
        let aux= value.split(" ").join("-");
        let result=this.ruta+'c/'+aux+'/'+id;
        return result;
    }
      }
  }

</script>


<style>
  /*.andes-breadcrumb {
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
}*/
</style>
