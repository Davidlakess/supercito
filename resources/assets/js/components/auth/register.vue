<template>
  <v-layout row>
    <v-flex xs12 sm8 offset-sm2 lg8 offset-lg2 style="margin-bottom:10%;">
      <v-card >
        <v-container>
          <v-form
            ref="formregister"
            @submit.prevent="validate()"
            v-model="valid"
            lazy-validation
            method="POST"
            >
              <!-- <slot></slot> -->
            <v-card-text>
              <div style="text-align: center;
  font-size: 35px;
  font-weight: bold;
  text-transform: capitalize;"><span>Nueva Cuenta</span></div>
              <v-card-title primary-title>
                <h4 class="headline mb-0">Datos de la Cuenta</h4>
              </v-card-title>
              <v-container>
                <v-layout row wrap>
                  <v-flex xs12 sm6 lg6>
                    <v-text-field
                      class="textuper"
                      autofocus
                      v-model="newUser.name"
                      :rules="[
      () => !!newUser.name || 'el nombre es requerido',
      () => (newUser.name && newUser.name.length >= 10) || 'el nombre debe contener al menos 10 caracteres']"
                       hint="Ingresa tu Nombre"
                      label="Nombre"
                      outline></v-text-field>
                  </v-flex>
                   <v-flex xs12 sm5 lg5 offset-sm1 offset-lg1>
                    <v-text-field
                      label="Telefono"
                      v-model = "newUser.telefono"
                      mask="phone"
                      :error-messages = "(errortel) ? 'El numero de telefono ya esta registrado elige otro': [] "
                      ref="telregister"
                      :rules="[
      () => !!newUser.telefono || 'el telefono es requerido',
      () => (newUser.telefono && newUser.telefono.length === 10) || 'el numero debe contener 10 digitos']"
                      outline>
                    </v-text-field>
                  </v-flex>
                  <v-flex xs12 sm12 lg12>
                    <v-text-field
                      hint="!Es importante que tengas acceso a este correo!"
                      label="Email"
                      :error-messages = "(error) ? 'Correo electronico ya esta registrado elige otro': [] "
                      ref="emailregister"
                      v-model="newUser.email"
                      :rules="[
      () => !!newUser.email || 'el correo electronico es requerido',
      () => /.+@.+/.test(newUser.email) || 'correo electronico invalido',
      () => allow.includes(newUser.email.split('@', 2)[1]) || '@dominio no valido']"
                      outline>
                    </v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 lg6 >
                   <v-text-field
                  :append-icon="passhow1 ? 'visibility' : 'visibility_off'"
                  :type="passhow1 ? 'text' : 'password'"
                  label="Contraseña"
                  hint="la Contraseña debe tener almenos 8 caracteres"
                  :rules="[() => !!newUser.password || 'la contraseña es  requerida',
                  () => newUser.password.length > 7 ||'la Contraseña debe tener almenos 8 caracteres']" 
                  counter
                  v-model="newUser.password"
                  outline
                  @click:append="passhow1 = !passhow1"
                ></v-text-field>
                </v-flex>
                <v-flex xs12 sm5 lg5 offset-sm1 offset-lg1>
                   <v-text-field
                  :append-icon="passhow2 ? 'visibility' : 'visibility_off'"
                  :type="passhow2 ? 'text' : 'password'"
                  label="Confirmar Contraseña"
                  hint="Escribe de nuevo tu contraseña"
                  :rules="[() => newUser.password == confirmpass || 'las contraseñas no coinciden']"
                  v-model="confirmpass"
                  counter
                  outline
                  @click:append="passhow2 = !passhow2"
                ></v-text-field>
                </v-flex>
                  <v-flex xs12 sm12 lg12>
                    <v-card-title primary-title>
                      <h4 class="headline mb-0">Datos del Domicilio</h4>
                    </v-card-title>
                  </v-flex>
                  <v-flex xs12 sm5 lg5>
                    <template v-if="newUser.id_localidad != 0">
                       <v-select
                        :items="localidades"
                        label="Localidad"
                        item-text = "name"
                        name="id_localidad"
                         required
                         :rules = "[() => !! newUser.id_localidad|| 'la localidad es requerido']"
                        v-model="newUser.id_localidad"
                        item-value = "id_localidad"
                      ></v-select>
                       </template>
                       <template v-else>
                        <v-text-field
                            required
                            :rules = "[() => !! newUser.namelocalidad || 'la localidad es requerido']"
                            v-model="newUser.namelocalidad"
                            class="mb10"
                            label="Otra localidad"
                            name="namelocalidad"
                            hint="Ingresa una localidad cercana a Alvaro Obregon.Mich">
                        </v-text-field>
                       </template>
                  </v-flex>
                  <v-flex xs12 sm6 lg6 offset-sm1 offset-lg1>
                    <v-text-field
                      class="textuper"
                      hint=""
                      v-model="newUser.calle"
                      label="Calle"
                      :rules = "[() => !!newUser.calle || 'la calle es requerido']"
                      outline>
                    </v-text-field>
                  </v-flex>
                  <v-flex xs12 sm5 lg5>
                    <v-text-field
                      v-model="newUser.referencia"
                      class="textuper"
                      hint="Referencia para identificar tu casa *Ejemplo: Casa rosa, porton negro , frente a un parque o escuela"
                      label="Referencia Domicilio"
                      outline>
                    </v-text-field>
                  </v-flex>
                  <v-flex xs12 sm3 lg3 offset-sm1 >
                    <v-text-field
                      prefix="#"
                      hint=""
                      v-model="newUser.numero_e"
                      label="Numero Exterior"
                      :rules = "[() => !!newUser.numero_e || 'el numero exterir es requerido']"
                      outline>
                    </v-text-field>
                  </v-flex>
                  <v-flex xs12 sm3 lg3 class="pading-left">
                    <v-text-field
                      prefix="#"
                      hint=""
                      label="Numero Interiror"
                      outline>
                    </v-text-field>
                  </v-flex>

                  <v-flex xs12 sm12 lg12 >
                    <div style="margin: 0px 0px 15px 12px; font-size: 15px;">¿ Entre que calles esta ? (opcional)</div>
                  </v-flex>
                  <v-flex xs12 sm5 lg5 >
                    <v-text-field
                      v-model="newUser.calle_1"
                      class="textuper"
                      hint=""
                      label="Calle 1"
                      outline>
                    </v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 lg6 offset-sm1 offset-lg1>
                    <v-text-field
                      v-model="newUser.calle_2"
                      class="textuper"
                      hint=""
                      label="Calle 2"
                      outline>
                    </v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-card-actions style ="margin-bottom:0">
                <v-layout row>
              <v-container>
                <div id="recaptcha-container"></div>
               <v-btn block style="background-color: #000 !important;" dark @click="validate()">Registrarme</v-btn>
             </v-container>
           </v-layout>
            </v-card-actions>
          </v-form>
        </v-container>
      </v-card>
    </v-flex>
          
      <v-dialog v-model="dialog" persistent max-width="400" class="size-dialog">
      <v-card>
        <!-- <v-card-title class="headline">Verifica tu Numero de telefono</v-card-title> -->
          <v-card-text>
            <div id="firebaseui-auth-container"></div>
            <!-- <input-otp></input-otp> -->
          </v-card-text>
        <!-- <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" flat @click="dialog = false">cerrar</v-btn>
        </v-card-actions> -->
      </v-card>
    </v-dialog>
     <v-snackbar
      v-model="snackbar"
      :color="configSnackbar.color"
      :timeout="configSnackbar.timeout"
      :top="configSnackbar.y === 'top'"
      :bottom="configSnackbar.y === 'bottom'"
    >
      {{ configSnackbar.text }}
      <v-btn
        dark
        flat
        @click="snackbar = false"
      >
        Close
      </v-btn>
    </v-snackbar>
  </v-layout>
</template>
<script>
import * as firebaseui from 'firebaseui'
import 'firebaseui/dist/firebaseui.css'

import firebase from 'firebase/compat/app';
      // authDomain: "mynegociolocal-ff456.firebaseapp.com",
      // storageBucket: "mynegociolocal-ff456.appspot.com",
      // messagingSenderId: "1065896843167",
      // appId: "1:1065896843167:web:91450dadf9ed723b0f8faa",
// apiKey: "AIzaSyAUhiNd9lLFuj7xDYbR4K9BZXaydWWSOd0",
      // measurementId: "G-YMZ8Z9T8E5"

firebase.initializeApp({
      apiKey: "AIzaSyDo-ZR5SUf-oOVuEmilXJZLheYgw2jhnNU",
      projectId: "mynegociolocal-ff456",
})
      
import axios from 'axios'
export default {
  data: () => ({    
    allow: ['gmail.com', 'hotmail.com', 'outlook.com', 'outlook.es'],
    snackbar: false,
    configSnackbar: {},
    dialog: false,
    ruta: url,
    localidades: [{name:'Alvaro Obregon',id_localidad: 1}, {name:'Singuio', id_localidad:2},{ name: 'el Zapote', id_localidad:3 },{name: '18 de Mayo',id_localidad:4},{name:'Zintzimeo' ,id_localidad:5},{name:'otra', id_localidad:0}],
    passhow1: false,
    passhow2: false,
    confirmpass: '',
    error: false,
    errortel: false,
    newUser: {
      name: 'alex dewitt',
      ubicacion: {lat: '', long: ''},
      email: 'alexdewitt005@hotmail.com',
      telefono: '4434126238',
      id_localidad: 2,
      password: 'alfa1*33',
      referencia: 'calle y un centro de salud',
      calle: 'venemerito',
      calle_1: 'rosalia',
      calle_2: 'chinito de china',
      numero_e: '13',
      numero_i: '',
      tel_verify: false
    },
    terminos: false,
    valid: true
  }),
  created () {
    window.eventBus.$on('toast', (data) => {
      this.snackbar = true
      this.configSnackbar = data
    })
    window.eventBus.$on('register', () => {
        // PONER EL CAMPO TELEFONO_CONFIRM PARA INSERTARLO A LA BASE DE DATOS
        this.dialog = false
        this.newUser.tel_verify = true
        this.register()
        //window.location.href=url;
    })
  },
  mounted() {
    if ("geolocation" in navigator){ 
          navigator.geolocation.getCurrentPosition((position) => { 
               this.newUser.ubicacion.lat = position.coords.latitude
               this.newUser.ubicacion.long = position.coords.longitude
          });
      }else{
        alert('no se puede obtener tu ubicacion intenta nuevamente con otro navegador')
      }
  },
  methods: {
    verificartelefono () {
        this.dialog=true
        const uiConfig = {
        callbacks: {
          signInSuccessWithAuthResult: function(authResult, redirectUrl) {
            window.eventBus.$emit('register')
            return false
          }
        },
        signInOptions: [{
            provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
            defaultCountry: 'MX',
            defaultNationalNumber: this.newUser.telefono,
          }
        ],
        tosUrl: '<your-tos-url>',
        // Privacy policy url/callback.
        privacyPolicyUrl: function() {
        
        }
      };
        //quitar en produccion
        const auth = firebase.auth()
        auth.useEmulator("http://127.0.0.1:9099")
        //hata aqui

        var ui = new firebaseui.auth.AuthUI(firebase.auth());
        ui.start('#firebaseui-auth-container', uiConfig)
    },
    validate () {
      if (this.$refs.formregister.validate()) {
          this.register();
      }else {
        window.scrollTo(0, 0)
      }
    },
    register () {
      axios.post(this.ruta + 'registrar', this.newUser).then((data) => {
        if (data.status == 200) {
            this.errortel = false
            this.error = false
            if ('email' in data.data.errors) {
              // this.$nextTick(()=>{
                this.$refs.emailregister.$refs.input.focus()
                this.error = true
              // })
            }

            if ('telefono' in data.data.errors) {
              this.$refs.telregister.$refs.input.focus()
              this.errortel = true
            }

            if(data.data.res == 'verify'){
             this.verificartelefono()
             // alert('correcto') 
            }
            //else{
              //window.location.href=url+'login'; 
            //}
        } else {
          alert('hubo un error')
        }
      }).catch((e) => {

        alert(e + 'revisa tu conexion a internet')
      
      })
   }
  } 
}
</script>
<style> 
.mb10 {
  margin-bottom: 15px;
}
.textuper input {
    text-transform: capitalize;
}
@media screen and (min-width: 300px) {
   .v-dialog{
     margin: 0 !important;
   }
}
@media screen and (min-width: 668px) {
   .pading-left{
    padding-left: 10px;
   }
}

/*.v-btn:not(.v-btn--depressed):not(.v-btn--flat) {
  background-color: #c9f0c9 !important;
}*/
</style>