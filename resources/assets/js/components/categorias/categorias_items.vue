<template>
	<b-col md="12" style="padding-bottom: 15px;">
          <b-row align-h="center">
          	<template v-for="categoria in categorias">
            <b-col md="4" style="padding-bottom: 15px; padding-right: 0;">
              <b-card no-body class="overflow-hidden" style="height: 236px;; font-size: 21px;">
                <img :src="categoria.img" alt="Personal ">
              <div class="titulo-card"><span class="subtitulo-card">{{categoria.titulo}}</span><h3 class="pretitulo-card">{{categoria.subtitulo}}</h3><p class="enlace-card">Ver productos</p></div>
              </b-card>
            </b-col>
          	</template>
          </b-row>
        </b-col>
</template>
<script>
export default {
	props:['logeado'],
		data(){
			return {
				mdruta:"/middlecarrito",
				categorias:[
					
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_976573-MLA41891261737_052020-F.jpg',
						titulo:'Tu Cuidado',
						subtitulo:'Personal',
						url:''
					},

					{
						img:'https://http2.mlstatic.com/D_NQ_NP_780504-MLA41891261616_052020-F.jpg',
						titulo:'para tu',
						subtitulo:'Hogar',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_902301-MLA41891261603_052020-F.jpg',
						titulo:'Para tu',
						subtitulo:'Bebe',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_672109-MLA41891261730_052020-F.jpg',
						titulo:'Para Tu',
						subtitulo:'Despensa',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_834495-MLA41891261732_052020-F.jpg',
						titulo:'Variedad EN',
						subtitulo:'Bebidas',
						url:''
					},
					{
						img:'https://http2.mlstatic.com/D_NQ_NP_712289-MLA41891261733_052020-F.jpg',
						titulo:'PARA TU',
						subtitulo:'Mascota',
						url:''
					},
				]
			}
		},
		created (){
	
		},
	methods:{
	
	}
}
</script>