<!-- PONER UNA FECHA DE ENTREGA PARA ENTREGAR LA MERCANCIA -->
<template>	
  <b-container class="ancho-ideal" fluid>
      <b-row align-h="center" style="margin-top: 10px; margin-bottom: 20px;">
        <b-col md="3" style="margin-top: 10px;">
          <b-row align-h="center">
            <b-col md="12" >
              <div class="break-word">
                
              <ol class="andes-breadcrumb">
                
                <template v-for="(n,key) in nav">  
                  <li class="li-sin-decoracion" v-if="key!=0">
                    <i class="fa fa-angle-right icon-category"></i>
                    <a :href="formaturl(n.name,n.id)" :title="n.name" class="link-category">
                      <span class="text-category">{{n.name}}</span>
                    </a>
                  </li>
                  <li class="li-sin-decoracion" v-else> 
                    <a href="#" :title="n.name" class="link-category">
                      <span class="text-category">{{n.name}}</span>
                    </a>
                  </li>
                </template>
              </ol>
              <h1 class="titulo-breadcrumb"><span>{{query}}</span></h1>
              <small>{{productos.length}} Resultados</small>
            
              </div>
            </b-col>
              <listar-categorias :categorias="categorias" ></listar-categorias>
          </b-row>
        </b-col>  

        <b-col md="9" style="margin-top: 35px; padding-left: 20px">
          <b-card no-body class="overflow-hidden" style="width: 900px;" >
            <b-card-body style="padding:15px 0px 20px;">
              <template v-for="(p,key) in paginatedItems">         
                <child-categoria-producto
                  :key="key"
                  :id="p.ids"
                  :name="p.name"
                  :img="p.img"
                  :precio="p.precio"
                  :logeado='logeado'
                  >
                  </child-categoria-producto>        
              </template>
            </b-card-body>
          </b-card>
          <b-col md="11"  class="my-1" style="display: block ruby;text-align:center;">
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

</template>
<script type="text/javascript">

  export default {
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
