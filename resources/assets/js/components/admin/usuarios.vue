<template>
	<div>
		<div class="text-justify" style="margin-bottom: 15px;">
			<span style="font-size:25px; font-weight: bold;">Listado de Usuarios</span>
		</div>
		<div class="row">
		  <div class="col">
		    <div class="card">
		      <div class="card-body">	
				<div style="text-align: end; margin-bottom: 7px;">
					
		      <b-button v-b-modal.modal-1 pill variant="success" v-b-tooltip.hover title="Nuevo Usuario"><i class="fa fa-plus"></i></b-button>

				  <b-modal id="modal-1" hide-footer title="Nuevo Usuario">
				  	<add-usuario></add-usuario>
				  </b-modal>
				</div>
				
				<c-table :headers="headers">
			    <tr v-for="usuario in usuarios">
			      <td>{{usuario.name}}</td>
			      <td>{{usuario.email}}</td>
			      <td>{{format_idrol(usuario.role_id)}}</td>
			      <td>
			      	<b-button v-b-modal.modal-1 pill  v-b-tooltip.hover title="Editar Usuario"><i class="fa fa-edit text-withe"></i></b-button>
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
      	perPage: 5,
      	totalRows: 0,
    	usuarios:[],
    	headers: [
          {
            text: "Nombre"
          },
          {
            text: "Email"
            
          },
          {
            text: "Rol"   
          },
          {
            text: "Accion"
          }
        ]
      }
    },
    mounted() {
    this.getusers();
    },
    created() {
        
    },
	methods: {
	    getusers(){
	    	axios.post("getusers").then(data => {
          this.usuarios=data.data;
          this.paginatedItems= this.usuarios;
          	this.totalRows= this.paginatedItems.length;
	    	this.paginate(this.perPage, 0);
          // console.log(data.data)
        }).catch(error => {
             console.log(error);  
        });
	    },
	    paginate(page_size, page_number) {
	        let itemsToParse = this.usuarios;
	        this.paginatedItems = itemsToParse.slice(
	          page_number * page_size,
	          (page_number + 1) * page_size
	        );
      },
      onPageChanged(page) {
        this.paginate(this.perPage, page - 1);
      },
	    format_idrol(idrol){
	    		switch (idrol) {
	    			
	    			case 1:
	    				return "USUARIO"
	    			break;
	    			
	    			case 2:
	    				return "Repartidor"
	    			break;
	    			
	    			case 4:
	    				return "Admin"
	    			break; 
	   	 }
	    }
		}
	}

</script>
