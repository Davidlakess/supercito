<template>
	<a :href="formaturl()" >
		<img :src="'/uploads/'+this.src"  loading="lazy" class="img-responsive img-fluid" alt="sin imagen">
	</a>  	
</template>

<script type="text/javascript">
  export default {
    props:['to','src','name'],
    	methods: {
		      formaturl(){
		      	let aux= this.name.split(" ").join("-");
		        let result='/item/'+this.to+'-'+aux;
		        return result;
		    },
		}
  }
</script>
