<template>
  <div>    
    <b-card no-body class="overflow-hidden" style="cursor: auto;">
          <span style="text-align: center;margin-top:15px;font-size: 25px;font-weight: bold;">
            <p>Tus Favoritos</p>
          </span>
          <hr>
          <b-card-body>
            <table style="width: 100%;">
              <tbody>
                 <!-- <b-form-spinbutton id="sb-inline" inline v-model="total" ></b-form-spinbutton>  -->
                <tr v-for="(item,key) in paginatedItems" :key="key">
                  <td colspan="2">
                     <figure class="card card-product" style="width: 125px;">
                        <div class="img-wrap"> 
                            <a-img :to="item.id_pro" :src="item.img" :name="item.producto"></a-img>
                        </div>
                      </figure>        
                    </td>   
                    <td  colspan="2" style="font-weight: 500;
vertical-align: middle;
font-size: 18px;
text-transform: capitalize;">{{item.producto}}</td>    
                
                  <td colspan="3">
                      <div style="display: flex; margin-bottom: 10px;">
                        <span style="font-size: 27;
font-weight: 600;
margin-right: 15px">$ {{item.precio}}</span>       
                        
                          <b-button variant="success" @click="addcarrito(item.id_pro)" v-b-tooltip.hover title="Agregar al Carrito" 
                          style="margin-left: 11px;"><i class="fa fa-shopping-cart i-carrito"></i></b-button> 
                          <b-button variant="danger" @click="removewhislist(item.id_pro)" v-b-tooltip.hover title="Eliminar de Favoritos" style="margin-left:4px;"><i class="fa fa-trash i-carrito"></i></b-button>
                      </div>
                  </td>    
                </tr>
              </tbody>
            </table>
             <div style="text-align: center;display: block; display: block ruby;">  
          <b-pagination
              @change="onPageChanged"
              :total-rows="totalRows"
              :per-page="perPage"
              v-model="currentPage"
              class="my-0"
            />
             </div>
          </b-card-body>

        </b-card>
      </div>      
</template>

<script type="text/javascript">
	export default {
		props:[
    		'data'
    	],
    	data(){
      return {
          items:[],
          paginatedItems:[],
          currentPage: 1,
          perPage: 7,
          totalRows: 0,
      }
    },
    mounted() {
      this.items=this.data;
      this.paginatedItems= this.items;
      this.totalRows= this.paginatedItems.length;
      this.paginate(this.perPage, 0);
 },
    methods: {
       addcarrito(id){
        axios.post(url+"api/addcarrito",{id:id,cant:1}).then(data => {
          if(data.data.res){
           toast.fire({
            icon:'success',
            title: 'Producto agregado!'
            })
          }else{
            toast.fire({
              icon:'error',
              title: 'Sin Stock!'
            })
          }
      
        }).catch(error => {
          // console.log(error);  
          toast.fire({
            icon:'error',
            title: 'Hubo un error!'
          })
        
        });
      },
      removewhislist(id){
                axios.post(url+"api/delfavoritos",{id:id}).then(data => {     
                    if(data.status=200){
                          toast.fire({
                            icon:'success',
                            title: 'Se elimino de favoritos!'
                          })

                        this.items = this.items.filter(function(dato) {
                          if (dato.id_pro == id) {
                            return false;
                          } else {
                            return true;
                          }
                        });
                        if(this.items.length == 0 ){
                          window.location.href=url+'favoritos';
                        }else{
                          this.paginate(this.perPage, 0);
                        }

                    }else{
                      toast.fire({
                        icon:'error',
                        title: 'Ooops!, Algo Salio Mal!'
                      })
                    }
                  }).catch(error => {
                    // console.log(error);  
                    toast.fire({
                      icon:'error',
                      title: 'No Se Pudo Realizar la Accion!'
                    })

                  
                  });
          },
      paginate(page_size, page_number) {
          let itemsToParse = this.items;
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

.card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 100px;
    text-align: center; 
  }
  .card-fixed{
    width: 100%;
    position: fixed !important;
    top: 72%;
    padding: 10px;
    background: #fff;

  }
    .card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden; 
  }

    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; 
    }

  .i-carrito{
    padding-left: 1px;
    padding-right: 1px;
    font-size: 14px;

  }
.carrito .w-100 {
    /*width: 100% !important;*/
    min-width: 1.5em !important;
}

</style>