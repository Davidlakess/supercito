<template>
	<b-col md="12">
		
    <b-card no-body class="overflow-hidden" v-if="!isMobil()" >
      <b-card-body style="padding: 33px 33px 33px;">
        <div class="categoria-container" style="border-bottom: 1px solid #ededed;" v-for="categoria in categorias">
          <h2 class="titulo-categoria">
            <a href="#">
              {{categoria.name}}
            </a>
          </h2>
          <ul class="categoria-lista" >
            <li class="categoria-item" v-for="item in categoria.items">
              <a :href="formaturl(item.name,item.ids)" class="categoria-subtitulo ">{{item.name}}</a>
            </li>
          </ul>
        </div>
      </b-card-body >
    </b-card>

    <b-card no-body class="overflow-hidden" v-else style="margin-bottom: 25px;">
      <b-card-body>

        <div class="categoria-container" style="border-bottom: 1px solid #ededed;" v-for="categoria in categorias">
          <h6 class="titulo-categoria">
            <a href="#">
              {{categoria.name}}
            </a>
          </h6>
          <ul  style="display:contents;">
            <li class="categoria-item" v-for="item in categoria.items">
              <a :href="formaturl(item.name,item.ids)" class="categoria-subtitulo ">{{item.name}}</a>
            </li>
          </ul>
        </div>
      </b-card-body>
    </b-card>
    
	</b-col>
</template>
<script type="text/javascript">
	export default {
		props:['categorias']

	,
  methods:{
    formaturl(value,id){
      let aux= value.split(" ").join("-");
      
      let result=url+'c/'+aux+'/'+id;

      return result;
    },
        isMobil() {
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
             return true
           } else {
             return false
           }
      }

  }
}
	</script>


  <style>
   
.titulo-categoria a{
  color: rgba(0,0,0,.8) !important;
}

.titulo-categoria a:hover{
  text-decoration: none !important;
  color: #007bff !important;
}

.categoria-subtitulo {
    font-size: 14px;
    margin: 0;
    font-weight: 400;
    /*text-decoration-line: none;*/

}
.categoria-container {
    margin-bottom: 40px;
}
.categoria-lista {
    margin: 0 auto;
    padding-bottom: 40px;
    -webkit-column-count: 4;
    -moz-column-count: 4;
    column-count: 4;
    -webkit-column-gap: 15px;
    -moz-column-gap: 15px;
    column-gap: 15px;
    padding-left: 0;
}
.categoria-item {
    font-size: 14px;
    line-height: 24px;
    list-style-type: none;
    width: 25%\9;
    float: left\9;
}
.categoria-item a {
    color: rgba(0,0,0,.45);
    text-transform: capitalize;
}


.categoria-item a:hover{
  text-decoration: none !important;
  color: #007bff !important;
}
</style>