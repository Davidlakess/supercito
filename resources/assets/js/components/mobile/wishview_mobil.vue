<template>
  <div>    
        <b-card no-body class="overflow-hidden" >
          <span style="text-align: center;margin-top:15px;font-size: 25px;font-weight: bold;">
        		<p>Tus Favoritos</p>
        	</span>
          <hr>
          <b-card-body>
            <table style="width: 100%;">
              <tbody>
                 <!-- <b-form-spinbutton id="sb-inline" inline v-model="total" ></b-form-spinbutton>  -->
              
                <div v-for="(item,key) in items" :key="key"> 
                <tr>
                  <td>
                     <figure class="card card-product" style="width: 79px;margin-left: 9px;margin-right: 3px; margin-top: 15px;">
                        <div class="img-wrap"> 
                          <a-img :to="item.id" :src="item.img" :name="item.producto"></a-img>
                        </div>
                      </figure>        
                    </td>   
                    <td>
                      <span style="font-weight: 600;">{{item.producto}}</span>
                    </td>    
                </tr>
                <tr  style="border-bottom: 1px solid rgb(225, 225, 221); margin-bottom: 15px; width: 100%; ">
                  <td colspan="2">
                      <div style="display: flex; margin-bottom: 10px;">
                        <span style="font-size: 20px;font-weight: 500;margin-right: 15px;">$ {{item.precio}}</span>       
                          <button 
                         class="btn btn-sm btn-success" 
                         title="Agregar al Carrito"
                          style="margin-left: 11px;"><i class="fa fa-shopping-cart i-carrito"></i></button> 
                        <button class="btn btn-sm btn-danger"  title="Eliminar de Favoritos" style="margin-left:4px;"><i class="fa fa-trash i-carrito"></i></button> 
                      </div>
                  </td>    
                </tr>
                </div>
              </tbody>
            </table>
             
          
          </b-card-body>

        </b-card>   
      </div>      
</template>


<script>


// import $ from 'jquery';
export default {
      
    props:[
    'data'
    ],
    data(){
      return {
          items:[],
      }
    },
    mounted() {
      this.getproductos();
 },
    methods: {

      removeitemcarrito(id_detalle){
          let cat =this.$refs['cant'+index][0].localValue;
          let dat =new FormData();
          dat.append('id_detalle',id_detalle);
          dat.append('cantidad',cant);
          axios.post("api/putcantidadproducto",dat);
      },
      
      formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },

      getproductos(){
        this.items=this.data;
      },
      remove_wish_item(id_detalle){
             var size=this.items.length;
              let dat =new FormData();
              if(size==1){
                this.borrarultimoitem(size,dat,id_detalle);
              }else{

              dat.append('id_detalle',id_detalle);
              dat.append('size',size);
              axios.post("api/removeitem",dat).then(data => {
              
                const toast = swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
                });

                  toast.fire({
                    icon:'success',
                    title: 'Se quito el producto!'
                  })
                });
                
              this.removeitemtable(id_detalle);
              }
            
      },
      
      removeitemtable(id){

            this.items = this.items.filter(function(dato) {
              if (dato.id_detalle == id) {
                return false;
              } else {
                return true;
              }
            });
      },
    }
  }


</script>

<style>
    .card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden; 
  }
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 70px;
    text-align: center; }
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