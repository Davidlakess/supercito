<template>
	<table class="table table-hover table-dark">
	  <thead style="text-align: center;">
	    <tr>
	      <th v-for="head in headers" scope="col">{{head.text}}</th>
	    </tr>
	  </thead>
	  <tbody style="text-align: center;">
	   	<slot></slot>
	  </tbody>
	</table>
</template>
<script type="text/javascript">
	export default {
		props:['headers'],
	}
</script>
