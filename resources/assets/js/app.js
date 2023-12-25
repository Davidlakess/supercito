
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');          
import  BootstrapVue from 'bootstrap-vue'
import VueSweetalert2 from "vue-sweetalert2"
import Vue from 'vue' 
window.eventBus = new Vue()
import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)
import autocomplete from '@trevoreyre/autocomplete-vue'
Vue.use(autocomplete)
window.moment = require('moment')
const swal = window.swal = require('sweetalert2')

window.formatPrice = function (value) {
  let val = (value / 1).toFixed(2).replace(',', '.')
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}
window.isMobil = function () {
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
             return true
           } else {
             return false
           }
      }

// Vue.component('register', require('./components/auth/register.vue').default)
// Vue.component('usuarios', require('./components/admin/usuarios.vue').default)
// Vue.component('c-table', require('./components/c-table.vue').default)
// Vue.component('ventas', require('./components/admin/ventas.vue').default)
// Vue.component('productos-admin', require('./components/admin/productos/productos_admin.vue').default)
// Vue.component('categorias', require('./components/admin/categrias.vue').default)
// Vue.component('component-resumen', require('./components/admin/Ventas/componet_resumen.vue').default)
// Vue.component('component-direccion', require('./components/admin/Ventas/component_direccion.vue').default)
// Vue.component('component-detalle-producto', require('./components/admin/Ventas/component_detalle_productos.vue').default)



// APP
Vue.component('a-img', require('./components/generico/a_img.vue').default)
Vue.component('logo-app', require('./components/generico/logo_app.vue').default);
Vue.component('s-footer', require('./components/generico/footer.vue').default);
Vue.component('welcome', require('./components/welcome.vue').default);
Vue.component('input-search', require('./components/Generico/input_search.vue').default);
Vue.component('wishview', require('./components/generico/wishview.vue').default);
Vue.component('btn-addcarrito', require('./components/Generico/btn_addcarrito.vue').default);
Vue.component('compras', require('./components/compras/compras.vue').default);
Vue.component('register', require('./components/auth/register.vue').default)
Vue.component('perfil', require('./components/perfil.vue').default);
Vue.component('select-categoria', require('./components/categorias/lista_categoria.vue').default);
Vue.component('producto-carousel', require('./components/Generico/producto_carousel.vue').default)
Vue.component('wishlist', require('./components/generico/wishlist.vue').default);
Vue.component('producto-detalle', require('./components/productos/producto_detalle.vue').default);
Vue.component('notifications', require('./components/notificacion/notifications.vue').default);
Vue.component('buscar-producto', require('./components/productos/buscar_producto.vue').default);
Vue.component('verificar-email', require('./components/generico/verificar_correo.vue').default);
Vue.component('message-error-busqueda', require('./components/Generico/message_error_busqueda.vue').default);
Vue.component('table-carrito', require('./components/carrito/table-carrito.vue').default)
Vue.component('resumen-compra', require('./components/checkout/resumen_compra.vue').default);
Vue.component('items-pagar', require('./components/checkout/items_pagar.vue').default);
Vue.component('item-pagar', require('./components/checkout/item_pagar.vue').default);
Vue.component('detalle-compra', require('./components/compras/detalle_compra.vue').default);
Vue.component('ckeckoutmobil', require('./components/mobile/ckeckoutmobil.vue').default);
Vue.component('wiewpagar', require('./components/viewpagar.vue').default);
Vue.component('productocategoria', require('./components/productos/producto_por_categoria.vue').default);

// detalle
// Vue.component('carousel', require('./components/mycarousel.vue').default);
// Vue.component('carousel-mini', require('./components/Generico/carousel/carousel_mini.vue').default);
// Vue.component('carousel-slider-mini', require('./components/Generico/carousel/carousel_slider_mini.vue').default);

// Vue.component('producto-card-btn', require('./components/Generico/producto_card_btn.vue').default);
// Vue.component('producto-card-btn', require('./components/Generico/producto_card_btn.vue').default);
// Vue.component('s-carousel-item', require('./components/Carousel/carousel_generico.vue').default);
// Vue.component('s-carousel-item-slide', require('./components/Carousel/carousel_item_slider.vue').default);
// Vue.component('s-carousel', require('./components/Carousel/carousel.vue').default)
// Vue.component('s-carousel-slide', require('./components/Carousel/carousel_slide.vue').default)
// Vue.component('listar-categorias', require('./components/categorias/listar_categorias.vue').default); 
// Vue.component('producto-solo', require('./components/categorias/producto_solo.vue').default);
// Vue.component('productos-extra', require('./components/categorias/productos_extra.vue').default);

// Vue.component('child-categoria-producto', require('./components/categorias/child_categoria_producto.vue').default);

// Chekout
// Vue.component('registrodomicilio', require('./components/checkout/registrodomicilio.vue').default);
// Vue.component('content-domicilio', require('./components/checkout/content_domicilio.vue').default);

Vue.component('all-categorias', require('./components/categorias/all_categorias.vue').default)

Vue.use(BootstrapVue)
import * as VueGoogleMaps from 'vue2-google-maps'
 const toast = window.toast= swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
Vue.use(VueGoogleMaps, {
  load: {
    key: process.env.VUE_APP_APY_GOOGLE,
    libraries: 'places',
  },
})
console.log(process.env.NODE_ENV)
const app = new Vue({
    el: '#app',
    methods:{
      logout(){
        document.getElementById('logout-form').submit();
      }
    }
});