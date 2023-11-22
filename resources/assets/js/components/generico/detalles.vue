<template>	
	<div id="animation_box" class="animated fadeInLeft" style="margin-bottom: 40px;">  
		<details :open="open">
		  <summary >
		   <span style="text-transform: capitalize;">{{titulo}}</span>
		    <svg  v-if="showsumary" class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>
		    <svg  v-if="showsumary" class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg> 
		  </summary>
		  	<slot></slot>
		</details>
	</div>
</template>
<script type="text/javascript">
	export default {
		props:['titulo','showsumary','open'],
	}
</script>