<template>
	<div>
		
	<div id="animation_box" class="animated fadeInLeft espacio-box">  
		<details open>
		  <summary>
		   	<span>¿Color?</span>
		  </summary>
			<div style="margin-top: 20px;">	
				<b-form-group >
				  <b-form-tags
		        id="tags-component-select"
		        v-model="colors"
		        tags="name"
		        size="md"
		        class="mb-2"
		        add-on-change
		        no-outer-focus>
			        <template v-slot="{ tags, inputAttrs, inputHandlers, disabled, removeTag }">
				          <!-- :disabled="disabled || availableOptions.length === 0" -->
				          <b-form-select
				            v-bind="inputAttrs"
				            v-on="inputHandlers"
				            
				            :options="options"
				          >
		            		<template #first>
				              <option disabled value=""> 
					    				Elige un color</option>
				            </template>
				          </b-form-select>
				          <ul v-if="tags.length > 0" class="list-inline d-inline-block mb-2">
				            <li v-for="tag in tags" :key="tag" class="list-inline-item">
				              <b-form-tag
				                @remove="removeTag(tag)"
				                :title="tag"
				                :disabled="disabled"	
				                class="custom-chip"			   
				              >   
					              <div class="stilo-chip" :style="{'background-color':getrgb(tag)}"></div>
					              <span style="margin-top: 4px;">	{{ tag }}</span>
						          </b-form-tag>
				            </li>
				          </ul>    
				        </template>
				      </b-form-tags>
				    </b-form-group>
				     <b-col cols="12" lg="12" style="text-align: end;display: grid; margin-top: 20px;">
				     		<b-button :variant="color" @click="showaddtalla()" >Siguiente</b-button>	
						</b-col>
				</div>
			</details>			
		</div>



		<div id="animation_box" class="animated fadeInLeft espacio-box" v-if="showtallas">  
			<details open>
			  <summary>
			   	<span>completa la informacion de las variantes</span>
			  </summary>
				<div style="margin-top: 20px;">				
          <ul v-if="colores_with_talla.length > 0" class="list-inline d-inline-block mb-2">
            <li v-for="(tag,key) in colores_with_talla" :key="key" class="list-inline-item" style="width: 100%; margin-top: 15px;">
      				<div style="display: flex;width: 100%;">           
				        <b-form-tag
					        		no-remove  
			                :title="tag.color"
			                class="custom-chips rem"			   
					        >         
			        		<div class="stilo-chip" :style="{'background-color':getrgb(tag.color)}"></div>
				          <span style="margin-top: 4px;">	{{ tag.color }}</span>
				        </b-form-tag>
							</div>
							<b-row align-h="center">
            <b-col cols="12" style="margin-bottom: 15px;">
							<div class="image-upload-wrap">
							 <file-input class="file-upload-input" accept="image/*"></file-input>  
  						  <!-- <input class="file-upload-input" type='file'accept="image/*" /> -->
						    <div class="drag-text">
						      <h3>Subir Imagen</h3>
						    </div>
						  </div>
						</b-col>
						 <b-col cols="4" >
							<b-form-input placeholder="Talla"  autofocus></b-form-input>
						</b-col>
						<b-col cols="4" >
							<b-form-input placeholder="Cantidad"  ></b-form-input>
						</b-col>
						<b-col cols="4" >
							<b-form-input placeholder="Sku"></b-form-input>
						</b-col>
					</b-row>
						</li>
				</ul>			
		     	<b-col cols="12" lg="12" style="text-align: end;display: grid; margin-top: 20px;">
			     		<b-button :variant="color" @click="show()">Siguiente</b-button>	
					</b-col>
					{{data}}
				</div>
			</details>			
		</div>
	</div>
</template>
<script type="text/javascript">
	
	export default {
			 
			// computed: {
	  //     availableOptions() {
	  //       return this.options.filter(opt => this.value.indexOf(opt) === -1)
	  //     },
	  //      availableOptionstalla() {
	  //       return this.otiontalla.filter(opt => this.value.indexOf(opt) === -1)
	  //     }
  	// 	},
  	props:['data'],
		 	data(){
      	return {
	     		options: ['Rojo','Morado','Amarillo'],
	     		sizes:[{name:'M'},{name:'SM'},{name:'L'},{name:'XL'}],
	     		// otiontalla:['L','M','XL'],
	     		showtallas:false,
	     		colors:[],
	     		t:[],
	     		value:[],
	     		colores_with_talla:[],
	     		color:'primary',
	     		rgb:[
		     		{
			     		name:'Rojo',
			     		value:'#FF0000'
			     	},
			     	{
			     		name:'Amarillo',
			     		value:'#FFFF00'
			     	},
			     	{
			     		name:'Morado',
			     		value:'#800080'
			     	},
	     		],
      	}
			},
			 // computed: {
		  //   mappedTags() {
		  //     /* This is case sensitive */
		  //     return this.options.filter(option => this.value.includes(option.name))
		  //   }
		  // },
			mounted(){

			},
			methods:{
				show(){
					console.log(this.colores_with_talla)
				},
			 addTag (newTag) {
	     
	      const tag = {
	        name: newTag,
	      }

	      // this.sizes.push(tag)
	      // this.value.push(tag)
    },
				showaddtalla(){
			
					for (var i = 0 ;i < this.colors.length; i++) {
							
						this.colores_with_talla[i]={
							color:this.colors[i]};
						}


					console.log(this.colores_with_talla);
				
	  			Vue.nextTick().then(() =>{ 
						this.showtallas=true;
					})
				},

				getrgb(tag){

					for(var i=0;i<this.rgb.length;i++){
							
							if(this.rgb[i].name==tag){
									return this.rgb[i].value;
							}
					}


				},		
			}
		}
</script>
<style>
.file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #1FB264;
  position: relative;
}



.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #15824B;
  padding: 60px 0;
}



</style>