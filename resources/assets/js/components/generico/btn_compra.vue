<template>
  <div >

  <b-button 
    variant="outline-primary" 
    @click="hacer_pedido">
    Finalizar
  </b-button>

</div>
</template>
<script>
  export default {
    props:['id_carrito','propina'],
    
    data(){
      return{

      }
    },
    mounted() {
    
    },
    methods: {
      hacer_pedido(){
      if(this.domicilioset==1){
        // alert('holi');
         swal.fire({
                title: 'Necesitas cambio?',
                text: "",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si,Porfavor',
                cancelButtonText: 'No,Pago Exacto.'
              }).then((result) => {

                if (result.value) {

                   this.recogercambio();

                 }else if(result.dismiss=='cancel') {
                   
                  this.enviar_pedido(0);
                 }
            })
          }else{

             swal.fire(
                '¡Agrega el Domicilio de Envio!',
                '',
                'info'
                )

          }
  },
      enviar_pedido(cambio){

    let formd=new FormData;
        formd.append('tip',this.propina);
        formd.append('id_carrito',this.id_carrito);
        formd.append('exchange',cambio);
        
            axios.post(url+"orden.venta",formd).then(() => {
               swal.fire(
                '¡Pedido Enviado!',
                '¡Gracias!',
                'success'
                ).then(() =>{ 
                    window.location.href=url+'miscompras'; 
                })
            }).catch(error => {
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
    }
  }
</script>