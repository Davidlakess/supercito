<template>		
      <div v-if="isMobil" >  
        <detalle-mobil 
          :características="características"
          :producto="producto"
          :extras="extras"
          :logeado="logeado"
        ></detalle-mobil>
    </div>
      <div v-else class="ancho-ideal" >  
        <productos-detalleweb
          :producto="producto"
          :nav="nav"
          :caracter="características"
          :extras="chunk(extras,4)"
          :logeado="logeado"
        ></productos-detalleweb>
      </div>

</template>
<script>
    import detalleweb from './producto_detalle_web.vue'
    import detallemobil from '../mobile/productos_detalle_mobil.vue'
  export default {
    components:{
    'productos-detalleweb':detalleweb,
    'detalle-mobil':detallemobil
    },
    props:[
    'producto',
    'extras',
    'logeado',
    'nav',
    'características',
    ],
    data() {
      return {
          btnshow:false,
          fields: ['clave', 'valor'],
          ruta:url,
      }
    },
    computed:{
      getimgs(){
        return this.producto.imgs.split(',');
      },
      isMobil() {
        return window.isMobil()
      }
    },
    methods: {
      chunk(array,chunkSize){
        var R = [];
        for (var i = 0; i < array.length; i += chunkSize)
          R.push(array.slice(i, i + chunkSize));
        return R;
      },
       rowClass(item, type) {
        if (!item || type !== 'row') return
        if (item.status === 'awesome') return 'table-success'
      },
         reverse_array(array){
          console.log(array)
          if(array){
            return array.reverse();
          }else{
            return array;
          }
        },
      formaturl(value,id){
        let result=this.ruta+'c/'+value+'/'+id;
        return result;
    },
	// 
 //           ,{
 //            id:"1",
 //            name:"Coca Cola 3 litros",
 //            precio:11,
 //            img:"1588289993_coca-3lt.jpg",
 //            raiting:5
 //          }
 //           ,{
 //            id:"1",
 //            name:"Higienico Big roll",
 //            precio:42,
 //            img:"1595713334_bigroll.jpg",
 //            raiting:5
 //          }
    }
  }
</script>
<style>
.content-descripcion{
  color: #666;
  font-size: 20px;
  font-weight: 400;
  word-break: break-word;
  margin-top: 20px;
  /*line-height: 33pt;*/
  text-align: left;
}
.indexm{
  z-index: 1025;
}
.ul-car{
  display:flex ;
  font-size: 16px;
  list-style: none;
  flex-wrap: wrap;
  padding: 0;
}
.card-detalle-producto .card-body{

  height: 500px;
  max-height: 500px;
}
</style>