<template>
  	<li class="list-group-item" style="height: 145px;">
    	<b-row align-h="justify" class="poner-borde">                
      		<b-col  col="6" class="p-0">
        		<div class="img-wrap"> 
          			<a-img :to="id" :src="img" :name="name"></a-img>
        		</div>
      		</b-col>
      		<b-col col="6" class="p-0">
        		<b-col cols="12" class="p-0" style="display: flex; flex-direction: column;padding: 1px;">
          			<span class="name-producto" style="font-size: 12px;">{{name}}</span>
          			<span style="font-size: 19px; margin-top: 10px; padding-left:10px !important;">
          				<strong>$</strong>{{precio}}
          			</span>
        		</b-col>
      		</b-col>
   		</b-row>
	</li>
</template>
<script type="text/javascript">
	export default {
		props:['name','id','img','precio']
	}
</script>