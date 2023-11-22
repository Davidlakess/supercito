<template>

  <div id="animation_box" class="animated fadeInLeft">
    <b-container id="content-p" style="display: inline; vertical-align: middle;"> 
    
     <div class="super-title">
        <b-row align-h="center">
          <b-col cols="12" >
            <span>Registrar  Producto</span>
          </b-col>
        </b-row>
      </div>
      <div class="card card-login mx-auto text-center">
        <b-container>
            <b-form method="POST" @submit.prevent="addproducto" enctype="multipart/form-data" action="/storage/create" >
               <slot></slot>
          <b-row align-h="center">
            <b-col cols="12" class="title-head">
              <span>Nombre del producto </span>
            </b-col>
            <b-col cols="12" class="text-justify" >
              <b-form-input placeholder="Ej:Pañal suavelastic Jumbo 40pz" v-model="producto.name" autofocus></b-form-input>
              <small class="s-small">Escribe el nombre de tu producto.</small>
            </b-col>
           
            <b-col cols="12" class="title-head" >
              <span>¿Cual es su Categoria?</span> 
            </b-col>
            
            <b-col cols="12" class="text-justify" >
                <b-form-select  @input="a()" v-model="categoria" :options="categorias" class="mb-3">
                  <template v-slot:first>
                    <b-form-select-option :value="null" disabled>Categorias </b-form-select-option>
                  </template>   
                  <b-form-select-option value="n" disabled></b-form-select-option>
                </b-form-select>
            </b-col>

            <b-col cols="12" class="title-head" >
              <span>SubCategoria</span> 
            </b-col>
            <b-col cols="12" class="text-justify" >
                <b-form-select  v-model="producto.subcategoria" :options="subcategorias" class="mb-3">
                  <template v-slot:first>
                    <b-form-select-option :value="null" disabled>SubCategorias</b-form-select-option>
                  </template>   
                  <b-form-select-option value="n" disabled></b-form-select-option>
                </b-form-select>
            </b-col>
           

              <b-col cols="12" lg="6" class="title-head" style="margin-bottom: 25px;">
                <span>
                Cantidad para vender    
                </span>  
                <b-form-input placeholder="Cantidad disponible" v-model="producto.cant" ></b-form-input>
              </b-col>
              <b-col cols="12" lg="6" class="title-head">
                <span>
                Cual es su Precio? <i class="fa fa-dollar-sign"></i>   
                </span>  
                <b-form-input id="popover-target-1" @keyup="hacer_descuento" placeholder="$Precio" v-model="producto.precio" ></b-form-input>
                <small >Por cada venta Recibes <strong style="color: #059916;"> ${{precio_con_descuento}}</strong> </small>
                  <b-popover target="popover-target-1" triggers="hover" placement="top">
                      <template v-slot:title>Precio</template>
                       Hola,Ten en cuenta que se cobra una comicion de $1 por producto vendido,
                        <strong>Ejemplo:</strong>Si su precio es de $5 recibes $4 y asi con cada producto. 
                  </b-popover>
         
              </b-col>

            <b-col cols="12" lg="8" class="title-head" style="margin:0; margin-bottom: 10px; margin-top: 15px;">
              <span>
              Añade una imagen del producto <i class="fa fa-camera"></i>
              </span>  
                  <file-input v-model="file" @input="showimagen"></file-input>  
              <!-- <input type="file" @input="showimagen" v-model="file" multiple> -->
              </b-col>

            <b-col cols="12" lg="4"  style="margin:0; margin-bottom: 10px; margin-top: 10px;">
                  <figure class="card card-product" style="width: 100px;">
                    <div class="img-wrap"> 
                      <img :src="imgtumbler" alt="imagen">
                    </div>
                  </figure>
              </b-col>

              <b-col cols="12" >
                <!-- {{file}} -->
                <button type="submit"  class="btns btns-default" >Guardar</button>
                
              </b-col>
            </b-row>
            </b-form>  
          </b-container>
        </div>
    </b-container>
  </div>
</template>
<script>
  // import FileUpload from 'vue-upload-component'
  export default {
    // components: {
    //   FileUpload,
    // },
    // props:[
    // 'token'
    // ],
    data() {
      return {
        items:[],
        imgtumbler:null,
        categoria:null,
        precio_con_descuento:0,
        producto:{},
        valdescuento:1,
        file:null,
        subcategorias:[],
        categorias: []
      }
    },
    mounted() {
      this.getproductos();
      this.getcategorias()
    },    
    methods: {
      a(){

        axios.post("api/subcategorias",{'id_categoria':this.categoria}).then(data => {
          this.subcategorias=data.data;
        }).catch(error => {
             console.log(error);  
        });

      },
      getcategorias(){
          
        axios.post("api/categoriavender").then(data => {
          this.categorias=data.data;
        }).catch(error => {
             console.log(error);  
        });

      },
      showimagen(file){

          let reader =  new FileReader();
          reader.onload =(e)=>{
            this.imgtumbler=e.target.result;
          }
          reader.readAsDataURL(file);
      },
      indexof(val){
        alert(val);
      },
      getproductos(){

        axios.get("api/productos").then(data => {
          this.items=data.data;
        }).catch(error => {
             console.log(error);  
        });
      
      },
      hacer_descuento(){
        if(this.producto.precio>0){
          this.precio_con_descuento=parseInt(this.producto.precio) - parseInt(this.valdescuento);
        }else{
          this.precio_con_descuento=0; 
        }
      },
      addproducto(){
        // console.log(this.producto)
        let formd=new FormData;
        formd.append('file',this.file);
        formd.append('data',JSON.stringify(this.producto));
         
        axios.post("/storage/create",formd).then(data => {
              alert('producto guardado')
          this.producto={};
          this.file="";
          this.imgtumbler="";
        }).catch(error => {
             console.log(error);  
        });  
      },

       inputFilter(newFile, oldFile, prevent) {
        if (newFile && !oldFile) {
        // Before adding a file
        // Filter system files or hide files
        if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
          return prevent()
        }
        // Filter php html js file
        if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
          return prevent()
        }
      }
    },
  }
}

</script>
<style> 
.card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden; 
  }
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 100px;
    text-align: center; 
  }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100px;
      object-fit: cover;

    }
</style>