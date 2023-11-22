<template>
  <b-col cols="12">
    <b-col cols="12">
          <div style="margin-top: 20px; font-size: 20px; font-weight: 600;"> 
            <span>  Compra #{{idventa}} -</span> <span style="font-size: 20px;font-weight: 600;">{{ getfecha()}}</span>
          </div>
    </b-col>
      <b-col cols="12" style="margin-bottom: 10px;"> 
        <div style="display: grid;"> 
        <span><strong>Cliente: </strong> Alejandro David Gaytan Sanchez</span>
        <span><strong>Forma de pago: </strong> Efectivo</span>
        <span><strong>Tipo de entrega: </strong> A Domicilio</span>
        <span><strong>Fecha aproximada de entrega: </strong>{{getformatofecha ('2023-06-27 18:30:21')}} </span>
        </div>
      </b-col>
    <b-card no-body class="text-justify" style="background-color: #f5f5f5; z-index: -1;" > 
      <b-container style="margin-top: 20px; padding-right: 30px;padding-left: 30px;">
        <span style="margin-bottom: 20px; font-weight: 600;"> Resumen de Pedido</span>
        <hr>
        <b-row>
          <b-col cols="7" lg="6" class="mb-10">
            <span>Productos</span>
          </b-col>
          <b-col cols="5 tl-end" lg="6">
            <span>${{formatPrice(total)}}</span>
          </b-col>
          <b-col cols="6" class="mb-10">
            <span>Cargo de envío</span>
          </b-col>
          <b-col cols="6 tl-end" >
            <span>${{formatPrice(envio)}}</span>
          </b-col>
          <b-col cols="6" class="mb-10">
            <span>Propina</span>
          </b-col>
          <b-col cols="6 tl-end" >
            <span>${{formatPrice(propina)}}</span>
          </b-col>
          <b-col cols="6" class="mb-10 mt-22">
            <span>Pago Total</span>
          </b-col>
          <b-col cols="6 tl-end mt-22" >
            <span>$ {{formatPrice(grantotal)}}</span>
          </b-col>
        </b-row>
      </b-container>
    </b-card>
  </b-col>
</template>
<script type="text/javascript">
	export default {
    props:['envio','items','fecha','idventa','propina'],
		 data() {  	
      return {
      	domicilio:[],
        total:0,
        grantotal:0
      }
    },
    mounted() {
      this.sumarproductos();
      this.grantotal=parseFloat(this.total)+parseFloat(this.envio)+parseFloat(this.propina)
    },
		methods: {
      formatPrice (value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
      getfecha () {

        moment.locale('es');
        return  moment(this.fecha).format('dddd LL');
      },
      getformatofecha (fecha) {
        moment.locale('es');
        return  moment(fecha).format('dddd LL, h:mm:ss a');
      },
      sumarproductos () {
        var size =this.items.length;
        var suma=0;
        // console.log(this.items)
        var i=0;
        for(i;i<size;i++){
        
          suma += parseFloat(this.items[i].cantidad) * parseFloat(this.items[i].precio); 
        }

        this.total=suma;
      }
		}
	}

</script>