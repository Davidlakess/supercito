<template>	
<b-container  fluid style="margin-bottom: 30px; margin-top: 20px;">
<b-row>
  	<b-col md="12" >
      <ol class="andes-breadcrumb">
     
        <li class="li-sin-decoracion"> 
          <a :href="linklistado" title="regresar" class="breadcrumb__link">
            <span class="text-category">Volver al listado</span>
          </a>
          <span class="separador">|</span>
        </li>

        <template v-if="nav" v-for="(n,key) in nav">      
          <li class="li-sin-decoracion">
            <i class="fa fa-angle-right icon-category" v-if="key!=0"></i>
          <a :href="formaturl(n.name,n.id)" :title="n.name" class="breadcrumb__link">
            <span class="text-category">{{n.name}}</span>
          </a>
          </li>
        </template>
      </ol>
  	</b-col>
 	</b-row>
  <b-card>
    <b-row align-h="center">
    	<b-col md="8" lg="8" >
        <carousel
          :images="getimgs">
        </carousel>
        <hr style="font-weight: bold;"> 
  <!-- Mas Productos -->
  <template v-if="extras.length!=0">
 <div class="super-titulo"><span>Productos relacionados..</span></div>
      <carousel-mini>
          <template v-for="(item,indx) in extras">  
          <carousel-slider-mini :index="indx">
              <div class="row">
                <div class="col-sm-3" style="padding:4px;" v-for="i in item">
                  <producto-card-btn
                  :id="i.ids"
                  :name="i.name"
                  :precio="i.precio"
                  :img="i.img"
                  :raiting="i.raiting"
                  :stock="i.stock"
                  :logeado="logeado"
                  >
                  </producto-card-btn>
                </div>
              </div>
        </carousel-slider-mini>
        </template>
      </carousel-mini>
    </template>
  <!-- Mas productos -->
    <!-- CARACTRISTICAS PRINCIPALES -->
      <div v-if="caracter.length!=0">
        <hr>
        <div  style="margin-bottom: 20px;font-size: 25px;">
          <span>Informacion del Producto.</span>
        </div>
      <b-table
      :items="caracter"
      thead-tr-class="d-none"
      :striped="true"
      :bordered="true"
      :fields="fields"
    ></b-table>

      <hr>
      </div>         

<!-- Descripcion -->
      <div style="margin-top: 20px; font-size: 23px;font-weight: 400;">
          <span>Descripcion</span>
          <p class="content-descripcion" v-html="(producto.des=='')?'No se agrego una Descripcion':addsaltos(producto.des)"></p>
      </div>

      </b-col>
      
      <b-col md="4" lg="4"  @mouseover="btnshow=true" @mouseleave="btnshow=false" >
          <div style="width: 97%;height:435;position: absolute;padding: 0;" :class="(btnshow)?'':'indexm'">
                 <div class="zoom-container"></div>
          </div>
        <b-card class="card-detalle-producto">
          <b-col md="12" lg="12" >
                    
            <div style="display: flex; flex-direction: column;"> 
                <b-row>
                  <b-col md="10" >
                    <span class="target-p" >Nuevo</span> 
                  </b-col>
                  <b-col md="2" >
                    <wishlist style="font-size: x-large;" :idproducto="producto.ids" :active="producto.wish" :logeado="logeado"></wishlist>
                    
                  </b-col>
                </b-row>
                                  
                <span   class="titulo-p">
                  <!-- Fisher-price, Rocki, Juguete Para Bebé -->
                  {{producto.name}}
                </span>
                 <ul class="opinion-p">
                  <i class="fa fa-star text-danger"></i>
                  <i class="fa fa-star text-danger"></i>
                  <i class="fa fa-star text-danger"></i>
                  <i class="fa fa-star text-danger"></i>
                  <i class="fa fa-star "></i>  
                </ul>
                
                <span  class="precio-p">
                  ${{producto.precio}}

                </span>
              <!-- 
                <span v-if="false" style="margin: 20px 0 20px 0px;font-size: 17px;">
                  Color: <span style="font-weight:600;">Blanco</span>
                </span> -->
       
                <span class="estatus-p" v-if="1<producto.stock">
                 <b-alert show variant="success" class="text-center">¡Disponible en Stock!</b-alert>
                </span>
                
              <div style="display: flex; font-size: 18px;margin-bottom: 15px;" v-if="producto.stock>1">
                <span>
                  Cantidad: 
                </span>
                <template v-if="selected!=null">  
                    <b-form-select v-model="selected" class="mb-3 select-unidad">
                      <template v-for="a in  options">
                        <b-form-select-option :value="a.value">
                          {{a.text}} {{(a.text=='1')?'unidad':'unidades'}}
                        </b-form-select-option>
                      </template>
                    </b-form-select>
                </template>
                
                <template v-else>  
                  <b-form-spinbutton 
                  id="sb-inline"  
                  v-model="cantextra" 
                  @keyup.enter="addcantidad()" 
                  inline
                  ></b-form-spinbutton>   
                </template>

                    <span style="font-weight: 100; font-size: 15;">
                      (Disponible#{{parseInt(producto.stock)}}) 
                    </span>
              </div>
              <div v-if="producto.stock==1">
                 <b-alert show variant="warning" class="text-center">¡Utimo Disponible!</b-alert>
              </div>
              </div>
               <b-alert v-if="nameState" show variant="danger" class="text-center">Agotado</b-alert>
                <!-- <span class="vendido-por-p" >Vendido por: Super Andrea</span> -->
               </div>
               
          </b-col>
          <b-col md="12" lg="12" v-if="!nameState">
            <div class="btn-carrito-p">
              <btn-addcarrito :block="true" :cant="selected" :id="producto.ids" :logeado="logeado"> 
              </btn-addcarrito>
            </div>
          </b-col>
        </b-card>
      </b-col>
    </b-row> 
 	</b-card>
      <v-carousel  class ="carousel-pro" :interval="6000"  light hide-delimiters Default style="box-shadow: none;">
        <template v-for="(item,indx) in  productos"> 
      <v-carousel-item :key="indx">
        <v-container fluid grid-list-sm>
          <v-layout>
            <template v-for="(slider,key) in item">
            <v-flex xs3 md3 :key="key">
              <v-card height="auto" style=" margin: 9px; box-shadow: none;"> 
                <producto-carousel
                :idproducto="slider.id_producto"
                :img="slider.img"
                :name="slider.name"
                :precio="slider.precio"
                :stock ="slider.stock"
                :logeado="logeado"
                >
                </producto-carousel>
              </v-card>
            </v-flex>
            </template>
          </v-layout>
        </v-container>
      </v-carousel-item>
    </template>
    </v-carousel>

</b-container>
</template>
<script>
import carousel from '../mycarousel.vue'
import carouselmini from '../generico/carousel/carousel_mini.vue'
import carouselslidermini from '../generico/carousel/carousel_slider_mini.vue'
import productocardbtn from '../generico/producto_card_btn.vue'

// Vue.component('producto-card-btn', require('./components/Generico/').default);
export default{
  components: {
    'carousel':carousel,
    'carousel-mini':carouselmini,
    'carousel-slider-mini':carouselslidermini,
    'producto-card-btn': productocardbtn
  },
    props:[
    'producto',
    'extras',
    'logeado',
    'nav',
    'caracter'
    ],
    data() {
      return {
          btnshow:false,
          fields: ['clave', 'valor'],
          ruta:url,
          selected:'1',
          cantextra:1,
          options: [],
          productos: [
            [
          {
            ids: 1,
            img: 'MNL0b742Tj_1638082561.jpg',
            name: 'rico pollo sobre 100gr',
            precio: 10,
            stock: 2
          },
          {
            ids: 2,
            img: 'MNL0DmEs7J_1638083022.webp',
            name: 'algun producto por ahi',
            precio: 30,
            stock: 3
          },
          {
            ids: 2,
            img: 'MNL1O2harq_1638082939.webp',
            name: 'precios',
            precio: 30,
            stock: 3
          },
          {
            ids: 2,
            img: 'MNL1O2harq_1638082939.webp',
            name: 'precios',
            precio: 30,
            stock: 3
          }
          ],
          [
            {
            ids: 1,
            img: 'MNL2D10Fcq_1626468106.jpg',
            name: 'rico pollo sobre 100gr',
            precio: 10,
            stock: 2
          },
          {
            ids: 2,
            img: 'MNL2jthb8H_1628461484.jpg',
            name: 'algun producto por ahi',
            precio: 30,
            stock: 3
          },
          {
            ids: 2,
            img: 'MNL4Hg0CDT_1638082934.jpg',
            name: 'pros y contras',
            precio: 30,
            stock: '0.00'
          },
          {
            ids: 2,
            img: 'MNL4Hg0CDT_1638082934.jpg',
            name: 'productos',
            precio: 30,
            stock: 3
          }
          ]
        ]
      }
    },

    mounted(){

          this.producto.stock=parseInt(this.producto.stock);
          document.title =this.producto.name;

        if(this.producto.stock > 1 && this.producto.stock < 6){
            
            for(var i=0;i<this.producto.stock;i++){
            
                this.options.push({value:i+1, text:i+1});
                // console.log(1);
            }
        }else if(this.producto.stock >= 6){

          this.options=[
              { value: '1', text: '1' },
              { value: '2', text: '2' },
              { value: '3', text: '3' },
              { value: '4', text: '4' },
              { value: '5', text: '5' },
              { value: null, text: '+' }
            ]

        }
    },
    computed:{
      getimgs(){
        
        var imgs =this.producto.imgs.split(',');
        var images=[];

          for(var i=0;i < imgs.length;i++){

              var str=imgs[i].split('.');
              
              images[i]=
              {
                    id:i+1,
                    img:'/uploads/thumbnail/'+str[0]+'-N.'+str[1],
                    big:'/uploads/thumbnail/'+str[0]+'-B.'+str[1],
                    thumb:'/uploads/thumbnail/'+str[0]+'-R.'+str[1],
              }
        }
        return images;
      },
      nameState() {

        return this.cantextra > this.producto.stock ? true : false
      },
      linklistado(){
        let size= this.nav.length-1;
        let name =this.nav[size].name;
        let id= this.nav[size].id;

        return this.formaturl(name,id);

      }

    },
    methods: {
      addsaltos(str){
        var texto = str.replace(/\n/g, "<br />");

        return texto;
      },
       rowClass(item, type) {
        if (!item || type !== 'row') return
        if (item.status === 'awesome') return 'table-success'
      },
      
      formaturl(value,id){
        let result=this.ruta+'c/'+value+'/'+id;
        return result;
    },
    addcantidad(){
          if(this.cantextra <= this.producto.stock){
              
              if(this.cantextra >= 6){
              
                this.options.push({value:this.cantextra, text:this.cantextra});
              }
              
              if(this.cantextra!=0){
              
                  this.selected=this.cantextra;
              
              }else{
                
                  this.selected=1;
              
              }
          }
    }
  }
}
</script>

<style>	
.select-unidad{
  
  border: 0px none;
width: auto;
padding: 0px 2px;
margin: 0px;
    margin-bottom: 0px;
height: auto;
font-size: 18px;
font-weight: 600;
}

		.titulo-p{
    font-size: 22px;
    font-weight: bold;
    text-transform: uppercase;
    /*text-transform: capitalize;*/
  }
  .precio-p{
    font-size: 36px;
    font-weight: 300;
    text-align: justify;
    margin-bottom: 15px;
  }
  .estatus-p{
    font-size: 20px;
    color: #656565;
    padding-bottom: 10px;
  }
  .opinion-p{
    font-size: 17px;
    padding: 10px;
    padding: 0;
    margin: 0;
    color: #cdcde0;
  }

.custom-select:focus {
    box-shadow:none;
}
.custom-select{
    padding-right: 20px;
}
   

 .wish-icon {
  position: absolute;
  right: 10px;
  top: 10px;
  z-index: 99;
  cursor: pointer;
  font-size: 25px;
  color: #abb0b8;
}
.wish-icon .fa-heart {
  color: #ff6161;
}
</style>