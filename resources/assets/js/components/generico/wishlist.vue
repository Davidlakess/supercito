<template>
  <div>	
  	  <div v-if="logeado" >	

		  <span class="wish-icon" v-if="isactive" v-b-tooltip.hover title="Eliminar de tu lista de favoritos" @click="removewhislist">
		   <i class="fa fa-heart wish-clase" ></i>
		  </span>

		  <span  v-else class="wish-icon"   v-b-tooltip.hover title="Agregar a tu lista de favoritos" @click="addwhislist" >
		   <i class="fa fa-heart-o wish-clase" ></i>
		  </span>
		  
  	  </div>

  	  <div v-else>	
	  <span class="wish-icon" v-b-tooltip.hover title="Agregar a tu lista de favoritos">
	  	<a href="/middlewishlist">
	   <i class="fa fa-heart-o wish-clase"></i>
	  	</a>
	  </span>
  	  </div>	
  </div>

</template>
<script type="text/javascript">
	export default {
		props:['idproducto','logeado','active'],
		data(){
			return {
				isactive:false
			}
		},
		mounted (){
				this.isactive=(this.active!=null)?true:false;
		},
	methods:{

		removewhislist(){

// const toast = swal.mixin({
// 	            toast: true,
// 	            position: 'top-end',
// 	            showConfirmButton: false,
// 	            timer: 3000
// 	          });
         
		
		    	axios.post(url+"delfavoritos",{id:this.idproducto}).then(data => {
		          
		          if(data.status=200){
		
					this.isactive=false;
		          
		          }else{

		            toast.fire({
		              icon:'Ooops!',
		              title: 'Algo Salio Mal!'
		            })
		          
		          }
		      
		        }).catch(error => {
		          // console.log(error);  
		          toast.fire({
		            icon:'error',
		            title: 'No Se Pudo Realizar la Accion!'
		          })
		        
		        });
	
		},
		addwhislist(){
	

			const toast = swal.mixin({
	            toast: true,
	            position: 'top-end',
	            showConfirmButton: false,
	            timer: 3000
	          });
         
		    	axios.post(url+"addfavoritos",{id:this.idproducto}).then(data => {
		          
		    		// console.log(data);
		          if(data.status=200){
		        		toast.fire({
		              icon:'success',
		              title: '¡Exito! Agregado Tus Favoritos'
		            })
								this.isactive=true;
		          }else{

		            toast.fire({
		              icon:'error',
		              title: 'Ooops! Algo Salio Mal!'
		            })
		          
		          }
		      
		        }).catch(error => {
		          // console.log(error);  
		          toast.fire({
		            icon:'error',
		            title: 'No Se Pudo Realizar la Accion!'
		          })
		        
		        });
	
		}
	}
}
</script>
<style>	
.wish-clase{
	color: red !important; cursor: pointer;
	z-index: 1024;
}
</style>