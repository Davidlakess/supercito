<template>
     <b-row align-h="center">
     	<slot></slot>
    <template v-for="pro in productos">
			<b-col  md="3" col="12" style="margin-bottom: 18px;padding-left: 0px;">
		    <producto-solo
		    :img="pro.img"
		    :name="pro.name"
		    :precio="pro.precio"
		    :id="pro.ids"
          	:logeado="logeado"
		    ></producto-solo>
	   	</b-col>
		</template>
</b-row>
</template>
<script type="text/javascript">
	export default {
    	props:['productos','logeado'],
    }

</script>