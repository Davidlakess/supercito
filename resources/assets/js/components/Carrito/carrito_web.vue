<template>
  <div style="margin-bottom: 7%;">    
    <b-card no-body class="overflow-hidden" style="cursor: auto;">
          <span style="text-align: center;margin-top:15px;font-size: 25px;font-weight: bold;">
            <p>Tu Carrito de Compras</p>
          </span>
          <hr>
          <b-card-body>
            <div>
                <slot></slot>
                
                <b-alert show dismissible variant="danger">
                  Compra minima de $100.00 pesos
                </b-alert>
                <!-- 
                <b-alert show dismissible variant="success">
                  En la compra de  $500.00 pesos o mas tu envio es <strong>Gratis</strong>
                </b-alert> -->
            </div>  
            <table style="width: 100%;">
              <tbody>
                 <!-- <b-form-spinbutton id="sb-inline" inline v-model="total" ></b-form-spinbutton>  -->
                <tr v-for="(item,key) in paginatedItems" :key="key">
                  <td colspan="2">
                     <figure class="" style="width: 150px;">
                        <div class="img-wrap"> 
                          <img :src="ruta+'/uploads/'+item.img">
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

                          <template v-if="item.cantidad <= item.stock">
                            
                           <b-form-spinbutton  id="sb-inline" inline 
                           :ref="'cant'+key" :value="item.cantidad" @change="disable=false;"></b-form-spinbutton>   
                        
                            <button  @click="addcantidad(item.id_detalle,key)"
                           class="btn btn-sm btn-primary"
                           :disabled="disable"
                            style="margin-left: 11px;"><i class="fa fa-undo i-carrito"></i></button> 
                          </template> 
                          <template v-else>
                            <b-alert show variant="danger">
                              Producto Agotado
                            </b-alert>
                          </template>   
                        <button @click="remove_carrito_item(item.id_detalle)" class="btn btn-sm btn-danger" style="margin-left:4px;"><i class="fa fa-trash i-carrito"></i></button> 

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
                      
        <b-card no-body id="detalle" class="static" style="cursor: auto;" >
              <div>
                <div style="font-size: 22;
font-weight: bold;
display: grid;
margin-bottom: 15px;">
                  <span>Subtotal: $ {{subtotal}}</span>
                 <div style="display: flex;margin-bottom: 10px;margin-top: 10px;">
                  <span>Propina:</span>
                 <b-form-spinbutton 
                 ref="propinar"
                 class="carrito" 
                 id="sb-inline" 
                 :value="propina"
                 min="0"
                 inline 
                 @change="sumarpropina" 

                 ></b-form-spinbutton> 
                 </div>
                  <span>Total: $ {{formatPrice(total)}} </span>
                </div>
                <div style="display: flex;">
                  <div style="width: 50%;"> 
                <form method="get" ref="checkout" @submit.prevent="checkout()" action="checkout/pagarview">
                      <input type="hidden" name="tip" v-model.lazy="propina">
                      <input type="hidden" name="id" v-model="id">
                      <!-- <input type="hidden" name="_token" v-model="token"> -->
                    <b-button variant="outline-primary btn-block" type="submit">Comprar Carrito</b-button>
                </form>
                  </div>
                <div style="width: 50%;"> 
                    <b-button @click="seguircomprando()" variant="outline-success btn-block" style="margin-left:10px;" >Seguir Comprando</b-button>  
                </div>
                
                </div>
              </div>  
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
          ruta: url,
          propina:2,
          total:0,
          id:this.data[0].id_carrito,
          cantidades:1,
          token:'',
          items:[],
          subtotal:0,
          disable:true,
          paginatedItems:[],
          currentPage: 1,
          perPage: 7,
          totalRows: 0,
          auxsubtotal: 0
      }
    },
     computed: {

     },
    mounted() {
      this.items=this.data;
      this.sumproductos()
      this.paginatedItems= this.items;
      this.totalRows= this.paginatedItems.length;
      this.paginate(this.perPage, 0);

 },
    methods: {
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
      seguircomprando(){
           window.location.href=url; 
      },
      checkout(){
            console.log(parseFloat(this.auxsubtotal))
            console.log(parseFloat(this.auxsubtotal) >= 100)
            if(parseFloat(this.auxsubtotal) >= 100){

              this.$refs.checkout.submit();
            } else{
              toast.fire({
                      icon:'error',
                      title: '¡El minimo de compra es de $100 pesos!'
              })
            }  
      },
      sumarpropina(){
            var cant = this.$refs.propinar.localValue;
            this.propina=cant;
            this.total=parseFloat(this.subtotal)+ parseFloat(cant);
            // console.log('cant',cant);
            // console.log(this.subtotal);
            // console.log(this.subtotal+ parseInt(cant))
      },
      info(key){
       
      },
      existencia(stock){
          return parseInt(stock);
      },

      addcantidad(id_detalle,indx){

            let cant = this.$refs['cant'+indx][0].localValue;
            this.addcantidadserver(cant,id_detalle,indx);  
            this.disable=true;
          
      },
      addcantidadserver(cant,id_detalle,index){
            // let cant = this.$refs['cant'+index][0].localValue;
            let dat =new FormData();
            dat.append('id_detalle',id_detalle);
            dat.append('cantidad',cant);
               const toast = swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                          });

            axios.post("addcantidad",dat).then(data => {
              
              // Actualizar el stock del producto tambien
              console.log(data.data)
              var cant = data.data.cant;
              var stock = data.data.stock;
              
              if(data.data.status){
                  this.items[index].cantidad=parseInt(cant);  
                  this.items[index].stock=parseInt(stock);  
                    this.$nextTick(() => {
                      toast.fire({
                        icon:'success',
                        title: '¡Cantidad Actualizada!'
                      })
                      this.sumproductos();
                    })
              }else{

                this.items[index].cantidad=parseInt(cant);
                this.sumproductos();
                  toast.fire({
                    icon:'error',
                    title: '¡solo hay '+cant+' unidades disponibles!'
                  })

                  this.$refs['cant'+index][0].localValue=cant;

              }

            }).catch(error => {

                   toast.fire({
                    icon:'error',
                    title:error + 'Error al Actualizar! ,Intenta Mas tarde'
                  })
              });
      },
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
      remove_carrito_item(id_detalle){
             var size=this.items.length;
              let dat =new FormData();
              if(size==1){
                this.borrarultimoitem(size,dat,id_detalle);
              }else{

              dat.append('id_detalle',id_detalle);
              dat.append('size',size);
              axios.post("removeitem",dat).then(data => {
              
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
      borrarultimoitem(size,dat,id_detalle){

          swal.fire({
            title: 'Quieres Borrar el ultimo elemento del carrito?',
            text: "",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si,borrar',
            cancelButtonText: 'No'
          }).then((result) => {
             if (result.value) {
              dat.append('id_carrito',this.id);
              dat.append('size',size);
              axios.post("removeitem",dat);
              this.removeitemtable(id_detalle);     
              
              this.$nextTick().then(() =>{ 
              
              window.location.href=url;

              });
            }
          })
      },
      removeitemtable(id){

            this.items = this.items.filter(function(dato) {
              if (dato.id_detalle == id) {
                return false;
              } else {
                return true;
              }
            });
            this.paginate(this.perPage, 0);
            this.sumproductos();
      },
      sumproductos(){
        
        // Cambiar esta funcionalidad para que sea mas fluido
        
          let propina = this.$refs.propinar.localValue;
          var subto=0;
          for(var i=0;i<this.items.length;i++){
            
            if(this.items[i].cantidad <= this.items[i].stock){
              subto+=this.items[i].precio*this.items[i].cantidad;
            }
          
          }

          this.total= subto;
          if(propina>0){
            this.total= parseInt(this.total) + parseInt(propina);        
          }
          // this.total+= this.envio;
          // this.total+= this.this.subtotalotal;
          // this.subtotal=this.subtotal;
          
        this.subtotal = this.formatPrice(subto)
        this.auxsubtotal = subto
        
        // console.log(this.subtotal)
        // console.log('to',this.subto)
        
    },
    
    }
  }


</script>

<style>

.static{

    width: 100% !important;
    padding: 10px 25px 10px 25px;
    background: #fff;
    }
.img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 150px;
    text-align: center; 
  }
    .img-wrap img {
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