<template>

    <li style="margin-left: 30px;" :class="(open)?'dropdown dropdown-large open':'dropdown dropdown-large'" @click="open=!open">
        <a href="#" style="text-decoration: none;color:#fff !important;" class="dropdown-toggle" data-toggle="dropdown">Categorias</a>
        
        <ul class="dropdown-menu dropdown-menu-large row" v-on:mouseleave="open=false">
          <template v-for="cat in categorias">
            <li class="col-sm-3">
              <ul>
                <li class="dropdown-header" style="text-transform: capitalize;">{{cat.name}}</li>
                <template v-for="subcat in cat.items">
                  <li><a :href="formaturl(subcat.name,subcat.ids)" style="text-transform: capitalize;">{{subcat.name}}</a>
                  </li>
                </template>
                
                <li class="divider"></li>
                <li class="dropdown-header">{{cat.sub}}</li>
                
                <!-- <template v-for="subcat in cat.categoria.subitems">
                  <li><a :href="ruta+'categoria/'+subcat.name">{{subcat.name}}</a></li>
                </template> -->

              </ul>
            </li>
          </template>
            <div style="text-align: center; width: 100%;">
              <li><a :href="ruta+'AllCategorias'">Todas las Categorias</a></li>
            </div>
        </ul>
      </li>        
</template>
<script type="text/javascript">
   export default {
     data() {   
       return {
        ruta:url,
          categorias:[],

          open:false
       }
     },
     mounted() {
      // this.getcategorias();

        // if ('categorias' in localStorage) {
         // this.categorias=JSON.parse(localStorage.categorias);
        // }else{
          axios.get(this.ruta+"getcategorias").then(data => {
            this.categorias = data.data
            // console.log(data.data)
            localStorage.categorias=JSON.stringify(this.categorias);
          
          })
        // }
     },
     created() {
        
     },
     methods: {
        formaturl(value,id){
          let aux= value.split(" ").join("-");
          
          let result=this.ruta+'c/'+aux+'/'+id;
          return result;
        },
        makearray(array){
        var cat=[];
        // var catego=[];
        for (var i =0;i< array.length;i++) {
          cat=array[i].hijos.split(',',4);
          this.categorias[i]={nombre:array[i].padre,items:[]};
          
          for(var j =0;j<cat.length;j++){
            var aux=cat[j].split('-');
            this.categorias[i].items.push({name:aux[0],id:aux[1]});
          
          }
        }
      }
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
