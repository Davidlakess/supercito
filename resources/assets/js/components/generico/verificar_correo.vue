<template>
	<div> 
	  	<b-button style="background-color: transparent;" @click="enviarcodigoemail()" class="confirm_correo" >Verificar correoo </b-button>
	</div>
</template>
<script type="text/javascript">
  export default {
    props:['to','src','name'],
    	methods: {
		      enviarcodigoemail(){

			    swal.fire({
	                title: 'Se enviara un link de verificacion a tu correo',
	                text: "",
	                confirmButtonColor: '#3085d6',
	                cancelButtonColor: '#d33',
	                type: 'warning',
	                showCancelButton: true,
	                confirmButtonText: 'Aceptar',
	                cancelButtonText: 'Cancelar'
	              }).then((result) => {

	                if (result.value) {
	                	axios.post(url+"api/sendemail").then((data) => { 
	 							
	                			if(data.status==200){
	                				   swal.fire(
					                  '¡Correo enviado! :)',
					                  'Si no te llega intenta de nuevo.',
					                  'success'
					                  )
	                			}else{
	                				   swal.fire(
						                  '¡Ooops!',
						                  'Algo salio mal :(',
						                  'error'
						                  )
	                			}


							}).catch(error => {
				        		   swal.fire(
				                  '¡Ooops!',
				                  'revisa tu conexion y intenta de nuevo :(',
				                  'error'
				                  )
				    		});
	                 }else if(result.dismiss=='cancel') {
	                 	 
	                 
	                 }
	          	})
          		
		}
  }
}
</script>