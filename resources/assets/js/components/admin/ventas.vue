<template>
	<div>
		<div class="text-justify" style="margin-bottom: 15px;">
			<span style="font-size:25px; font-weight: bold;">Listado de Ventas</span>
		</div>
		<div class="row">
		  <div class="col">
		    <div class="card">
		      <div class="card-body">					
				<c-table :headers="headers">
			    <tr v-for="venta in paginatedItems">
			      <td>{{venta.name}}</td>
			      <td>
			      	<span>{{venta.calle}} #{{venta.numero_e}} Cel: {{venta.telefono}}</span>
			      </td>
		   		 	<td>
		  		 	    <b-badge pill :variant="get_variante(venta.status)">{{get_Estatus(venta.status)}}</b-badge></td>  
		  	   	<td>
			      	<!-- 
			      	<b-button v-if="venta.status==1" v-b-modal.modal-1 pill variant="success"  v-b-tooltip.hover title="Marcar como Entregada"><i 	class="fa fa-check text-withe"></i>
			      	</b-button> -->

			      	<b-button  v-b-modal.modal-1 pill variant="primary" :href="'pedido/'+venta.id_venta"  v-b-tooltip.hover title="Detalle de Venta"><i class="fa fa-eye text-withe"></i>
			      	</b-button>

			    	</td>
			    </tr>
				</c-table>		 
				<b-col col="12"  class="my-1" style="display: block ruby;text-align:end;">
		      <b-pagination
		        @change="onPageChanged"
		        :total-rows="totalRows"
		        :per-page="perPage"
		        v-model="currentPage"
		        class="my-0"
		      />
		    </b-col>   
	    </div>
			</div>
		  </div>
		</div>
	</div>	
</template>
<script type="text/javascript">
	export default {
		 data() {  	
      return {
      ventas:[],
    	paginatedItems:[],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
    	headers: [
          {
            text: "Nombre"
          },
          {
            text: "Domicilio"   
          },
          {
            text: "Estatus"   
          },
          {
            text: "Accion"
          }
        ]
      }
    },
    mounted() {
	    this.getventas();
    },
    created() {
        
    },
		methods: {
			get_variante(estatus){

		  	switch (estatus) {
		  		case 1:
		  			return "warning"
		  			break;
		  		case 2:
		  			return "primary"
		  			break;
		  		
		  		case 3:
		  			return "success"
		  			break;
		  		case 4:
		  			return "danger"
		  			break;
		  		}
			},
		  getventas(){
				axios.post("getventas").then(data => {
          this.ventas=data.data;
          this.paginatedItems= this.ventas;
          this.totalRows= this.paginatedItems.length;
	    		this.paginate(this.perPage, 0);
        }).catch(error => {
             console.log(error);  
        });		  
		  },
		  
		paginate(page_size, page_number) {
	        let itemsToParse = this.ventas;
	        this.paginatedItems = itemsToParse.slice(
	          page_number * page_size,
	          (page_number + 1) * page_size
	        );
      },
      onPageChanged(page) {
        this.paginate(this.perPage, page - 1);
      },
		  formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
		  get_Estatus(estatus){
		  	
		  	switch (estatus) {
		  		case 1:
		  			return "Pendiente"
		  			break;
		  		case 2:
		  			return "Enviado"
		  			break;
		  		
		  		case 3:
		  			return "Entregado"
		  			break;
		  		case 4:
		  			return "Cancelado"
		  			break;
		  		
		  			
		  	}

		  }
		}
	}

</script>
