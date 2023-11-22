<template>
  <div>
    <b-form >
      <b-form-group id="input-group-2" label="Nombre:" label-for="input-2">
        <b-form-input
          id="input-2"
          required
          v-model="name"
          placeholder="Nombre Categoria"
        ></b-form-input>
      </b-form-group>
        <b-form-group id="inpute" label="Superior:" label-for="input-2">
          <b-form-select   value-field="id" v-model="selected" :options="options"></b-form-select>
        {{selected}}
        </b-form-group>
    </b-form>
        <b-button  class="mt-3" block @click="guardarcategoria">Guardar</b-button>
  </div>
</template>
<script type="text/javascript">
	export default {
		 data() {  	
      return {
         selected:'',
         options:[

            { text: 'A', id: 'A', disabled: false },
            { text: 'B', id: 'B', disabled: false },
            { text: 'C', id: 'C', disabled: false },
            { text: 'D', id: 'D', disabled: true  },
            { text: 'E', id: 'E', disabled: false },
            { text: 'F', id: 'F', disabled: false }
         
         ],        
      	 name: '',
      }
    },
    mounted() {

    },
    created() {
        
    },
	methods: {
    guardarcategoria(){
      let formd= new FormData()
      formd.append('name',this.name)
      axios.post("api/create/categoria",formd).then(data => {
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



