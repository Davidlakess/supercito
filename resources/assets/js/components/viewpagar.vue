<template>
	<b-container style="padding:15px;font-size: 17px;">
		<span style="margin-bottom: 10px; text-align: center;"><h4>Ingresa una direccion</h4></span>
		<form action="" @submit.prevent="enviardomicilio">
			<b-row>
			  <b-col cols="12" lg="6">
			 		<b-form-group id="fieldset-1"
		      label="Calle" label-for="input-1"
		      description="">
		      <b-form-input id="input-1"  placeholder="ej: pipila" required v-model="direccion.calle" trim></b-form-input>
				</b-form-group>
			  </b-col>
			 	<b-col cols="12" lg="6">
			 		<b-form-group id="fieldset-1"
		      label="N° Exterior" label-for="input-1"
		      description="">
		      <b-form-input id="input-1" placeholder="ej: #13" required v-model="direccion.numero_e" trim></b-form-input>
					</b-form-group>
			  </b-col>
		 		<b-col cols="12" lg="6">
			 		<b-form-group id="fieldset-1"
		      label="Numero interior (opcional)" label-for="input-1"
		      description="">
		      <b-form-input id="input-1" v-model="direccion.numero_i" trim></b-form-input>
					</b-form-group>
			  </b-col>
		 		<b-col cols="12" lg="6">
			 		<b-form-group id="fieldset-1"
		      label="Numero de telefono" label-for="input-1"
		      description="">
		      <b-form-input id="input-1" placeholder=" (44-32-23-22-00)" required v-model="direccion.telefono" trim></b-form-input>
					</b-form-group>
			  </b-col>

			  <b-col cols="12" style="margin-bottom: 15px;">
			 		<span>Entre que calles esta (opcional)?</span>
			  </b-col>
					<b-col cols="12" lg="6" class="mb-lx-10">
					<b-form-input type="search" placeholder="calle 1" v-model="direccion.calle_1"></b-form-input>	
			    </b-col>
			    <b-col cols="12" lg="6">
			    		<b-form-input type="search" placeholder="calle 2" v-model="direccion.calle_2"></b-form-input>	
			    </b-col>
			    <b-col cols="12" style="text-align:center; margin-top: 15px;">
					<b-button variant="primary" type="submit" >Guardar</b-button>		
				</b-col>
			</b-row>
		</form>	
	</b-container>
</template>
<script>
export default {

    data() {
      return {
    	name:"",
    	direccion:{} 
      }
    },

	created() {
    },
    methods: {
		enviardomicilio(){
		// this.$bvToast.toast('Hola mundo soy un toast', {
  //         title:'prueba toast',
  //         variant: 'warning',
  //         solid: true
  //       })

		let formd=new FormData;
			formd.append('data',JSON.stringify(this.direccion));
			axios.post(url+"api/agregardireccion",formd).then(data => {
					if(data.data){
						this.$bvToast.toast('Guardado Correctamente!', {
		          title:'Domicilio',
		          variant: 'success',
		          solid: true
        		})

						eventBus.$emit('adddomicilio',this.direccion);
						eventBus.$emit('issetadress');		
				}
	    			
	    	}).catch(error => {
	    			
	    			this.$bvToast.toast('Error al Guardar!', {
		          title:'Domicilio',
		          variant: 'error',
		          solid: true
        		})
        
	    	});
		
		}
  }
}
</script>