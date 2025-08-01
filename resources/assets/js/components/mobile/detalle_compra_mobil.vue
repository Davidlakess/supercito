<template>
    <!-- style="margin-bottom: 30%;" -->
			<b-card >
				<div style="font-size: 23px; text-align: center;font-weight: 600;">Detallado de Pedido</div>
				<b-col cols="12" style="margin-top: 10px;">
					<div style="display: flex;flex-direction: column;text-align: center;font-size: 16px;">
			      		<span>Fecha de pedido:</span> 
			      		<span style="font-weight: bold;">{{getfecha()}}</span>
			    </div>
			  		<time-line :mobil="true" :status="status" v-if="status!=4"></time-line>
			        <div class="divcancel" v-if="status==4">
                <span class="cancel">Pedido Cancelado</span>
              </div>
			        
			        <div style="text-align: end;margin: 10px;">
			          <b-button v-if="status==1" @click="cancelar_pedido()" variant="outline-danger">
			                    Cancelar Pedido
			          </b-button>  
			        </div>
			    </b-col>

            <div v-for="item in items" class="espacio-top">
              <b-col cols="12" >
                <b-row>
                    <b-col cols="6" >

                       <b-badge v-if="item.status==1" pill  variant="warning" class="f14">Pendiente</b-badge>
            <b-badge v-if="item.status==2" pill variant="info"  class="f14">Enviado</b-badge>
            <b-badge v-if="item.status==3" pill variant="success" class="f14">Entregado</b-badge>
            <b-badge v-if="item.status==4" pill variant="danger" class="f14">Cancelado</b-badge>
                    </b-col>

                    <b-col cols="6" style="text-align: end;padding-right: 0;">
                       <b-button v-if="item.status==2" size="sm" variant="outline-primary" :href="ruta+'item/'+item.ids+'-'+item.descripcion">
                        Volver a Comprar
                      </b-button>
                    </b-col>
                </b-row>
              </b-col>

                <b-row >
                  <b-col cols="12" style="text-align: center;" >
                     <img width="90" height="90" :src="ruta + '/uploads/'+item.img" alt="">
                  </b-col>
                  <b-col cols="12" lg="5">
                    <div style="margin-bottom: 10px;text-align: center;width: 100%;">
                    <b-col cols="12">{{item.descripcion}}</b-col>
                    <b-col cols="12">   Cantidad: #{{item.cantidad}}</b-col>
                    <b-col cols="12" style="font-weight: 600;font-size: 20;">  $ {{item.precio}}</b-col>
                    <!-- <b-col cols="12"> Color NEGROS, Voltaje 110 </b-col> -->
                    </div>
                  </b-col>
                  <b-col cols="12" lg="5">
                  <div style=" height: 100%;display: inline-grid;">
                      <b-col cols="12"><strong>Vendedor</strong></b-col>
                      <b-col cols="12">{{item.name}}</b-col>
                      <b-col cols="12" >{{item.telefono}}</b-col>
                  </div>
                </b-col>
              </b-row>
            </b-col>  
          </div>

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
</template>
<script>

  import timeline from '../generico/timeline.vue'
  export default {
  	
    components:{
       'time-line':timeline
    }, 
  	props:['items','venta'],
    data() {
      return {
      	status:1,
        ruta: url,
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
      // console.log(this.venta)
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
          total+= parseInt(envio) + parseInt(propina)                            
           this.detalle.envio=envio
           this.detalle.propina=propina
           this.detalle.subtotal=subto
           this.detalle.total= total
    	},
    	cancelar_pedido () {
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
                        '¡Venta cancelada!',
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
        return  moment(this.venta.fecha).format('dddd LL');
      },
      formatPrice(value) {
        return window.formatPrice(value)
      },
  }
}
</script>

<style type="text/css">
	.detalle-info{
		text-align: end;
		font-size: 20px;
		font-weight: 300;
		text-transform: capitalize;
    font-family: arial;
	}
	.detalle-total{
		text-align: end;
		font-size: 21px;
		text-transform: capitalize;
		font-weight: 600;
	}
  .f14{
  font-size: 14px;
  }
  .cancel{
    background-color: red;
color: white;
padding: 10px;
border-radius: 37px;
font-weight: bold;
  }
  .divcancel{
    margin-bottom: 12px;
margin-top: 12px;
text-align: center;
  }
.espacio-top{
  border-top: 1px solid rgb(216, 208, 208);
  padding: 13px;
}

</style>