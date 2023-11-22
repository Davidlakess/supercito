<template>
    <li :class="(open)?'dropdown dropdown-large open':'dropdown dropdown-large'" @click="open=!open">
        <a href="#" style="text-decoration: none;color: rgba(0, 0, 0, 0.5);" class="dropdown-toggle" data-toggle="dropdown">Categorias</a>
        
        <ul class="dropdown-menu dropdown-menu-large row">
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Farmacia</li>
              <li><a href="#">Pañales</a></li>
              <li ><a href="#">Toallas Humedas</a></li>
              <li><a href="#">Medicamentos</a></li>
               <li><a href="#">Desodorantes</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Mascotas</li>
              <li><a href="#">Croquetas</a></li>
              <li><a href="#">Sobres</a></li>
              <li><a href="#">bultos</a></li>
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Abarrote</li>
              <li><a href="#">Aceites</a></li>
              <li ><a href="#">Atunes</a></li>
              <li><a href="#">Latas</a></li>
               <li><a href="#">A Granel</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Vinos</li>
              <li><a href="#">Tequilas</a></li>
              <li><a href="#">Whiskys</a></li>
              <li><a href="#">Ron</a></li>
            </ul>
          </li>
           <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Cuidado Personal</li>
              <li><a href="#">Shampoos</a></li>
              <li ><a href="#">Crema Corporal</a></li>
              <li><a href="#">Jabones tocador</a></li>
               <li><a href="#">Pastas Dentales</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Botanas y Bebidas</li>
              <li><a href="#">Refrescos</a></li>
              <li><a href="#">Minerales</a></li>
              <li><a href="#">Botanas</a></li>
            </ul>
          </li>
           <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Carnes Frias</li>
              <li><a href="#">Jamones</a></li>
              <li ><a href="#">Quesos</a></li>
              <li><a href="#">Cremas</a></li>
               <li><a href="#">Yogurt</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Otras categorias</li>
              <li><a href="#">Cerveza</a></li>
              <li><a href="#">Cigarros</a></li>
              <li><a href="#">Detergentes</a></li>
            </ul>
          </li>
        </ul>
        
      </li>        
<!-- Hacer sub categorias -->
	
    <!-- <b-nav-item-dropdown text="Categorias" right>
       <template v-for="categoria in categorias"> 
        <b-dropdown-item  href="#">{{categoria.name}}</b-dropdown-item>
        <b-dropdown-submenu></b-dropdown-submenu>
       </template>
    </b-nav-item-dropdown>   -->
</template>
<script type="text/javascript">
   export default {
	 	 data() {  	
       return {
     			categorias:[],
          open:false
       }
     },
     mounted() {
      this.getcategorias();
     },
     created() {
        
     },
	 methods: {
	     getcategorias(){
	     	axios.post("api/getcategorias").then(data => {
           this.categorias=data.data;
            console.log(data.data)
         }).catch(error => {
              console.log(error);  
         });
	     },
	 	}
	 }

</script>
<style>
.open > .dropdown-menu {
    display: flex;
}

.dropdown-large {
  position: static !important;
}
.dropdown-menu-large {
  margin-left: 16px;
  margin-right: 16px;
  padding: 20px 0px;
}
.dropdown-menu-large > li > ul {
  padding: 0;
  margin: 0;
}
.dropdown-menu-large > li > ul > li {
  list-style: none;
}
.dropdown-menu-large > li > ul > li > a {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.428571429;
  color: #333333;
  white-space: normal;
}
.dropdown-menu-large > li ul > li > a:hover,
.dropdown-menu-large > li ul > li > a:focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
}
.dropdown-menu-large .disabled > a,
.dropdown-menu-large .disabled > a:hover,
.dropdown-menu-large .disabled > a:focus {
  color: #999999;
}
.dropdown-menu-large .disabled > a:hover,
.dropdown-menu-large .disabled > a:focus {
  text-decoration: none;
  background-color: transparent;
  background-image: none;
  filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
  cursor: not-allowed;
}
.dropdown-menu-large .dropdown-header {
  color: #428bca;
  font-size: 18px;
}
@media (max-width: 768px) {
  .dropdown-menu-large {
    margin-left: 0 ;
    margin-right: 0 ;
  }
  .dropdown-menu-large > li {
    margin-bottom: 30px;
  }
  .dropdown-menu-large > li:last-child {
    margin-bottom: 0;
  }
  .dropdown-menu-large .dropdown-header {
    padding: 3px 15px !important;
  }
}

</style>