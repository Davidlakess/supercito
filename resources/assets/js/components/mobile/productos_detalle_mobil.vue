<template>	
<div>	
	<b-card style="border:0;" class="c">
          <b-col md="12" lg="12" style="padding: 15px;">
            <div style="display: flex; flex-direction: column;"> 
                    <div style="display: inline;"> 
              <span class="target-p" >Nuevo</span>  
                    <wishlist style="font-size: x-large;text-align: end;width: 100%;" :idproducto="producto.ids" :active="producto.wish" :logeado="logeado"></wishlist>
                    </div>
                <span   class="titulo-p">
                  {{producto.name}}
                </span>

	                <ul class="opinion-p">
	                  <i class="fa fa-star text-danger" v-for="a in 4"></i>
	                  <i class="fa fa-star-half text-danger"></i>  
	                </ul>   
      		</div>
		   </b-col>

           <b-col md="12" xl="12">  
            <h6><b-badge>1/{{getsizeimgs()}}</b-badge></h6>                
                    <figure    @click="index = 0">
                        <div class="img-wrap"> 
                           <img :src="getimgs()[0]" class="img-mobil">
                        </div>
                    </figure>

            </b-col>
            <!-- {{producto}}	 -->
      

        </b-card>
      <b-card class="c">
        <b-col md="12" lg="12" >
        	<div style="display: flex; flex-direction: column; padding: 16px;"> 
	        

                <span class="estatus-p" v-if="1<producto.stock">
                   <b-alert show variant="success" class="text-center">¡Disponible en Stock!</b-alert>
                  </span>
                  
               	<span  class="precio-p">
                    ${{producto.precio}}
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



          	 <b-col md="12" lg="12" style="margin-top: 20px;" >

           <ul class="list-group list-group-flush" >
         <li class="list-group-item" style="text-align: center;">
            <span style="font-weight:600; font-size: 18px;">Mas productos de Abarrotes</span>
         </li>
       <li class="list-group-item" >
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="e in extras">
                <b-row align-h="justify" class="poner-borde">                
            <b-col  col="6" class="p-0">
              <div class="img-wrap-m"> 
                <a-img :to="e.ids" :src="e.img" :name="e.name"></a-img>
              </div>
            </b-col>
            <b-col col="6" class="p-0">
                <b-col cols="12" class="p-0" style="display: flex; flex-direction: column;" >
                    <span class="name-producto">{{e.name}}</span>
                    <!-- <small>Vendido por </small> -->
                    <span style="font-size: 24px; margin-top: 10px;">${{e.precio}}</span>
                </b-col>
            </b-col>
                </b-row>
            </li>
        </ul>
	    </li>
	    <li class="list-group-item" >
	     <a href="#"> Ver mas</a>
	     </li>
	    </ul>
   	</b-col>
	   	<div style="display: flex; flex-direction: column; padding: 16px;">     
	       <template v-if="características.length!=0">
            <div style="margin-bottom: 20px;font-size: x-large">
	          <span>Informacion del Producto.</span>
	        </div>
    	      <b-table
    	      :items="características"
    	      thead-tr-class="d-none"
    	      :striped="true"
    	      :bordered="true"
    	      :fields="fields"
    	    ></b-table>
         </template>
	  
		<div style=" padding: 40px 16px;font-size: 20px;font-weight: 400;">
	        <span style="margin-bottom: 24px;">Descripcion</span>
	        <p class="content-descripcion-m">{{(producto.des=='')?'No se agrego una Descripcion':addsaltos(producto.des)}}</p>
	    </div>
	</div>
  </b-card>
</div>	

</template>
 
<script>
 
 
  export default {

props:['características','logeado','producto','extras'],
    data() {
      return {
      index: null,
      fields: ['clave', 'valor'],
      selected:'1',
      cantextra:1,
      options: []
      }
    },
    mounted(){
        this.getimgs();
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
      nameState() {
        return this.cantextra > this.producto.stock ? true : false
      },

    },
    methods:{
        getimgs(){
           var img= this.producto.imgs.split(',');
           var images=[];
           for (var i =0; i< img.length ;i++ ) {
                images[i]='/uploads/'+img[i];
           }
           return  images;
        },
        getsizeimgs(){
           var img= this.producto.imgs.split(',');
           return img.length
           console.log(img)
        },
         addsaltos(str){
          var texto = str.replace(/\n/g, "<br />");
          return texto;
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
.content-descripcion-m{
font-weight: 400;
font-size: 16px;
word-break: break-word;
}
.c .card-body{
	padding:0;
}
.titulo-p{
 font-size: 16px;
  margin-bottom: 10px;
  margin-top: 5px;
  font-size: 20px;
  font-weight: bold;
/*text-transform: capitalize;*/
}
  .precio-p{
    font-size: 36px;
    font-weight: 300;
    text-align: justify;
  }
  .estatus-p{
    font-size: 17px;
    color: #656565;
    padding-bottom: 10px;
  }
  .opinion-p{
    font-size: 11px;
    padding: 10px;
    padding: 0;
    margin: 0;
    color: #cdcde0;
  }
  .opinion-p i{
    margin-right: 3px;
  }


.img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 300px;
    text-align: center; }
    .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; 
     padding: 16px;
  }
      
     .img-wrap-m {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 145px;
    text-align: center; }
  
  .img-wrap-m img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; 
  }
  .select-unidad{
  
  border: 0px none;
width: 120px;
padding: 0px 2px;
margin: 0px;
    margin-bottom: 0px;
height: auto;
font-size: 18px;
font-weight: 600;
}
.custom-select:focus {
    border-color:none;
    outline: none;
    box-shadow:none;
}
</style>