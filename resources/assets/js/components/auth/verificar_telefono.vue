<template>
  <b-form method="POST" action="/" @submit.prevent="smssend()">
    <b-row align-h="center">
      
      <b-col cols="12" v-if="btn">
        <b-form-group label="verificar tu numero de telefono" label-for="code_confirm">
          <b-form-input type="text"
            name="token" required
            autofocus
            v-model="code"
            placeholder="Ingresa aqui Codigo de Verificacion">
          </b-form-input>
        </b-form-group>
        <b-form-group class="text-center">
          <b-button type="submit" :disabled="disable" v-show="btn"   variant="primary">
                  Validar
          </b-button>
        </b-form-group>
      </b-col>
      <b-col cols="12" v-show="captcha" style="display: contents;">
          <div style="text-align: center; font-size: 19px; font-weight: 400;margin-bottom: 22px;"><span>Se enviara un codigo de verificacion a tu telefono.</span></div>
          <div id="recaptcha-container"></div>
      </b-col>

    </b-row>
  </b-form>
</template>
<!-- <script async="" defer="" src="https://www.google.com/recaptcha/api.js"></script> -->
<script type="text/javascript">
  import {initializeApp} from 'firebase/app'
import { getAuth, RecaptchaVerifier, signInWithPhoneNumber } from "firebase/auth"
export default {
    props:['telefono','email'],
	  data() {  	
			return {
        code: '',
        captcha:true,
        btn:false,
        disable:false
			}
	},
	mounted() {

      const app= initializeApp({
        'messagingSenderId': '1065896843167',
        'projectId': 'mynegociolocal-ff456',
        'apiKey': 'AIzaSyCBZnLrRL9y6bI48Spxsr0f1O3nUqrSCpg',
        'appId': '1:1065896843167:web:91450dadf9ed723b0f8faa'
      })
      window.auth=getAuth(app);

          this.solvedcaptcha()
	},
	methods: {
    solvedcaptcha(){
      
      // const phoneNumber = '+16505553434'
      const phoneNumber = this.telefono;
      window.auth.settings.appVerificationDisabledForTesting = false;
      window.auth.languageCode = 'es';
      
      window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {}, window.auth);
      
      signInWithPhoneNumber(window.auth, phoneNumber, window.recaptchaVerifier)
        .then((confirmationResult) => {

            this.btn = true;
            this.captcha = false
            window.confirmationResult=confirmationResult;
            // console.log('mensaje enviado');
      
      }).catch((error) => {

            this.btn = false;
            this.captcha = true
        // grecaptcha.reset(window.recaptchaWidgetId);
        // console.log('mensaje no enviado',error)
      
      });

      console.log(window.recaptchaVerifier);


      // window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
      //         'size': 'normal',
      //         'callback': (response) => {
      //           console.log('recapcha solved');
      //         },
      //         'expired-callback': () => {
      //           console.log('recapcha expired');
      //         }
      //       }, window.auth);
    },
    smssend(){
        this.disable=true;
        window.confirmationResult.confirm(this.code).then((result) => {
          swal.fire(
            '¡Verificación Exitosa!',
            '',
            'success'
            )
            axios.post(url+"api/authorization/telephone",{email:this.email,code:this.code}).then(data => {
                  
                  if(data.status==200){
                      window.location.href=url; 
                  }

              }).catch(error => {
                this.disable=false;
                swal.fire(
                  'Verifica tu conexion',
                  'Intenta nuevamente',
                  'error'
                )          
              }); 
        }).catch((error) => {
          this.disable=false;
          swal.fire(
            'Codigo Incorrecto',
            'Intenta nuevamente',
            'error'
          )
          // this.solvedcaptcha()
          // window.recaptchaVerifier.render().then(function(widgetId) {
        });
    }
	}
}
</script>