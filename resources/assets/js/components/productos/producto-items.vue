<template>
<b-container id="content-p" fluid>
  <b-row align-h="center">
  	<template v-for="(item, index) in paginatedItems">
  		<productocard
  		 :img="item.img"
  		 :des="item.name"
  		 :precio="item.precio"
  		 :id="item.id"
       :ruta="ruta"
       :mdruta='mdruta'
       :logeado="login"
  		></productocard>
  	</template>
  </b-row>
  <b-row>
    <b-col col="12"  class="my-1" style="display: block ruby;text-align: center;">
      <b-pagination
        @change="onPageChanged"
        :total-rows="totalRows"
        :per-page="perPage"
        v-model="currentPage"
        class="my-0"
      />
    </b-col>
  </b-row>
</b-container>
</template>
<script>
  
  export default {
   
    props:[
      'ruta',
      'login',
      'mdruta'
    ],
    data() {
      return {
        items:[],
        paginatedItems:[],
        currentPage: 1,
        perPage: 12,
        totalRows: 0,
        productos:[
          {
            name:'audifonos',
            img:'https://www.tutorialrepublic.com/examples/images/products/headphone.jpg',
            precio:200,
            descuento:150,
          },
          {
            name:'mackbook2',
            img:'https://www.tutorialrepublic.com/examples/images/products/macbook-air.jpg',
            precio:3000,
            descuento:2000,
          },
          {
            name:'camara',
            img:'https://www.tutorialrepublic.com/examples/images/products/nikon.jpg',
            precio:100,
            descuento:200,
          },
          {
            name:'play station',
            img:'https://www.tutorialrepublic.com/examples/images/products/play-station.jpg',
            precio:2000,
            descuento:1800,
          },
          {
                  
            name:'Mackbook',
            img:'https://www.tutorialrepublic.com/examples/images/products/macbook-pro.jpg',
            precio:3000,
            descuento:2500,
          },
          {
            name:'altavoz ',
            img:'https://www.tutorialrepublic.com/examples/images/products/speaker.jpg',
            precio:140,
            descuento:120,
          },
          {
            name:'samsum galaxy',
            img:'https://www.tutorialrepublic.com/examples/images/products/galaxy.jpg',
            precio:120,
            descuento:23,
          },
          {
            name:'iphone',
            img:'https://www.tutorialrepublic.com/examples/images/products/iphone.jpg',
            precio:200,
            descuento:150,
          },
          {
            name:'camara',
            img:'https://www.tutorialrepublic.com/examples/images/products/canon.jpg',
            precio:200,
            descuento:100,
          },
          {
            name:'iphone',
            img:'https://www.tutorialrepublic.com/examples/images/products/ipad.jpg',
            precio:300,
            descuento:250,
          },

        ],

      }
    },
    mounted() {
      this.getproductos();
      this.paginate(this.perPage, 0);
  
    },

    methods: {
    	indexof(val){
    		alert(val);
    	},
      getproductos(){
        axios.get("api/productos").then(data => {
          this.items=data.data;
          this.paginatedItems= this.items;
          this.totalRows= this.items.length;
        }).catch(error => {
             console.log(error);  
        });
      },
      paginate(page_size, page_number) {
        let itemsToParse = this.items;
        this.paginatedItems = itemsToParse.slice(
          page_number * page_size,
          (page_number + 1) * page_size
        );
      },
      onPageChanged(page) {
        this.paginate(this.perPage, page - 1);
      }
    }
  }
</script>
<style> 
    body {
  background: #ebebeb;
  font-family: "Open Sans", sans-serif;
}
.col-center {
  margin: 0 auto;
  float: none !important;
}
.carousel {
  margin: 30px auto 60px;
  padding: 0 80px;
}
.carousel .item {
    text-align: center;
  overflow: hidden;
}
.carousel .item h4 {
  font-family: 'Varela Round', sans-serif;
}
.carousel .item img {
  max-width: 100%;
  display: inline-block;
}
/*.carousel .item .btn {
  border-radius: 0;
  font-size: 12px;
  text-transform: uppercase;
  font-weight: bold;
  border: none;
  background: #a177ff;
  padding: 6px 15px;
  margin-top: 5px;
}*/
/*.carousel .item .btn:hover {
  background: #8c5bff;
}*/
/*.carousel .item .btn i {
  font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}*/
.carousel .thumb-wrapper {
  margin: 5px;
  text-align: left;
    background: #fff;
    box-shadow: 0px 2px 2px rgba(0,0,0,0.1);   
}
.carousel .thumb-content {
  padding: 15px;
  font-size: 13px;
}
.carousel .carousel-control {
  height: 44px;
  width: 44px;
  background: none; 
    margin: auto 0;
    border-radius: 50%;
    border: 3px solid rgba(0, 0, 0, 0.8);
}
.carousel .carousel-control i {
    font-size: 36px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -19px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: rgba(0, 0, 0, 0.8);
  text-shadow: none;
    font-weight: bold;
}
.carousel .carousel-control.left i {
  margin-left: -3px;
}
.carousel .carousel-control.right i {
  margin-right: -3px;
}









.carousel .carousel-indicators {
  bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
  width: 10px;
  height: 10px;
  margin: 4px;
  border-radius: 50%;
  border: none;
}
.carousel-indicators li { 
  background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {  
  background: rgba(0, 0, 0, 0.6);
}

</style>
               
