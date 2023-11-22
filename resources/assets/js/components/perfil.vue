<template>
 <div id="animation_box" class="animated fadeInLeft">
    <b-container id="content-p" style="display: inline; vertical-align: middle;"> 
     <div class="super-title">
        <b-row align-h="center">
          <b-col cols="12" >
            <span>Mi Perfil</span>
          </b-col>
        </b-row>
      </div>
      <div class="card card-login mx-auto text-center">
        <b-container>
          <b-form method="POST" @submit.prevent="actualizarusuario()">
	          <b-row align-h="center">
	            <b-col cols="12" lg="6" class="text-justify" >
	            	<span>Nombre del producto </span>
	              <b-form-input 
                placeholder="Nombre Usuario" v-model="name" autofocus></b-form-input>
	            </b-col>

              <b-col cols="12" lg="6"  class="text-justify"  style="margin-bottom: 25px;">
                <span>E-Mail</span>  
                <b-form-input placeholder="Correo electronico" readonly :value="user.email" ></b-form-input>
              </b-col>
         <!--      <b-col sm="12" lg="12"  class="text-center"  style="margin-bottom: 10px;">
                <span>Dirección</span>  
              </b-col> -->

             <!--  <b-col sm="12" lg="4"  class="text-center"  style="margin-bottom: 10px;">
                <span>Localidad</span>  
                <b-form-input placeholder="" readonly v-model="user.localidad"></b-form-input>
              </b-col>
              <b-col sm="12" lg="4"  class="text-center"  style="margin-bottom: 10px;">
                <span>telefono</span>  
                <b-form-input placeholder="" readonly v-model="user.telefono"></b-form-input>
              </b-col>
              <b-col sm="12" lg="4"  class="text-center"  style="margin-bottom: 10px;">
                <span>numero exterior</span>  
                <b-form-input placeholder="Numero exterior" v-model="user.numero_e"></b-form-input>
              </b-col>
              <b-col sm="12" lg="4"  class="text-center"  style="margin-bottom: 10px;">
                <span>numero interiror</span>  
                <b-form-input placeholder="Numero interior" v-model="user.numero_i"></b-form-input>
              </b-col>
              <b-col sm="12" lg="8"  class="text-center"  style="margin-bottom: 10px;">
                <span>Calle</span>  
                <b-form-input placeholder="" v-model="user.calle" ></b-form-input>
              </b-col>

              <b-col sm="12" lg="12"  class="text-center"  style="margin-bottom: 10px;">
                <span>entre las calles:</span>  
              </b-col>
              
              <b-col sm="12" lg="6"  class="text-center"  style="margin-bottom: 10px;">
                <span>calle 1</span>  
                <b-form-input placeholder="" v-model="user.calle_1"></b-form-input>
              </b-col>
              <b-col sm="12" lg="6"  class="text-center"  style="margin-bottom: 10px;">
                <span>calle 2</span>  
                <b-form-input placeholder="" v-model="user.calle_2"></b-form-input>
              </b-col> -->
  <!-- 
	            <b-col cols="12" class="text-justify">
		           	<span>Avatar</span>  
                <figure class="card card-product" style="width: 100px;">
                  <div class="img-wrap"> 
                    <img :src="'uploads/'+user.avatar" alt="imagen">
                  </div>
                </figure>
              </b-col> -->

              <b-col cols="12" >
                <button type="submit"  class="btns btns-default" >Guardar</button>
              </b-col>
            </b-row>
          </b-form>  
        </b-container>
      </div>
    </b-container>
  </div>
</template>
<script type="text/javascript">
	export default {
    data() {
      return{
        name:''
      }
    },
    mounted(){
      this.name=this.user.name
    },
		props:['user'],
		methods: {
	    	actualizarusuario(){
           // let formd=new FormData;
           //  formd.append('',this.file);
           //  formd.append('data',JSON.stringify(this.producto));
             
            axios.post("api/updateuser",{name:this.name}).then(data => {
              
              if(data.data.status){
                    swal.fire(
                '¡Informacion Actualizada!',
                '',
                'success'
                )
              }else{
                swal.fire(
                '¡No se pudo actualizar!',
                'intenta mas tarde',
                'error'
                )
              }

            }).catch(error => {
              swal.fire(
                '¡Error!',
                'intenta de nuevo',
                'error'
                )
                 // console.log(error);  
            });  
        }
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