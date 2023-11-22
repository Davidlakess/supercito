<template>
	<b-row align-h="center">
	  	<b-col cols="10" style="font-size: 27px;text-align: left;font-weight: 600;margin-bottom:5px; margin-top: 30px;">
				<div style="font-size: 27px; text-align: left;">Detallado de Pedido</div>
		</b-col>
		<b-col cols="10" style="margin-top: 15px;">
			<b-card style="margin-bottom: 25px;">
				<b-col cols="12" style="margin-top: 10px;">
					<div>
			      		<span>Fecha de pedido:</span> 
			      		<span style="font-weight: bold;">{{getfecha()}}</span>
			      	</div>
			  		<time-line :mobil="false" :status="status" v-if="status!=4"></time-line>

			        <div class="divcancel" v-if="status==4"><span class="cancel">Pedido Cancelado</span></div>
			        
			        <div style="text-align: end;margin: 10px;">
			          <b-button v-if="status==1" @click="cancelar_pedido()" variant="outline-danger">
			                    Cancelar Pedido
			          </b-button>  
			        </div>
			    </b-col>
				<template v-for="item in items">
					<b-col cols="12" style="margin: 10px;
border-top: 2px solid #eeee;">
						<items-detalle-compra
						:vendedor="item.name"
						:cantidad="item.cantidad"
						:descripcion="item.descripcion"
						:precio="item.precio"
						:img="item.img"
						:telefono="item.telefono"
						:statuspro="item.status"
						:id="item.ids"
						></items-detalle-compra>
					</b-col>	
				</template>
				<b-col cols="12" class="detalle-info" style="margin-top: 18px;border-top: 2px solid #eeee; ">
				<span>subtotal:</span>
				<span>${{formatPrice(detalle.subtotal)}}</span>
				</b-col>
				<b-col cols="12" class="detalle-info">
				<span>propina:</span>
				<span>$ {{formatPrice(detalle.propina)}}</span>
				</b-col>
				<b-col cols="12" class="detalle-info">
				<span>envio:</span>
				<span>$ {{formatPrice(detalle.envio)}}</span>
				</b-col>
				<b-col cols="12" class="detalle-total">
				<span>Total:</span>
				<span>$ {{formatPrice(detalle.total)}}</span>
				</b-col>
			</b-card>
		</b-col>
	</b-row>
</template>
<script>

  import timeline from '../generico/timeline.vue'
  import detalle_compra from '../compras/item_detalle_compra.vue'
  export default {
  	
    components: {
       'time-line':timeline,
       'items-detalle-compra':detalle_compra
    }, 
  	props:['items','venta'],
    data() {
      return {
      	status:1,
      	detalle:{
      	   envio:0,
           propina:0,
           subtotal:0,
           total:0
      	}
      }
    },
    created(){

    	this.status=this.venta.statusventa;
    },
    mounted(){
    	 this.$nextTick(() => {
      		this.sumarproductos();
    	});
    },
    methods: {
    	sumarproductos(){
    	
          const propina = this.venta.propina;
          const envio =this.venta.envio;

          var subto=0;
          for(var i=0;i<this.items.length;i++){
            
            subto+=this.items[i].precio*this.items[i].cantidad;
          
          }

          var total= subto;
          
          total+= parseInt(envio) + parseInt(propina);        
                     
           this.detalle.envio=envio;
           this.detalle.propina=propina;
           this.detalle.subtotal=subto;
           this.detalle.total= total;

    	},
    	cancelar_pedido(){


        swal.fire({
                title: '¡tu pedido casi esta listo!',
                text: "¿Quieres cancelarlo ? :( ",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'continuar',
                cancelButtonText: 'cancelar pedido'
              }).then((result) => {

                if (result.value) {

                     swal.fire(
                        '¡Tu pedido estara pronto contigo!',
                        ':)',
                        'success'
                        )
                 }else if(result.dismiss=='cancel') {
                      
                     swal.fire(
                        '¡Pedido cancelado!',
                        ':(',
                        'error'
                        )
                     // .then(() =>{ 
                     //      window.location.href=url+'miscompras'; 
                     //  });

                 }
            })
        
      },
      getfecha(){

        moment.locale('es');
        return  moment(this.fecha).format('dddd LL');
      },
      formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
  }
}
</script>

<style type="text/css">
	.detalle-info{
		text-align: end;
		font-size: 30px;
		font-weight: 300;
		text-transform: capitalize;
	}
	.detalle-total{
		text-align: end;
		font-size: 30px;
		text-transform: capitalize;
		font-weight: 600;
	}
</style>