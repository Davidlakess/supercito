<template>
<div style="display: flex;margin-bottom: 10%;">
    <b-container id="content-p" class="ancho-ideal" fluid>
      <b-row align-h="center">
          <b-col md="12">
          <div >
            Búsquedas relacionadas:<span class="items-search">baileyscaviar carnes keslim fast </span>
          </div>
        </b-col>
  
        <b-col md="2" style="margin-top: 10px;">
          <b-row align-h="center">
            <b-col md="12" >
              <h1 class="titulo-breadcrumb"><span>{{query}} </span></h1>
              <small>{{productos.length}} Resultados</small>
            </b-col>

              <listar-categorias :categorias="categorias" :productoscount="false" ></listar-categorias>
          
          </b-row>
        </b-col>

        <b-col md="10" style="margin-top: 10px; padding-left: 75px">
  					<b-row align-h="center">
      				<template v-for="pro in paginatedItems">
               <b-col md="3" style="margin-bottom: 18px;padding-left: 0px;">
                  <producto-solo
                  :img="pro.img"
                  :name="pro.name"
                  :precio="pro.precio"
                  :id="pro.id_producto"
                  :wish="pro.wish"
                  :logeado="logeado"
                  :stock="pro.stock"
                  ></producto-solo>
                </b-col>
      		    </template>
  	        </b-row>
            <b-col md="12"  class="my-1" style="display: block ruby;text-align:center;">
              <!-- <b-pagination
                @change="onPageChanged"
                :total-rows="totalRows"
                :per-page="perPage"
                v-model="currentPage"
                class="my-0"
              /> -->
           <v-pagination
          @input="PageChanged"
          :length="pages"
          v-model="currentPage"
          :total-visible="7"
          circle
          color="red"
        ></v-pagination>
            </b-col>  
        </b-col>
      </b-row>
    </b-container>
</div>
</template>
<script>
import listarcategoria from '../categorias/listar_categorias.vue'
import productosolo from './producto_solo.vue'
import productosextra from './productos_extra.vue'
export default {
    components:{
      'listar-categorias':listarcategoria,
      'producto-solo':productosolo,
      'productos-extra': productosextra
    },
    props:['productos','categorias','logeado','query'],
    data(){
      return {
        ruta:url,
        perPage: 15,
        currentPage: 1,
        totalRows: 1,
        pages: 0,
        paginatedItems:[],
      }
    },
    mounted() {

        this.paginatedItems = this.productos 
        this.totalRows = this.paginatedItems.length
        if (this.perPage == null || this.totalRows == null) {
          this.pages = 0
        } else {
          this.pages = Math.ceil(this.totalRows / this.perPage)
        }
        this.paginate(this.perPage, 0)
        this.show = true
    },
  methods:{
    formaturl(value,id){
      let aux= value.split(" ").join("-");
      
      let result=this.ruta+'c/'+aux+'/'+id;

      return result;
    },
     paginate (PageSize, PageNumber) {
        let itemsToParse = this.productos 
        this.paginatedItems = itemsToParse.slice(
          PageNumber * PageSize,
          (PageNumber + 1) * PageSize
        )
      },
      // cerrar () {
      //   window.eventBus.$emit('close-buscar')
      // },
      PageChanged (page) {
        this.paginate(this.perPage, page - 1)
      }
  }
}
</script>
<style>
  .items-categoria{
  list-style: none;
margin: 0 0 6px;

/*
font-size: 14px;
font-weight: 300;
color: #999;
*/
font-weight: 400;
font-size: 14px;
/*margin-left: 0;*/
white-space: nowrap;
}

.items-categoria a{
  color: #666 !important;
  text-decoration: none !important;
}
 .titulo-breadcrumb{
    color: #333;
    display: block;
    font-size: 26px;
    font-weight: 600;
    line-height: 30px;
    padding-right: 16px;
    position: relative;
    word-wrap: break-word;
    z-index: 1;
    text-transform: capitalize;
  }

</style>