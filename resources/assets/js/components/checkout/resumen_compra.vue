<template>
	<div>
		
	<b-card no-body class="text-justify static" id="resumencontent" 
				  style="background-color: #f5f5f5;" > 

		<b-container style="margin-top: 20px; padding-top: 45px">
			<span style="margin-bottom: 20px; font-weight: 600;"> Resumen de compra</span>
		    <hr>
			<b-row>
			  <b-col cols="7" lg="6" class="mb-10">
        	<span>Productos ({{countproductos}})</span>
			  </b-col>
			  <b-col cols="5 tl-end" lg="6">
			  	<span>$ {{formatPrice(totalproductos)}}</span>
			  </b-col>
			  <b-col cols="6" class="mb-10">
			  	<span>Envio</span>
			  </b-col>
			  <b-col cols="6 tl-end" >
			  	<span>$ {{formatPrice(envio)}}</span>
			  </b-col>
			  <b-col cols="6" class="mb-10">
			  	<span>Propina</span>
			  </b-col>
			  <b-col cols="6 tl-end" >
			  	<span>$ {{formatPrice(propina)}} </span>
			  </b-col>
			  <b-col cols="6" class="mb-10 mt-22">
			  	<span>Total</span>
			  </b-col>
			  <b-col cols="6 tl-end mt-22" >
			  	<span>$ {{formatPrice(totalventa)}}</span>
			  </b-col>
			</b-row>
		</b-container>
	</b-card>
       


</div>
</template>
<script type="text/javascript">
	export default {

		props:['propina','items','precioenvio','idcarrito'],
    data() {
      return {
        domicilioset:0,
      	productos:[],
        id_carrito:this.idcarrito,
        totalproductos:0,
        countproductos:0,
        totalventa:0,
        envio:0,
        spinner:true,
      }
    },
    mounted() {
  
      this.envio=this.precioenvio;
      this.getresumen();
    },
    created() {

         eventBus.$on('setenvio', (envio) => {
          
          this.domicilioset=1;
          this.envio=envio; 
          this.totalventa+=this.envio;    
        
        });

        this.finalizarpedido();
    },
    methods: {
    finalizarpedido(){
    	eventBus.$on('finpedido', () => {
        	this.hacer_pedido()
      })
    },	
    hacer_pedido(){
        // alert('holi');
    	   swal.fire({
                title: '¡estas a punto de enviar tu pedido!',
                text: "",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hacer pedido',
                cancelButtonText: 'cancelar'
              }).then((result) => {

                if (result.value) {
                   // this.recogercambio();
                 	 this.enviar_pedido(0);
                 }else if(result.dismiss=='cancel') {   
                 }
          	})
	},enviar_pedido(cambio){

    eventBus.$emit('btn-disable'); 
    let formd=new FormData;
        formd.append('tip',this.propina);
        formd.append('id_carrito',this.id_carrito);
        // formd.append('exchange',cambio);
        
            axios.post(url+"orden.venta",formd).then((data) => {
              if(data.status== 200){
   
                   swal.fire(
                      '¡Pedido Enviado!',
                      'Te enviamos el detalle a tu correo ¡Gracias!',
                      'success'
                      ).then(() =>{ 
                          window.location.href=url+'miscompras'; 
                      })
              }else{
                swal.fire(
                  '¡Ooops!',
                  'Algo salio mal :(',
                  'error'
                  )
              }
              
            }).catch(error => {

                eventBus.$emit('btn-disable'); 
                 swal.fire(
                  '¡Error al Enviar!',
                  'Intenta nuevamente :(',
                  'error'
                  )   
            });
      },
      async recogercambio(){
        var total=parseFloat(this.totalventa);

          const {value: mont} = await swal.fire({
            title:'Calcular cambio ',
            input: 'number',
            inputAttributes: {
              min:total,
              max:total*2
          },
            target:'.mn',
            inputValue:'',
            inputPlaceholder: 'Pagas con ?',
            inputValidator: (value) => {
              
              value=parseFloat(value);
              
              if (total>=value) {

                return 'Introduce una catidad mayor a '+total
              
              }
            }
          });
          if (mont){    
            this.enviar_pedido(mont-total);
          }    
      
  },
	
    formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
      getresumen(){
      	var size=this.items.length;
       	this.countproductos=size;
       	for(var i=0;i<size;i++ ){
       		
       		this.totalproductos+=parseFloat(this.items[i].precio)* parseFloat(this.items[i].cantidad);
    		
    		}

    	let aux= parseFloat(this.envio) + parseFloat(this.propina);
    	this.totalventa=parseFloat(aux) + parseFloat(this.totalproductos);
    }
	}
}
</script>


