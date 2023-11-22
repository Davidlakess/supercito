<template>
 <div>
    <carousel
        v-if="img"
        :images="images">
    </carousel>
</div>
</template>
<script type="text/javascript">
  export default {
      props:[
      'img'
      ],
      created() {
      this.getruta();
      },
      data() {
        return {
          images:[]
        }
      },
  // computed:{
  // },
  methods:{
    getruta(){
       this.images.push({
          id:'1',
          big:'/uploads/'+this.img,
          thumb:'/uploads/'+this.img,
        })
    }
    
  }
}
</script>