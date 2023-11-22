<template>
	<b-row align-h="center" style="margin-top: 15px !important;">
    <b-col cols="12">
      <b-card no-body  style="background-color: #f5f5f5;">
        <b-row align-h="center" style="padding: 20px;">
          <b-col cols="2">
            <div  rounded="circle" class="white" style="height: 49px; width: 51px;"> 
            <span style="color:#3483fa;"><i class="fa fa-map-marker"></i></span>
            </div>
          </b-col>
          <b-col cols="10" style=" text-align: justify;font-size: 14px;">
            <span>{{dom.calle}}, <strong> Nº exterior:</strong> {{dom.numero_e}},  <strong> Nº interior:</strong> {{dom.numero_i}}  <strong> Entre:</strong> {{dom.calle_1}} - {{dom.calle_2}}
            localidad: {{dom.localidad}} (58920), Michoacán
           <strong> Recibe:</strong> {{dom.name}} - <strong>{{dom.referencia}}</strong></span>
          </b-col>
        </b-row>
      </b-card>
    </b-col>

      <b-row style="margin-top: 4% !important; width: 100%; margin-bottom: 20px !important;" class="d-lg-block">
        <b-col cols="12" v-if="status==1" style="text-align: end;">
            <b-button variant="primary" @click="autorizar_envio()" >Autorizar envio</b-button>
        </b-col>
        <b-col v-if="status==2" cols="12" style="text-align: center;">
            <b-alert show  variant="primary">Pedido Autorizado</b-alert>
            <b-button variant="primary" style="margin-top: 2px;" >Marcar como Entregado?</b-button>
        </b-col>
        <b-col v-if="status==3" cols="12" style="text-align: center;">
            <b-alert show  variant="success">Pedido Entregado</b-alert>
        </b-col>
        <b-col v-if="status==4" cols="12" style="text-align: center;">
            <b-alert show  variant="danger">Pedido Cancelado</b-alert>
        </b-col>
      </b-row>
      <!-- {lat:19.8243877, lng:-101.0424186} -->
<GmapMap
  :center="markers[0].position"
  :zoom="16"
  map-type-id="terrain"
  style="width: 500px; height: 300px"
>
  <GmapMarker
    v-for="(m, index) in markers"
    :clickable="true"
    :key="index"
    :position="m.position"
     @click="toggleInfoWindow(m,index)"
    title="Direccion de usuario"

  />
   <gmap-info-window
                :options="infoOptions"
                :position="infoPosition"
                :opened="infoWinOpen"
                @click="infoWinOpen=!infoWinOpen">
                 <div v-html="infoContent"></div>
      </gmap-info-window>
    <!-- :draggable="true" -->
</GmapMap>

  </b-row> 
</template>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKiIqCdZGrVxx06LSbe7uG3zXOq1Cz5k&callback=initMap"></script>
<script type="text/javascript">

  export default {
    props:['dom', 'idventa', 'estatus', 'iduser'],
		 data() {  	
      return {
      infoPosition: null,
      infoContent: null,
      infoOpened: false,
      infoCurrentKey: null,
      infoWinOpen: false,
      status: 0,
      infoOptions: {
        pixelOffset: {
          width: 0,
          height: -35
        }
    },
      markers: [
          {
            name: "House of Aleida Greve",
            description: "description 1",
            date_build: "",
            position: {lat:19.814549397381057, lng:-101.05552615064376}
        }
      ]
      }
    },
    created () {
      this.status = this.estatus
    },
		methods: {
      autorizar_envio(){
      let formd= new FormData()
      formd.append('id_venta', this.idventa)
      formd.append('id_usuario', this.iduser)
      axios.post(url+"autorizarpedido", formd).then(data => {
        if(data.status==200){        
          alert('¿se Autorizo el envio del Pedido: '+this.iduser+' '+this.idventa)
          this.status=2;
        }else{
          alert('¡hubo un error!')
        }
      }).catch(error => {
             console.log(error)
      });
      },
      toggleInfoWindow: function (marker, idx) {
        this.infoWindowPos = marker.position;
        this.infoContent = this.getInfoWindowContent(marker)
        
        //check if its the same marker that was selected if yes toggle
        if (this.currentMidx == idx) {
          this.infoWinOpen = !this.infoWinOpen
        }
        //if different marker set infowindow to open and reset current marker index
        else {
          this.infoWinOpen = true
          this.currentMidx = idx
        }
      },

      getInfoWindowContent: function (marker) {
            return (`<div class="card">
      <div class="card-image">
        <figure class="image is-4by3">
          <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
        </figure>
      </div>
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <p class="title is-4">${marker.name}</p>
          </div>
        </div>
        <div class="content">
          ${marker.description}
          <br>
          <time datetime="2016-1-1">${marker.date_build}</time>
        </div>
      </div>
    </div>`)
          }
		}
	}

</script>