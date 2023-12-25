<template>
  <div>    
        <b-card no-body class="overflow-hidden">
          <span style="text-align: center;margin-top:15px;font-size: 25px;font-weight: bold;">
        		<p>Tu Carrito de Compras</p>
        	</span>
          <hr>
          <b-card-body>
                  <slot></slot>
                
                <b-alert show dismissible variant="danger">
                  Compra minima de $100.00 pesos
                </b-alert>
            <table style="width: 100%;">
              <tbody>
                 <!-- <b-form-spinbutton id="sb-inline" inline v-model="total" ></b-form-spinbutton>  -->
              
                <div v-for="(item,key) in items" :key="key"> 
                <tr>
                  <td>
                     <figure class="card card-product" style="width: 75px;margin-left: 9px;margin-right: 3px; margin-top: 15px;">
                        <div class="img-wrap"> 
                          <img :src="ruta + '/uploads/'+item.img">
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
                         <b-form-spinbutton id="sb-inline" inline 
                         :ref="'cant'+key" :value="item.cantidad" @change="disable=false;"></b-form-spinbutton>   
                      
                        <button  @click="addcantidad(item.id_detalle,key)"
                         class="btn btn-sm btn-primary"
                         :disabled="disable"
                          style="margin-left: 11px;"><i class="fa fa-undo i-carrito"></i></button> 

                        <button @click="remove_carrito_item(item.id_detalle)" class="btn btn-sm btn-danger" style="margin-left:4px;"><i class="fa fa-trash i-carrito"></i></button> 
                      </div>
                  </td>    
                </tr>
                </div>
              </tbody>
            </table>
             
          
          </b-card-body>

        </b-card>
                      
        <b-card no-body id="detalle" class="static" style="margin-bottom: 0;">
              <div>
                <div style="font-size: 18px;font-weight: 400;display: grid; margin-bottom: 15px;">
                  <span>Subtotal: $ {{formatPrice(subtotal)}}</span>
                 <div style="display: inline;margin-bottom: 10px;margin-top: 10px;">
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
              <div>
            <form method="get"  action="checkout/pagarview">
                  <input type="hidden" name="tip" v-model.lazy="propina">
                  <input type="hidden" name="id" v-model="id">
                  <!-- <input type="hidden" name="_token" v-model="token"> -->
                <b-button variant="outline-primary btn-block" type="submit">Comprar Carrito</b-button>
          </form>
                <b-button variant="outline-success btn-block">Seguir Comprando</b-button>  
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
          propina:5,
          total:0,
          ruta: url,
          id:this.data[0].id_carrito,
          cantidades:1,
          items:[],
          token:'',
          subtotal:0,
          disable:true
      }
    },
    mounted() {
      this.getproductos();
      this.sumproductos()
//       window.onscroll = function() {myFunctio()};
//       var header = document.getElementById("detalle");

// // Get the offset position of the navbar
//       var sticky =  header.offsetHeight;

//       function myFunctio(){

//         console.log('sticky',sticky);
//         console.log('offset',window.pageYOffset);
    

//         if (window.pageYOffset > sticky ) {
//           // console.log(true)
//           header.classList.add("sticky");
//         } else {
//           header.classList.remove("sticky");
//         // console.log(false)
//         }
// 
//       }
 },
    methods: {
      checkout(){

                let token = document.head.querySelector('meta[name="csrf-token"]');

                this.token=token.content;
                      
                Vue.nextTick().then(() =>{ 
                    this.$refs.checkout.submit();
                })     
      },
      sumarpropina(){

            var cant = this.$refs.propinar.localValue;

            this.total=parseFloat(this.subtotal) + parseFloat(cant);
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
              
              var cant = data.data.cant;
              if(data.data.status){
                  this.items[index].cantidad=parseInt(cant);

                  // console.log(this.items)
                
                  
                  Vue.nextTick().then(() =>{ 

                    toast.fire({
                      icon:'success',
                      title: '¡Cantidad Actualizada!'
                    })
                    // this.disable=true;
                    this.sumproductos();
                });

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
                  
                  this.$bvToast.toast('Error al Actualizar!', {
                    title:'Intenta Mas tarde',
                    variant: 'error',
                    solid: true
                  })
              
              });
      },
      removeitemcarrito(id_detalle){
          let cat =this.$refs['cant'+index][0].localValue;
          let dat =new FormData();
          dat.append('id_detalle',id_detalle);
          dat.append('cantidad',cant);
          axios.post("putcantidadproducto",dat);
      },
      formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
      getproductos(){
        this.items=this.data;
      },
      remove_carrito_item(id_detalle){
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
              axios.post("api/removeitem",dat);
              this.removeitemtable(id_detalle);     
              
              Vue.nextTick().then(() =>{ 
              
              window.location.href=url+'carrito';

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
            this.sumproductos();
      },
      sumproductos(){
        
        // Cambiar esta funcionalidad para que sea mas fluido
        
          let propina = this.$refs.propinar.localValue;
          var subto=0;
          for(var i=0;i<this.items.length;i++){
            
            subto+=this.items[i].precio*this.items[i].cantidad;
          
          }

          this.total= subto;
          if(propina>0){
            this.total= parseFloat(this.total) + parseFloat(propina);        
          }
          // this.total+= this.envio;
          // this.total+= this.this.subtotalotal;
          // this.subtotal=this.subtotal;
          
        this.subtotal=subto;
        // console.log(this.subtotal)
        // console.log('to',this.subto)
        
    },
    
    }
  }


</script>

<style>
.static{

    /*position:absolute;*/
    width: 100% !important;
    padding: 10px;
    background: #fff;
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
.sticky {
  position: fixed;
  bottom: 0;
  width: 100%;
  padding: 10px;
  background: #fff;
}
.sticky + .content {
  padding-top: 102px;
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