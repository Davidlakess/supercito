-<template>
	<b-row align-h="justify" class="poner-borde">                
		<b-col cols="3" lg="3">
		  <div class="img-wrap"> 
          <a-img :to="id" :src="img" :name="name"></a-img>
	  	</div>
		</b-col>
		<b-col cols="7" lg="7" class="mb-custom">
		  	<div style=" height: 100%;display: inline-grid;">
		    	<b-col cols="12" style="display: flex; flex-direction: column;">
		    		<span style="text-transform: capitalize;color: #333;font-size: 20px;font-weight: 300;">{{name}}</span>
		  			<!-- <small>Vendido por </small> -->
		  			<span v-if="logeado" style="font-size: 26px;margin-top: 10px; text-transform: capitalize;">$ {{precio}}</span>
		  		</b-col>
		  	</div>
		</b-col>
		<b-col cols="2" lg="2" style="text-align: center;font-size: 22px;">
			<wishlist :idproducto="id" :logeado="false"></wishlist>
		</b-col>
	</b-row>
</template>
<script type="text/javascript">
	export default {
		props:['id','img','name','precio','logeado']
	}
</script>
