<template>
	<div>
		<div class="text-justify" style="margin-bottom: 15px;">
			<span style="font-size:25px; font-weight: bold;">Listado de Productos</span>
		</div>
		<div class="row">
		  <div class="col">
		    <div class="card">
		      <div class="card-body">					
				<c-table :headers="headers">
			    <template v-for="item in paginatedItems">
				    <tr>
					    <td class="upcasa">{{item.name}}</td>
					    <td>${{item.precio}}</td>
					    <td>{{item.stock}}</td>
					    <td>{{(item.status==1)?'Activo':'Pausado'}}</td>
				  	   	<td>
					      	<b-button  
					      	v-b-modal.modal-xl
					      	pill 
					      	variant="primary"  
					      	v-b-tooltip.hover 
					      	title="Editar Producto"><i class="fa fa-eye text-withe"></i>
					      	</b-button>
					    </td>
				    </tr>
			    </template>
				
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
		<b-modal 
			id="modal-xl" 
			size="xl" 
			title="Detalle de Producto">
			Hello Extra Large Modal!
		</b-modal>
	</div>	
</template>
<script type="text/javascript">
	export default {
		 props:['productos'],
		 data() {  	
      return {
      paginatedItems:[],
      currentPage: 1,
      perPage: 25,
      totalRows: 0,
    	headers: [
          {
            text: "Nombre"
          },
          {
            text: "Precio"   
          },
          {
            text: "Existencia"   
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
    	this.paginarProductos()
    },
	methods: {
		paginarProductos(){
	          	this.paginatedItems= this.productos;
	          	this.totalRows= this.paginatedItems.length;
		    	this.paginate(this.perPage, 0);	        
	    },
	    paginate(page_size, page_number) {
	        let itemsToParse = this.productos;
	        this.paginatedItems = itemsToParse.slice(
	          page_number * page_size,
	          (page_number + 1) * page_size
	        );
      	},
      	onPageChanged(page) {
	        this.paginate(this.perPage, page - 1);
      	},
	}
}

</script>
<style>
	.upcasa{
		text-transform: uppercase;
	}
</style>