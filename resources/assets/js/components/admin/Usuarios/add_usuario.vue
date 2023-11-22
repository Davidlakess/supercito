<template>
<div>
    <b-form >
      <b-form-group id="input-group-2" label="Nombre:" label-for="input-2">
        <b-form-input
          id="input-2"
          required
          v-model="usuario.name"
          placeholder="Nombre"
        ></b-form-input>
      </b-form-group>


      <b-form-group
        id="input-group-1"
        label="Email:"
        label-for="input-1">

        <b-form-input
          id="input-1"
          type="email"
          required
          v-model="usuario.email"
          placeholder="Correo Electronico"
        ></b-form-input>
      </b-form-group>

		
      <b-form-group
        label="Conraseña"
        label-for="in"
      >
        <b-form-input type="password"
          id="in"
          v-model="usuario.pass"
          required
        ></b-form-input>
      </b-form-group>
	  

      <b-form-group id="input-group-3" label="Rol:" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="usuario.rol"
          :options="roles"
          required
        ></b-form-select>
      </b-form-group>
    </b-form>
    <b-button variant="primary" class="mt-3" block @click="addusuario" >Guardar</b-button>
  </div>
</template>
<script type="text/javascript">
	export default {
		 data() {  	
      return {
      usuario:{rol:'',pass:'',email:'',name:''},
    	categorias:[],
    	 roles: [
       { text: 'Seleccionar rol',value:null},
       { text: 'Repartidor', value:2},
       { text:'Usuario', value:1}]
    }
   },
    mounted() {

    },
    created() {
        
    },
	methods: {
	    addusuario(){
       console.log(this.usuario);

        let formd= new FormData()
        formd.append('usuario',JSON.stringify(this.usuario))
        axios.post("api/create/usuario",formd).then(data => {
            alert('se creo la categoria')  
            // cerrar modal
            this.$bvModal.hide('modal-1')
        }).catch(error => {
               console.log(error);  
        });
      }
		}
	}

</script>



