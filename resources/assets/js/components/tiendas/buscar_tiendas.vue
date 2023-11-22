<template>
	<b-row align-h="center">
		<div class="container-fluid " v-for="tienda in tiendas">
		  <div class="thumbex col-md-6" v-for="item in tienda.items">
		    <div class="thumbnail"><a :href="ruta+'tienda-home'"> <img :src="item.img"/><span>{{item.name}}</span></a></div>
		  </div>
		</div>
</b-row>
</template>
<script type="text/javascript">
	export default {
	props:['productos','promos','productosnuevos','logeado'],
		data(){
			return {
					ruta:url,
					tiendas:[{
							
								items:[
								{
									name:'Tacos Don Luis',
									img:'https://image.freepik.com/foto-gratis/pastel-cafe-duenos-pequenos-negocios_53876-73331.jpg'
								},
								{
									name:'Super Farmacia San Vicente',
									img:'https://i0.wp.com/www.oinkoink.com.mx/wp-content/uploads/2020/04/Pymes-Mexico.jpg?fit=1200%2C627&ssl=1'
								},
								{
									name:'OXXO',
									img:'https://cdn2.dineroenimagen.com/media/dinero/styles/xlarge/public/images/2018/07/oxxo-tienda.jpg'
								}
							]
						},
						{
							
								items:[
								{
									name:'Tacos Don Luis',
									img:'https://image.freepik.com/foto-gratis/pastel-cafe-duenos-pequenos-negocios_53876-73331.jpg'
								},
								{
									name:'Super Farmacia San Vicente',
									img:'https://i0.wp.com/www.oinkoink.com.mx/wp-content/uploads/2020/04/Pymes-Mexico.jpg?fit=1200%2C627&ssl=1'
								},
								{
									name:'OXXO',
									img:'https://cdn2.dineroenimagen.com/media/dinero/styles/xlarge/public/images/2018/07/oxxo-tienda.jpg'
								}
							]
						},
						{
							
								items:[
								{
									name:'Tacos Don Luis',
									img:'https://image.freepik.com/foto-gratis/pastel-cafe-duenos-pequenos-negocios_53876-73331.jpg'
								},
								{
									name:'Super Farmacia San Vicente',
									img:'https://i0.wp.com/www.oinkoink.com.mx/wp-content/uploads/2020/04/Pymes-Mexico.jpg?fit=1200%2C627&ssl=1'
								},
								{
									name:'OXXO',
									img:'https://cdn2.dineroenimagen.com/media/dinero/styles/xlarge/public/images/2018/07/oxxo-tienda.jpg'
								}
							]
						},
						{
							
								items:[
								{
									name:'Salon Serrato',
									img:'https://image.freepik.com/foto-gratis/pastel-cafe-duenos-pequenos-negocios_53876-73331.jpg'
								},
								{
									name:'Ropa Americana Marta',
									img:'https://i0.wp.com/www.oinkoink.com.mx/wp-content/uploads/2020/04/Pymes-Mexico.jpg?fit=1200%2C627&ssl=1'
								},
								{
									name:'OXXO',
									img:'https://cdn2.dineroenimagen.com/media/dinero/styles/xlarge/public/images/2018/07/oxxo-tienda.jpg'
								}
							]
						},

					],
				}
		},
		created() {
			 // this.addcarrito_componete();
		},
		mounted (){
			// console.log(this.mdruta)
		},
	methods:{
		 
	}
}
</script>
<!-- tiendas:[{
								items:[
								{
									name:'Super lucita',
									img:'https://cdn-3.expansion.mx/dims4/default/6fd9bea/2147483647/strip/true/crop/3786x2441+0+113/resize/1800x1161!/quality/90/?url=https%3A%2F%2Fcdn-3.expansion.mx%2F14%2F74%2F5b759c5f4601b7ffa1a642fdfb97%2Fabarrotes.jpg'
								},
								{
									name:'FarmaPronto',
									img:'https://lh3.googleusercontent.com/4DddT-oNnzO2x3pXI19WfXlBVHOgV8NiD9IYt2g8QmXuEIMsHYfHPAbcSL4raCMY7icKSlOd=w1080-h608-p-no-v0'
								},
								{
									name:'Delicias Mary',
									img:'https://www.negociosgarantizados.com/wp-content/uploads/2016/07/hot-dog-van-1293505_960_720-680x380.jpg'
								}
							]
						},
						{
								items:[
								{
									name:'Tacos Don Luis',
									img:'https://image.freepik.com/foto-gratis/pastel-cafe-duenos-pequenos-negocios_53876-73331.jpg'
								},
								{
									name:'Super Farmacia San Vicente',
									img:'https://i0.wp.com/www.oinkoink.com.mx/wp-content/uploads/2020/04/Pymes-Mexico.jpg?fit=1200%2C627&ssl=1'
								},
								{
									name:'OXXO',
									img:'https://cdn2.dineroenimagen.com/media/dinero/styles/xlarge/public/images/2018/07/oxxo-tienda.jpg'
								}
							]
						}
					], -->