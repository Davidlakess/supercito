<template>
	<div>
		
	<b-card no-body class="text-justify static" id="resumencontent" 
				  style="background-color: #f5f5f5; z-index: -1;" > 
		<b-container style="margin-top: 20px; padding-top: 45px;padding-right: 30px;padding-left: 30px;">
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
	 	<b-row style="margin-top: 20px;margin-top: 4% !important;" class="d-lg-none">
					<b-col cols="12" style="text-align: end;">
						<b-button variant="primary" size="lg" class="btn-pagar-sm" @click="hacer_pedido">Continuar</b-button>		
					</b-col>
		</b-row>	
</div>
</template>
<script type="text/javascript">
	export default {

		props:['propina','items','issetdomicilio']
		,data() {
      return {
      	productos:[],
        id_carrito:0,
        totalproductos:0,
        countproductos:0,
        totalventa:0,
        envio:13,
      }
    },
    mounted() {
      this.getresumen();
    },
    created() {
        eventBus.$on('issetadress', () => {
          this.issetdomicilio=1;
        })
        this.finalizarpedido();
    },
    methods: {
    finalizarpedido(){
    	eventBus.$on('finpedido', () => {
        	this.hacer_pedido();	
      })
    },	
    hacer_pedido(){
      if(this.issetdomicilio==1){
        // alert('holi');
    	   swal.fire({
                title: 'Quieres que te mandemos tu cambio?',
                text: "",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si,porfavor',
                cancelButtonText: 'No,pago exacto'
              }).then((result) => {

                if (result.value) {

                   this.recogercambio();

                 }else if(result.dismiss=='cancel') {
                 	 
                 	this.getproductoscarrito(0);
                 }
          	})
          }else{

             swal.fire(
                '¡Error!',
                'Agrega un domicilio de Envio!',
                'error'
                )

          }
	},
    async recogercambio(){
    		var total=parseFloat(this.totalventa);

        	const {value: mont} = await swal.fire({
            title:'Calcular cambio ',
            input: 'number',
            inputAttributes: {
            	min:total
  				},
            target:'.mn',
            inputValue:'',
            inputPlaceholder: 'Pagas con ?',
            inputValidator: (value) => {
            	value=parseFloat(value);
              if (total>=value) {
                return 'Introduce una catidad mayor a '+total
              
              }

               if( total < 100 && value < 200 ){

                   return 'solo se acepta cambio para'+200
              }
            }
          });
          if (mont){    
          	this.getproductoscarrito(mont-total);
          }    
      
	},
	getproductoscarrito(cambio){
		// console.log(this.items)
		for(var i=0;i<this.items.length;i++){
			
			this.productos[i]={
        id_producto:this.items[i].id_producto,
				descripcion:this.items[i].name,
				precio:this.items[i].precio,
				cantidad:this.items[i].cantidad,
        id_usuario:this.items[i].id_usuario,
        img:this.items[i].img
			}
		}
		
		this.id_carrito=this.items[0].id_carrito;
		let formd=new FormData;
        formd.append('data',JSON.stringify(this.productos)); 
    		formd.append('tip',this.propina);
    		formd.append('id_carrito',this.id_carrito);
    		formd.append('cambio',cambio);
		
		axios.post(url+"api/agregaventa",formd).then(data => {
             
             console.log(data)
          //  if(){
          //      swal.fire(
          //       '¡Pedido Enviado!',
          //       '¡Gracias!',
          //       'success'
          //       )  
          //   setTimeout(function(){ 
          //      window.location.href=url+data.data.ruta;
          //   }, 2200);
          //       Vue.nextTick().then(() =>{ 
          //   })     
          // }
 
		}).catch(error => {
               swal.fire(
                '¡Error al Enviar!',
                'Intenta nuevamente :(',
                'error'
                )   

    });


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