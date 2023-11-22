<template>
  <div>
	<b-card >
    <b-row  style="padding-bottom: 15px !important;">
      <b-col cols="12" lg="6" class="text-lg-left" >
        <span style="font-size: 18px;">Productos: </span>
      </b-col>
      <b-col cols="12" lg="6" class="text-lg-right btn-v-c">
        <span>({{items.length}})</span>
      </b-col>
      <b-col cols="12" style="margin-bottom: 7px;">
        <hr>
      </b-col>
      <template v-for="item in paginatedItems">
      <b-col cols="12" style="padding: 0;margin: 0; display: flex;" >
        <b-col cols="2" style="padding: 0;">
          <figure class="card card-product"  style="width: 100px; border: none;">
            <div class="img-wrap"> 
             <b-img  style="height: 65px;" rounded="circle" :src="url + '/uploads/'+item.img"></b-img>
            </div>
          </figure>
        </b-col>
        <b-col cols="10"style="margin:0;">
          <b-row style="margin-top: 11px !important;">
            <b-col cols="6" class="p-0 pl-3">
              <span>
                {{item.descripcion}}
              </span>
            </b-col>
            <b-col cols="3" class="pl-3 p-0">
              <span>
                 #{{parseInt(item.cantidad)}}
              </span>
            </b-col>
            <b-col cols="3" class="p-0">
              <span>
                ${{item.precio}}
              </span>
            </b-col>
          </b-row>
        </b-col>
      </b-col>
    </template>
    <b-col col="12"  class="my-1" style="display: block ruby;text-align:justifys;">
          <b-pagination
            @change="onPageChanged"
            :total-rows="totalRows"
            :per-page="perPage"
            v-model="currentPage"
            class="my-0"
          />
    </b-col>  
    </b-row>
  </b-card>
  </div>
</template>
<script type="text/javascript">
	export default {
		 props:['items'],
     data() {  	
      return {
        paginatedItems:[],
        currentPage: 1,
        perPage: 4,
        url: window.url,
        totalRows: 0,
      }
    },

    mounted() {
        this.paginatedItems=this.items ;
          this.totalRows= this.paginatedItems.length;
          this.paginate(this.perPage, 0);
    },
		methods: {
        paginate(page_size, page_number) {
        let itemsToParse = this.items;
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