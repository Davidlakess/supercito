
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
Vue.component('component-resumen', require('./components/admin/Ventas/componet_resumen.vue').default);
Vue.component('component-direccion', require('./components/admin/Ventas/component_direccion.vue').default);
Vue.component('component-detalle-producto', require('./components/admin/Ventas/component_detalle_productos.vue').default);

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
});