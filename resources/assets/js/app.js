
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import  BootstrapVue from 'bootstrap-vue'
import VueSweetalert2 from "vue-sweetalert2"
import Vue from 'vue' 
window.moment = require('moment')
const swal = window.swal = require('sweetalert2')
Vue.component('telefono', require('./componentes/verifyphone.vue').default)
// Vue.component('register', require('./components/auth/register.vue').default)
Vue.component('usuarios', require('./components/admin/usuarios.vue').default)
Vue.component('c-table', require('./components/c-table.vue').default)
Vue.component('ventas', require('./components/admin/ventas.vue').default)
Vue.component('productos-admin', require('./components/admin/productos/productos_admin.vue').default)
Vue.component('categorias', require('./components/admin/categrias.vue').default)
Vue.component('component-resumen', require('./components/admin/Ventas/componet_resumen.vue').default)
Vue.component('component-direccion', require('./components/admin/Ventas/component_direccion.vue').default)
Vue.component('component-detalle-producto', require('./components/admin/Ventas/component_detalle_productos.vue').default)



// APP
Vue.component('a-img', require('./components/generico/a_img.vue').default)
Vue.component('navbar-mobil', require('./components/mobile/navbar_mobil.vue').default);
Vue.component('logo-app', require('./components/generico/logo_app.vue').default);
Vue.component('welcome', require('./components/welcome.vue').default);
Vue.component('input-search', require('./components/Generico/input_search.vue').default);
Vue.component('select-categoria', require('./components/categorias/lista_categoria.vue').default);
Vue.component('producto-detalle', require('./components/productos/producto_detalle.vue').default);

Vue.component('carousel', require('./components/mycarousel.vue').default);
Vue.component('carousel-mini', require('./components/Generico/carousel/carousel_mini.vue').default);
Vue.component('carousel-slider-mini', require('./components/Generico/carousel/carousel_slider_mini.vue').default);
Vue.component('producto-card-btn', require('./components/Generico/producto_card_btn.vue').default);
Vue.component('producto-card-btn', require('./components/Generico/producto_card_btn.vue').default);
Vue.component('wishlist', require('./components/generico/wishlist.vue').default);
Vue.component('wishview', require('./components/generico/wishview.vue').default);
Vue.component('btn-addcarrito', require('./components/Generico/btn_addcarrito.vue').default);
Vue.use(BootstrapVue)
import * as VueGoogleMaps from 'vue2-google-maps'
 
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k',
    libraries: 'places',
  },
})

const app = new Vue({
    el: '#app',
    methods:{
      logout(){
        document.getElementById('logout-form').submit();
      },
      isMobil() {
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
             return true
           } else {
             return false
           }
      }
    }
});