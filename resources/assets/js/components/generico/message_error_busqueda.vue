<template>
		<b-container style="height: 100%;display: flex;flex-direction: column;">
	   <b-card no-body class="overflow-hidden" style="width: 900px;margin: 8%;" >
        <b-card-body style="padding:15px 0px 20px;">
	<b-row align-h="center">
		<b-col md="2" sm="1" class="search-button-message">
			<i class="fa fa-search"></i>
		</b-col>
	  <b-col md="10" sm="11"style="margin-top: 10px; padding-left: 75px">
         	<div class="title-error-message">
         		<span>No hay publicaciones que coincidan con tu búsqueda.</span>
					</div>
         	<ul class="list-sugges">
						<li class="item-list-sugges">Utiliza palabras más genéricas o menos palabras</li>
						<li>Navega por las categorías para encontrar un producto similar</li>
					</ul>
   
    </b-col>
  </b-row>
       </b-card-body>
	    </b-card>
	  </b-container>
</template>
<style>
	.search-button-message{
margin-top: 35px;
padding-left: 100px;
font-size: 55px;
	}
	.title-error-message{
margin: 18px 10px 10px 0;
font-size: 21px;
font-weight: bold;
	}
</style>