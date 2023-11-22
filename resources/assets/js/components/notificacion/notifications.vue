<template>
	<div v-if="isMobile()" style="display: flex; margin-top: 10px; margin-bottom: 10px;">
          <span><i class="fa fa-bell"></i>(2)</span>
            <b-nav-item-dropdown  right>
           		<ul class=" notify-drop">
				        <div class="notify-drop-title">
				          <div class="row">
				            <div class="col-md-6 col-sm-6 col-xs-6">Notificaciones</div>
				            <div class="col-md-6 col-sm-6 col-xs-6 text-right"></div>
				          </div>
				        </div>
				        <div class="drop-content">
				          	<template v-if="items">
					          <li class="notify-custom" style="border-bottom: 1px solid #d1d1d1;"  v-for="item in items">
					            <div class="col-md-3 col-sm-3 col-xs-3">
					            	 <figure class="card card-produc">
					            	<div class="img-wrapp"> 
					                      <img :src="'/uploads/'+item.img" alt="imagen">
					                </div>
					              </figure>
					            </div>
					            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><span>{{item.titulo}}</span>    
					            <p class="time" style="margin-top: 10px">Justo Ahora</p>
					            </div>
					          </li>
				          	</template>
				            <template  v-else>
								<div>		
						          <li style="text-align: center;margin-top: 10px;">
						            <span>No hay Notificaciones</span>
						          </li>
								</div>
							</template>
				        </div>
				        <div class="notify-drop-footer text-center">
				          <a href=""><i class="fa fa-eye"></i>Ver todo</a>
				        </div>
	      </ul>
	 </b-nav-item-dropdown>
	 </div>

	 	<div v-else v-on:mouseover="mouseover"  v-on:mouseleave="mouseleave">
		<b-nav-item >
		  <li class="dropdown" style="margin-right: 14px;font-size: 19px;margin-top: -3;">
	        <i class="fa fa-bell"></i>
	      <ul :class="'dropdown-menu notify-drop '+clase" style="left: -313px;">
	        <div class="notify-drop-title">
	          <div class="row">
	            <div class="col-md-6 col-sm-6 col-xs-6">Notificaciones</div>
	            <div class="col-md-6 col-sm-6 col-xs-6 text-right"></div>
	          </div>
	        </div>
			<div class="drop-content">
	          
	          <template v-if="items">
	          <li class="notify-custom" style="border-bottom: 1px solid #d1d1d1;"  v-for="item in items">
	            <div class="col-md-3 col-sm-3 col-xs-3">
	            	 <figure class="card card-produc">
	            	<div class="img-wrapp"> 
	                      <img :src="'uploads/'+item.img" alt="imagen">
	                </div>
	              </figure>
	            </div>
	            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><span>{{item.titulo}}</span>    
	            <p class="time" style="margin-top: 10px">{{ago(item.fecha)}}</p>
	            </div>
	          </li>
	        </template>
			
			<template  v-else>
			<div>		
	          <li class="text-center">
	            <span>No hay Notificaciones</span>
	          </li>
			</div>

			</template>
	        </div>
	        <div class="notify-drop-footer text-center">
	          <a href=""><i class="fa fa-eye"></i>Ver todo</a>
	        </div>
	      </ul>
	    </li>
	  </b-nav-item>
	</div>
<!-- </div> -->
</template>
<style> 
.card-produc:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden; 
  }
  .card-produc .img-wrapp {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 50px !important;
    text-align: center; 
  }
    .card-produc .img-wrapp img {
      max-height: 100%;
      max-width: 100px;
      object-fit: cover;

    }
    .notify-custom{
    	display: flex; border-bottom: 1px solid #0000001a;
    }
</style>

<script type="text/javascript">
	import moment from 'moment'
	export default {
		 data() {  	
      return {
      	clase:"",
      	active:false,
      	img:"/uploads/1586581538_ave.jpg",
      	items:null
      }
    },
    mounted(){
    	this.getnotificaciones()
    },
		methods: {

		  ago(fecha){
		  	 moment.locale('es'); 
		  		return moment(fecha).startOf('hours').fromNow();
		  },
	      mouseover: function(){
	      	this.clase = 'show'
	    	},    
		    	mouseleave: function(){
	      this.clase = ''
	    	},    
		    shownotify(){
		    		this.active=!this.active;
		    		if(this.active){
		    			this.clase = 'show'
		    		}else{
	      			this.clase = ''
		    		}
		    		// alert(this.active);
	    		},
	    		getnotificaciones(){
	    			axios.get(url+"api/getnotify").then(data => {
					          this.items=data.data;

			        }).catch(error => {
			             console.log(error);  
		        	});
		    	},
	    		isMobile() {
	    			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
					     return true
					   } else {
					     return false
					   }
					 }
		},
	}

</script>
