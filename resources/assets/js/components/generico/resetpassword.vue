<template>	
<b-card title="Restablecer Contraseña" class="my-3" >
    
        <b-alert v-if="error!=''" show variant="danger">
          <ul>
            <li>{{error}}</li>
          </ul>
        </b-alert>
        <div v-if="status">
				  <b-alert show variant="success">
				    <h4 class="alert-heading">Correo Enviado</h4>
				    <p>
				    	¡Hemos enviado su enlace de restablecimiento de contraseña por correo electrónico! 
				    </p>
				  </b-alert>
				</div>
      <!--  -->
      <!-- {{ route('pass.reset') }} -->
    <b-form method="POST" @submit.prevent="enviar_link()" action="">
        <b-form-input  
            autofocus 
            required 
            type="email"
            v-model="email"
            placeholder="Ingresa tu correo">
        </b-form-input>
<div style="margin-top: 15px;text-align: end;">   
        <b-button variant="primary" type="submit" :disabled="btn">
            <div v-if="!btn">
                Enviar
            </div>
            <div v-else>
                <b-spinner></b-spinner>
            </div>
        </b-button>     
    </div>
    </b-form>
  </b-card>
</template>
<script type="text/javascript">
	export default {
		// props:[],
		 data() {  	
      return {
    		btn:false,
    		email:'',
    		error:'',
    		status:false
      }
    },

    mounted() {
    
    },
    created() {
        
    },
	methods: { 
		enviar_link(){
					this.btn=true
					axios.post(url+"password/email",{email:this.email}).then(data => {
          		if(data.status==200){
          			this.error=data.data.error
          			this.status=data.data.status
          		}else{
			         	toast.fire({
			          		icon:'error',
			          		title: '¡Hubo un problema al enviar la solicitud!'
		        		})  
          		}
        	this.btn=false
        	}).catch(error => {
          	this.btn=false
	         	toast.fire({
	          		icon:'error',
	          		title: '¡Hubo un problema al enviar la solicitud!'
        		})  
        });

		}
	}
}

</script>