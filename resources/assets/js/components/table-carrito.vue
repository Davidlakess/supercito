<template>
<div style="cursor: auto;">
	<span style="text-align: center;font-size: 25px;font-weight: bold;">
		<p>Tu Carrito de Compras</p>
	</span>
	<div class="table-responsive" >
    <table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col" v-for="head in headers" :class="head.clase">{{head.text}}</th>		      
		      <!-- <th scope="col" class="text-center">Cantidad</th>
		      <th scope="col" class="text-right">Precio</th> -->
		    </tr>
		  </thead>
		  <tbody>
        
        <tr v-for="item in items">
		    <td>
          <figure class="card card-product" style="width: 100px;">
            <div class="img-wrap"> 
              <img :src="'/uploads/'+item.img">
            </div>
          </figure>
          </td>
		      <td style="vertical-align: middle;font-size: 18px; font-weight: 600; font-size: 18px;">{{item.producto}}</td>
		      <td style="vertical-align: middle;">
			      <div style="display: flex;flex-direction: column;align-items: center;">
			      	<input style="width:150px;" min="1" @change="addcantidad(item.id_detalle,item.cantidad)" v-model="item.cantidad" class="text-center form-control" type="number"/>
			      </div>
		      </td>
		      <td class="text-center" style="vertical-align: middle; font-size: 28px;font-weight: 400; ">$ {{item.precio}}</td>
		      <td class="text-right" style="vertical-align: middle;">
		      	<button class="btn btn-sm btn-danger" @click="remove_carrito_item(item.id_detalle)" ><i class="fa fa-trash"></i></button> 
		      </td>
			  </tr>
	      <tr>
	        <td></td>
	        <td></td>
	        <td></td>
	        <td style="font-size: 20px;"><strong>subtotal</strong></td>
	        <td class="text-right" style="font-size: 20px;"><strong>${{sumproductos()}}</strong></td>
	      </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td style="font-size: 20px;"><strong>ENVIO</strong></td>
          <td class="text-right" style="font-size: 20px;"><strong>${{(envio>=499)?'GRATIS':envio}}</strong></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td style="font-size: 20px;"><strong>Propina</strong></td>
          <td class="text-right" style="font-size: 20px; display: flex; flex-direction: row-reverse;"><input style="width:150px;" min="0" v-model.lazy="propina" class="text-center form-control" type="number"/></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td style="font-size: 30px; font-weight: 400;">Total</td>
          <td class="text-right" style="font-size: 30px; font-weight: 400;">${{total}}</td>
        </tr>
	    </tbody>
	  </table>
	</div>
  
	<div class="col mb-2">
	  <div class="row">
	      <div class="col-sm-12  col-md-6">
          <b-button pill variant="outline-secondary"  block>Continuar Comprando</b-button>
        </div>
      <div class="col-sm-12 col-md-6 text-right">
        <form action="checkout/pagarview">
          <input type="hidden" name="tip" v-model.lazy="propina">
          <input type="hidden" name="id" v-model="id">
       <b-button pill variant="outline-success" type="submit" block>Continuar
       </b-button>
        </form>
      </div>
    </div>   
  </div>
  
  </div>
</template>
<script>
  export default {
    props:[
    'data'
    ],
    data(){
      return {
          envio:13,
          propina:5,
          total:0,
          id:this.data[0].id_carrito,
      	 headers: [
          {
            text: "",
            clase:""
          },
          {
            text: "Producto",
            clase:""
          },
          {
            text: "Cantidad",
         		clase:"text-center"
          },
          {
            text: "Precio",
            clase:"text-center"
          },
          {
            text: "",
            clase:""
          },
         
        ],
        items:[]
      }
    },
    mounted() {this.getproductos();},
    methods: {
      
      removeitemcarrito($id_detalle){
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
        var subtotal=0;
        for(var i=0;i<this.items.length;i++){
          subtotal+=this.items[i].precio*this.items[i].cantidad;
        }

        this.total= this.envio+subtotal;
        
        if(this.propina>0){
          this.total= parseInt(this.total) + parseInt(this.propina);        
        }
        // this.total+= this.envio;
        // this.total+= this.subtotal;
        return this.formatPrice(subtotal);
    },
    
    }
  }
</script>
<style>
body{
  font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
  cursor: auto;
}
@media only screen and (min-width: 1265px) {
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
    height: 100px;
    text-align: center; }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; }

}


@media only screen and (max-width: 1264px) {
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
    height: 100px;
    text-align: center; 
  }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100px;
      object-fit: cover;

    }

}   
      

</style>
