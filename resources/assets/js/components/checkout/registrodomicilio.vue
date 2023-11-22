<template>
	<b-container style="padding:15px;font-size: 17px; cursor: auto;">
		<span style="margin-bottom: 10px; text-align: center;"><h4>Ingresa una direccion</h4></span>
		 <p v-if="errors.length">
                      <b>Por favor corriga los siguientes error(es):</b>
                      <ul>
                          <b-alert 
                          show variant="danger"  
                          :value="error.alert"
                      	  v-for="(error,key) in errors" :key="key">{{ error.value }}</b-alert>
                      </ul>
          </p>   
		<form action="" @submit.prevent="ubicacionverifi">
			<b-row>
   <b-col cols="12" >
   	 		<b-form-group id="fieldset-1"
		      label="Localidad" label-for="input-1"
		      description="">
			    	<b-form-select v-model="direccion.id_localidad" class="mb-3">
					    <b-form-select-option :value="null">selecciona tu localidad</b-form-select-option>

					    <b-form-select-option 
					    v-for="(loc,key) in locations" 
					    :value="loc.id_localidad"
					    :key="key"
					  >{{loc.name}}</b-form-select-option>
  					</b-form-select>
			</b-form-group>
			    </b-col>


			  <b-col cols="12" lg="4">
			 <b-form-group id="fieldset-1"
		      label="Calle" label-for="input-1"
		      description="">
		      <b-form-input id="input-1"  placeholder="ej: pipila" required v-model="direccion.calle" trim></b-form-input>
				</b-form-group>
			  </b-col>

			 	<b-col cols="12" lg="4">
				 	<b-form-group id="fieldset-1"
				      label="Numero Exterior" label-for="input-1"
				      description="">
			      		<b-form-input id="input-1" 
                        	v-on:keypress="soloNumeros" placeholder="ej: #13" required v-model="direccion.numero_e" trim>
                        </b-form-input>
					</b-form-group>
			  	</b-col>
		 		<b-col cols="12" lg="4">
			 		<b-form-group id="fieldset-1"
				      label="Numero interior" label-for="input-1"
				      description="">
		      		<b-form-input id="input-1" v-model="direccion.numero_i" 
                        v-on:keypress="soloNumeros" trim></b-form-input>
					</b-form-group>
			  	</b-col>
		 		<!-- <b-col cols="12" lg="6">
			 		<b-form-group id="fieldset-1"
				      label="Numero de telefono" label-for="input-1"
				      description="">      	<b-form-input 
                        v-on:keypress="soloNumeros" id="input-1" placeholder=" (44-32-23-22-00)" required v-model="direccion.telefono" maxlength="10" trim></b-form-input>
					</b-form-group>
			  </b-col> -->

			  	<b-col cols="12" style="margin-bottom: 15px;">
			 		<span>¿ Entre que calles esta ? (opcional)</span>
			  	</b-col>
				<b-col cols="12" lg="6">
					<b-form-input type="text" autocomplete="off" placeholder="calle 1" v-model="direccion.calle_1"></b-form-input>	
			    </b-col>
			    <b-col cols="12" lg="6" :class="(mt)?'mt-3':''" >
			    		<b-form-input autocomplete="off" type="text" placeholder="calle 2" v-model="direccion.calle_2"></b-form-input>	
			    </b-col>
			    <b-col cols="12"   style="text-align:center; margin-top: 15px;">
					<b-button v-if="mt" v-b-modal.modal-1  variant="primary" type="submit" >Guardar</b-button>
					<b-button v-else variant="primary" type="submit" >Guardar</b-button>		
				</b-col>
			</b-row>
		</form>	
	</b-container>
</template>
<script>
export default {
	props:['mt'],
    data() {
      return {
    	name:"",
    	locations:[],
    	errors:[],
      	ubicacion:false,
    	direccion:{
	    	calle: '',
			calle_1: '',
			calle_2: '',
			id_localidad:null,
			numero_e:'',
			numero_i:''
	    } 
   }
 },

	created() {

		this.getlocalidades();
		this.direccion.id_localidad=null;  
    	// console.log(this.$parent);
    },

    methods: {
    validarform(){
      this.errors=[];
      if (!this.direccion.calle) {
        this.errors.push({value:'La calle es requerida'});
      }
      if (!this.direccion.id_localidad) {
        this.errors.push({value:'Selecciona tu localidad'});
      }

      if (!this.direccion.numero_e) {
        this.errors.push({value:'El numero exterior es requerido'});
      }
    },
    	getlocalidades(){

				axios.post(url+"api/getlocalidades").then((data) => { 
		 			
					this.locations=data.data;

				}).catch(error => {
		        	
		    });
    	},
    	soloNumeros(evt){

	      evt = (evt) ? evt : window.event;
	      var charCode = (evt.which) ? evt.which : evt.keyCode;
	      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
	        evt.preventDefault();;
	      } else {
	        return true;
	      }
  		},
  		ubicacionverifi(){
  			
  			this.validarform();
		
			if(this.errors.length==0){

	  			if ("geolocation" in navigator){ 
	        	    navigator.geolocation.getCurrentPosition((position) => { 

			        	   this.ubicacion=true;
			        	   const lat = position.coords.latitude
			        	   const long = position.coords.longitude
			        	   this.enviardomicilio(lat,long);
			        });

			    }else{

			    	alert('no se puede obtener tu ubicacion intenta nuevamente con otro navegador')
			    	this.ubicacion=true;
			    }
			}
  		},
		enviardomicilio(latitud,longitud){
		
			if(this.ubicacion){

					let formd=new FormData;
						formd.append('data',JSON.stringify(this.direccion));
						formd.append('long',longitud);
						formd.append('lat',latitud);
						axios.post(url+"api/agregardireccion",formd).then(data => {
							// console.log(data);
							if(data.status==200){
								this.$bvToast.toast('Guardado Correctamente!', {
						          title:'Domicilio',
						          variant: 'success',
						          solid: true
				        		})
				        			var adress=this.direccion;
				        			adress.name=data.data.name;
				        			// adress.name='alvaro obregon';


									eventBus.$emit('setenvio',data.data.envio);	
									// eventBus.$emit('setenvio',13);	
									eventBus.$emit('adddomicilio',adress);
									// console.log(data.data);
							}else{
								
								this.$bvToast.toast('Opps!', {
						          title:'hubo un error al guardar!',
						          variant: 'error',
						          solid: true
				        		})
							
							}
				    			
				    	}).catch(error => {
				    			
				    			this.$bvToast.toast('Error al Guardar!', {
					          title:'Domicilio',
					          variant: 'error',
					          solid: true
			        		})
			        
				    	});
				}else{

				
				  this.$bvToast.toast('¡Por favor Acepte compartir su ubicacion!', {
			          title:'Error',
			          variant: 'danger',
			          solid: true
	        		})
				}
		}
  }
}
</script>