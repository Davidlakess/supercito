<template>
<div style="display: flex;">
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
               <b-col md="4" style="margin-bottom: 18px;padding-left: 0px;">
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
</div>
</template>
<script>

export default {
    props:['productos','categorias','logeado','query'],
    data(){
      return {
        ruta:url,
        currentPage: 1,
        perPage: 45,
        totalRows: 0,
        paginatedItems:[],
      }
    },
    mounted() {
        this.paginatedItems=this.productos ;
          this.totalRows= this.paginatedItems.length;
          this.paginate(this.perPage, 0);
    },
  methods:{
    formaturl(value,id){
      let aux= value.split(" ").join("-");
      
      let result=this.ruta+'c/'+aux+'/'+id;

      return result;
    },
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