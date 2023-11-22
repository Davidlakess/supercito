<template>
	<div>
		<div class="text-justify" style="margin-bottom: 15px;">
			<span style="font-size:25px; font-weight: bold;">Listado de Categorias</span>
		</div>
		<div class="row">
		  <div class="col">
		    <div class="card">
		      <div class="card-body">	
						<div style="text-align: end; margin-bottom: 7px;">
				      <b-button v-b-modal.modal-1 pill variant="success" v-b-tooltip.hover title="Nueva Categoria"><i class="fa fa-plus"></i></b-button>
						  <b-modal id="modal-1"  hide-footer title="Nueva Categoria">
						    <add-categoria></add-categoria>
						  </b-modal>
						</div>
						<c-table :headers="headers">
					    <tr v-for="categoria in paginatedItems">
					      <td>{{categoria.name}}</td>
					      <td>{{get_estatus(categoria.status)}}</td>
					      <td>
					      	<b-button v-b-modal.modal-1 pill  v-b-tooltip.hover title="Editar Categoria"><i class="fa fa-edit text-withe"></i></b-button>
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
      	paginatedItems:[],
	  	currentPage: 1,
	  	perPage: 10,
	  	totalRows: 0,
    	categorias:[],
    	headers: [
          {
            text: "Nombre"
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
    this.getcategorias();
    },
    created() {
        
    },
	methods: {
	    getcategorias(){
	    	axios.post("api/getcategorias").then(data => {
          	this.categorias=data.data;
            this.paginatedItems= this.categorias;
          	this.totalRows= this.paginatedItems.length;
	    	this.paginate(this.perPage, 0);
          // console.log(data.data)
        }).catch(error => {
             console.log(error);  
        });
	    },
	    get_estatus(estatus){
	    		switch (estatus) {
	    			
	    			case 1:
	    				return "Activa"
	    			break;
	    			
	    			case 2:
	    				return "InActiva"
	    			break;
	    			
	   	 }
	    },
	    paginate(page_size, page_number) {
	        let itemsToParse = this.categorias;
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
