<template>	

	<autocomplete
	    :search="search"
	    placeholder="Buscar en Supercito "
	    @submit="handleSubmit"
	    v-on:keyup.enter="handleSubmit({name: value})"
	    :get-result-value="getResultValue"
  ></autocomplete>
 
</template>
<script>

export default {
		data(){
			return {
				busqueda:[],
				value:"",
				ruta:url,
				drawer: null
				// mdruta:"/middlecarrito",
			}
		},
	methods:{
	    async search(input) {
	    this.value=input;
	      if (input.length < 1) {
	    	return [] 
	      }else{

	      	let res= await axios.get(this.ruta+"api/buscar/"+input);
	      	return (res.data)?res.data:[];
	      	// console.log(res.data);
	      }
	      	// console.log(.data);
	        // return this.busqueda;
	    },
	    hacerbusqueda() {
	    	
			Vue.nextTick(() =>{
		      	let val=this.value.split(" ").join("+");
		    	window.location.href=this.ruta+'search/'+val;
	        });
	    },
	    handleSubmit(result) {
	    	if(result){
	      		let val=result.name.split(" ").join("+");
	      		window.location.href=this.ruta+'search/'+val;
	    	}else{
	    		this.hacerbusqueda();
	    	}
	    },
	    getResultValue(result) {
	      return result.name
	    },
	   //   search(input) {
    //   return new Promise(resolve => {
    //     const this.ruta = `${wikithis.ruta}/w/api.php?${wikiParams}&srsearch=${encodeURI(
    //       input
    //     )}`

    //     if (input.length < 3) {
    //       return resolve([])
    //     }

    //     fetch(this.ruta)
    //       .then(response => response.json())
    //       .then(data => {
    //         resolve(data.query.search)
    //       })
    //   })
    // },
	}
}
</script>

