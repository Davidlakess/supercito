<template>
		<a :href="formaturl()">
			<v-img  
		:src="ruta+'uploads/'+this.src"
		aspect-ratio="1"
		class="grey lighten-2"
		:height="height"
		>
			<template v-slot:placeholder>
				<v-layout
				fill-height
				align-center
				justify-center
				ma-0
				>

				<v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
				</v-layout>
			</template>
  	</v-img>
		</a>
</template>

<script type="text/javascript">
  export default {
    props:
	    {
		    height: {type: String,default: 'auto'},
		    src: {type: String},
		    name: {type: String},
		    to: {type: String,default: '#'}
		  },
    data () {
	    return {
	      ruta:url
	    }
		},
  	methods: {
	      formaturl(){
	      	let aux= this.name.split(" ").join("-");
	        let result=this.ruta+'item/'+this.to+'-'+aux;
	        return result;
	    },
		}
  }
</script>
