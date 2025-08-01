-<template>
<div >

      <b-row align-h="center">
      <b-col md="12">
          <div style="margin: 15px;">
              <span style="text-transform:uppercase;">{{query}}</span>
          </div>
        </b-col>
        <b-col xl="12" style="margin-bottom: 10px;">
          <ul class="list-group list-group-flush">
              <li class="list-group-item" v-for="pro in this.paginatedItems">
                  <b-row align-h="justify">                
              <b-col  col="6" class="p-0">
                <div class="img-wrap-m"> 
                  <a-img :to="pro.ids" :src="pro.img" :name="pro.name" height="auto"></a-img>
                </div>
              </b-col>
              <b-col col="6" class="p-0">
                  <b-col cols="12" class="p-0" style="display: flex; flex-direction: column;" >
                      <span class="name-producto">{{pro.name}}</span>
                      <!-- <small>Vendido por </small> -->
                      <span style="font-size: 24px; margin-top: 10px;">${{pro.precio}}</span>
                  </b-col>
              </b-col>
                  </b-row>
              </li>
          </ul>
	   </ul>

  		</b-col>
  		
      <b-col col="12"  class="my-1" style="display: contents;
text-align: center;">
         <v-pagination
          @input="PageChanged"
          :length="pages"
          v-model="currentPage"
          :total-visible="7"
          circle
          color="red"
        ></v-pagination>
   	 </b-col>  
    </b-row>
</div>

</template>

<script>	
export default {
	props:['productos','query'],
data(){
      return {
        ruta:url,
        currentPage: 1,
        perPage: 15,
        totalRows: 0,
        paginatedItems:[],
        pages:0
      }
    },
    mounted() {
        // this.paginatedItems=this.productos ;
        //   this.totalRows= this.paginatedItems.length;
        //   this.paginate(this.perPage, 0);
        //   this.paginatedItems = this.productos 
        
        this.totalRows = this.paginatedItems.length
        if (this.perPage == null || this.totalRows == null) {
          this.pages = 0
        } else {
          this.pages = Math.ceil(this.totalRows / this.perPage)
        }
        this.paginate(this.perPage, 0)
    },
  methods:{
     paginate(page_size, page_number) {
          let itemsToParse = this.productos;
          this.paginatedItems = itemsToParse.slice(
            page_number * page_size,
            (page_number + 1) * page_size
          );
        },
        PageChanged(page) {
          this.paginate(this.perPage, page - 1);
          window.scrollTo(0, 0)
        },
  }
}
</script>
