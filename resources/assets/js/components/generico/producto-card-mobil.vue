<template>
	<div  style="margin: 20px 14px;">   
      <ul class="list-group list-group-flush" >
        <li class="list-group-item" >
          <span style="font-weight: bold; font-size: 17px;"> Productos de {{categoria.name}}</span>
        </li>
        <li class="list-group-item" >
          <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="pro in items">
              <b-row align-h="justify" class="poner-borde">                
                <b-col  col="6" class="p-0">
                  <div class="img-wrap"> 
                    <a-img :to="pro.ids" :src="pro.img" :name="pro.name"></a-img>
                  </div>
                </b-col>
                <b-col col="6" class="p-0">
                  <b-col cols="12" class="p-0" style="display: flex; flex-direction: column;">
                    <span class="name-producto">{{pro.name}}</span>
              <!-- <small>Vendido por </small> -->
                    <span style="font-size: 19px; margin-top: 10px;">${{pro.precio}}</span>
                  </b-col>
                </b-col>
              </b-row>
            </li>
          </ul>
        </li>
        <li class="list-group-item" >
          <a :href="formaturl()"> Ver mas</a>
        </li>
      </ul>
    </div>
</template>

<script type="text/javascript">
	export default {
		props:['items','categoria'],
		methods:{
			formaturl(){
        let aux= this.categoria.name.split(" ").join("-");
        
        let result=url+'c/'+aux+'/'+this.categoria.ids;

        return result;
      }
		}
	}

</script>