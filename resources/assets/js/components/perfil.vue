<template>
<div style="margin-bottom: 10%;">
    <v-container>
      <v-layout>
        <v-flex xs12 sm12 offset-sm1>

           <v-card>
        <v-card-title>
          <span class="headline">Datos de Usuario</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md6>
                <v-text-field label="Nombre" outline ></v-text-field>
              </v-flex>
                <v-flex xs12 sm6 md6>
                <v-text-field label="Telefono" outline ></v-text-field>
              </v-flex>
                  <v-flex xs12 sm12 md12>
                <v-text-field label="Correo Electronico" outline ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="">Guardar</v-btn>
        </v-card-actions>
      </v-card>
      <v-card>
        <v-card-title>
          <span class="headline">Datos de Domicilio</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
            <v-flex xs12 sm6 md4 d-flex>
                  <v-select
                    :items="items"
                    label="Localidad"
                    outline
                  ></v-select>
                </v-flex>
                <v-flex xs12 sm6 md4>
                <v-text-field label="Calle" outline ></v-text-field>
              </v-flex>
                  <v-flex xs12 sm12 md4>
                <v-text-field label="Numero Exterior" outline ></v-text-field>
              </v-flex>
                <v-flex xs12 sm12 md4>
                <v-text-field label="Numero Interior" outline ></v-text-field>
              </v-flex>
                <v-flex xs12 sm12 md4>
                <v-text-field label="Entre la Calle ?" outline ></v-text-field>
              </v-flex>
                <v-flex xs12 sm12 md4>
                <v-text-field label="Y la calle ?" outline ></v-text-field>
              </v-flex>
                <v-flex xs12 sm12 md12>

                <v-textarea
          label="Referencia"
          outline
          value=""
          hint="Referencia de tu domicilio, ejemplo: porton negro o frente una escuela"
        ></v-textarea>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="">Guardar</v-btn>
        </v-card-actions>
      </v-card>
      </v-flex>
      </v-layout>
    </v-container>
</div>
</template>
<script type="text/javascript">
	export default {
    data() {
      return{
        name:'',
        items: ['Alvaro', 'Singuio']
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