<template >
		<b-col cols="12"   style="padding: 0;margin: 0; margin-bottom: 12px; display: flex;">
			<b-col cols="3"  sm="1" lg="1" style="padding: 0;">
				<figure class="card card-product"  style="width: 100px; border: none;">
		      <div class="img-wrap" style="height: 100px !important;"> 
		         <b-img   :src="img"></b-img>
		      </div>
		    </figure>
			</b-col>
		 	<b-col cols="9" lg="10" sm="10" class="card-item" style="margin:0;">
		 		<b-col cols="12">
					<span>
						{{name}}
					</span>
		 		</b-col>
		 		<b-col cols="12">
					<span>
						Cantidad: {{cantidad}}
					</span>
	 			</b-col>
	 			<b-col cols="12">
					<span>
						$ {{precio}} c/u
					</span>
	 			</b-col>
		 	</b-col>
		</b-col>	
</template>
<script type="text/javascript">
	export default {
		props:['img','name','cantidad','precio']
	    
}

</script>