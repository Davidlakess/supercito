<template>
    <div  class="card-carousel" @mouseover="stopTimer" @mouseleave="restartTimer">
        <div class="progressbar" v-if="autoSlideInterval && showProgressBar">
            <div :style="{width: progressBar + '%' }"></div>
        </div>
            <b-row align-h="center">
               <b-col md="2" lg="2" style="padding-left: 10px;padding-right: 0;">
                    <div class="thumbnails" >
                        <div 
                            v-for="(image, index) in  images"
                            :key="image.id"
                            :class="['thumbnail-image', (activeImage == index) ? 'active' : '']"
                            @mouseover="activateImage(index)"
                        >
                            <img :src="image.thumb">
                        </div>
                    </div>
                </b-col>
           <b-col md="10" lg="10" >     
                
                <div class="card-img" style="left: 50px;" v-for="(image, index) in  images" :key="image.id"
                  v-if="(activeImage == index) ? true : false"
                  @click="activateImage(index)">               
                  <div  class="vue-h-zoom">    
                    <div :style="containerStyle" v-if="visibleZoom"  class="img-zoom-container">    
                      <div   :style="zoomStyle" ></div>
                    </div> 
                      
                    <figure  id="thumb" class="thumbnail-area card-product">
                        <div class="img-wrap"> 
                           <img :src="image.img" alt="" :style="thumbnailStyle"  >
                           <div :style="pointerBoxStyle" ></div>    
                        </div>
                    </figure>
                  </div>
                </div>


                    <!-- <div class="actions">
                        <span @click="prevImage" class="prev">
                            &#8249;
                        </span>
                        <span @click="nextImage" class="next">
                            &#8250;
                        </span>
                    </div> -->
            </b-col>
        </b-row>
    </div>
</template>

<script>
export default {
    name: 'mycarousel',
    data() {
        return {
            imageFull:'',
            visibleZoom: !1, pointer: { x: 0, y: 0 }, thumbnailPos: {},
            zoomLevel:2,
            width:600,
            height:400,
            zoomWindowSize:1,
            zoomWindowX:720,
            zoomWindowy:10,
            pointshow:false,
            img:'',
            //Index of the active image
            activeImage: 0,
            //Hold the timeout, so we can clear it when it is needed
            autoSlideTimeout: null,
            //If the timer is stopped e.g. when hovering over the carousel
            stopSlider: false,
            //Hold the time left until changing to the next image
            timeLeft: 0,
            //Hold the interval so we can clear it when needed
            timerInterval: null,
            //Every 10ms decrease the timeLeft
            countdownInterval: 10
        }
    },
    computed: {
           // largeImage: function () {
           //               return this.imageFull || this.image;
           //          },
      zoomWidth: function () {
        // return this.zoomWindowSize * this.width;
        return 360 
      },
      zoomHeight: function () {
        // return this.zoomWindowSize * this.height;
        return  412
      },
      pointerBoxStyle: function () {
        return {
          position: "absolute",
          "z-index": "999",
          transform: "translateZ(10px)",
          top: this.toPx(this.pointerOffsetTop),
          left: this.toPx(this.pointerOffsetLeft),
          width: this.toPx(this.pointerWidth),
          height: this.toPx(this.pointerHeight),
          background: "gray",
          opacity: 0.5,
          border: "1px solid white",
          cursor: "crosshair",
        // display:(this.pointshow)?'block':'none'
        };
    },
    pointerOffsetTop: function () {
      var t = this.pointer.y - this.pointerHeight / 2 - this.thumbnailPos.top;
      return t < 0 ? 0 : t > this.height - this.pointerHeight ? this.height - this.pointerHeight : t;
    },
    pointerOffsetLeft: function () {
      var t = this.pointer.x - this.pointerWidth / 2 - this.thumbnailPos.left;
      return t < 0 ? 0 : t > this.width - this.pointerWidth ? this.width - this.pointerWidth : t;
    },
    pointerWidth: function () {
      // return this.width / this.zoomLevel;
      return 120
    },
    pointerHeight: function () {
      // return this.height / this.zoomLevel;
      return  120
    },

    zoomPosX: function () {
      var t = this.width / 2,
      e = -(this.pointer.x - this.thumbnailPos.left - t) * this.zoomWindowSize;
      return e > this.pointerEdgeX ? this.pointerEdgeX : e < -1 * this.pointerEdgeX ? -1 * this.pointerEdgeX : e;
    },
    zoomPosY: function () {
      var t = this.height / 2,
      e = -(this.pointer.y - this.thumbnailPos.top - t) * this.zoomWindowSize;
      return e > this.pointerEdgeY ? this.pointerEdgeY : e < -1 * this.pointerEdgeY ? -1 * this.pointerEdgeY : e;
    },
    zoomStyle: function () {
      return {
            "background-image": "url(" + this.currentImage + ")",
            "background-repeat": "no-repeat",
            "background-position": this.toPx(this.zoomPosX) + " " + this.toPx(this.zoomPosY),
            "background-size": "cover",
            width: '1503px',
            height: '1053px',
            "-webkit-transform": "scale(" + this.zoomLevel + ")",
            transform: "scale(" + this.zoomLevel + ")",
        };
      },
        // currentImage gets called whenever activeImage changes
        // and is the reason why we don't have to worry about the 
        // big image getting updated
      currentImage() {
        this.timeLeft = this.autoSlideInterval;
        return this.images[this.activeImage].big;
      },
      progressBar() {
        //Calculate the width of the progressbar
        return 100 - (this.timeLeft/this.autoSlideInterval) * 100;
      },
      thumbnailStyle: function () {
        return { 
          // "background-image": "url(" + this.img + ")",
          "background-size": "cover",
          height: this.toPx(this.height),
          // width: this.toPx(this.width) 
        };              
      },
      containerStyle: function () {
        return {
          height: this.toPx(this.zoomHeight),
          width: this.toPx(this.zoomWidth),
          // left: this.toPx(this.zoomWindowX),
          left: '97.3%',
          top: this.toPx(this.zoomWindowY),
          position: "absolute",
          overflow: "hidden",
          display: 'flex',
          "z-index": "1024",
          border: "1px solid #ccc",
        };
      },
    },
    methods: {
      mousepointenter: function   (){
        this.pointshow=!this.pointshow;
      },
      mousepointleave: function   (){
        this.pointshow=!this.pointshow;
      },
      mouseEnter: function () {
        this.updateThumbnailPos(), (this.visibleZoom = !0);                  
      },
      mousemove: function (e) {
        if (e.target !== e.currentTarget) return null;
           this.followMouse(e);
      },
      followMouse: function (t) {
        this.pointer = { 
          x: t.pageX - document.getElementById('thumb').getBoundingClientRect().left - window.scrollX, 
          y: t.pageY - document.getElementById('thumb').getBoundingClientRect().top - window.scrollY 
        };
        // console.log(t.target)
      },
      toPx: function (t) {
        return t + "px";
      },
      updateThumbnailPos: function () {
        var t =document.getElementById('thumb');
        this.thumbnailPos = { top: t.offsetTop, left: t.offsetLeft };
      },
      mouseLeave: function () {
        this.visibleZoom = 1;
      },
        // Go forward on the images array 
        // or go at the first image if you can't go forward
      nextImage() {
          var active = this.activeImage + 1;
          if(active >= this.images.length) {
              active = 0;
          }
          this.activateImage(active);
      },
        // Go backwards on the images array 
        // or go at the last image
      prevImage() {
          var active = this.activeImage - 1;
          if(active < 0) {
              active = this.images.length - 1;
          }
          this.activateImage(active);            
      },
      activateImage(imageIndex) {
          this.activeImage = imageIndex;
      },
        //Wait until 'interval' and go to the next image;
      startTimer(interval) {
        if(interval && interval > 0 && !this.stopSlider) {
            var self = this;
            clearTimeout(this.autoSlideTimeout);
            this.autoSlideTimeout = setTimeout(function() {
                self.nextImage();
                self.startTimer(self.autoSlideInterval);
            }, interval);
        }
      },
      stopTimer() {
        clearTimeout(this.autoSlideTimeout);
        this.stopSlider = true;
        clearInterval(this.timerInterval);
      }
,      restartTimer() {
          this.stopSlider = false;
          clearInterval(this.timerInterval);
          this.startCountdown();
          this.startTimer(this.timeLeft);
      },
      startCountdown() {
          if(!this.showProgressBar) return;
          var self = this;
          this.timerInterval = setInterval(function() {
              self.timeLeft -= self.countdownInterval;
              if(self.timeLeft <= 0) {
                  self.timeLeft = self.autoSlideInterval;
              }
          }, this.countdownInterval);
        }
      },
      created() {
        if(this.startingImage 
            && this.startingImage >= 0
            && this.startingImage < this.images.length) {
            this.activeImage = this.startingImage;
        }

        //Check if autoSlideInterval prop was given and if it is a positive number
        if(this.autoSlideInterval
            && this.autoSlideInterval > this.countdownInterval) {
            //Start the timer to go to the next image
            this.startTimer(this.autoSlideInterval);
            this.timeLeft = this.autoSlideInterval;
            //Start countdown to show the progressbar
            this.startCountdown();
        }
    },
    props: ['startingImage', 'images', 'autoSlideInterval', 'showProgressBar']
}
</script>


<style scoped>
.card-carousel {
    user-select: none;
    position: relative;
}



.progressbar {
    display: block;
    width: 100%;
    height: 5px;
    position: absolute;
    background-color: rgba(221, 221, 221, 0.25);
    z-index: 1;
}

.progressbar > div {
    background-color: rgba(255, 255, 255, 0.52);
    height: 100%;
}

.thumbnails {
    display: flex;
    justify-content: space-evenly;
    flex-direction: row;
}

.thumbnail-image {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 2px;
}

.thumbnail-image > img {
    width: 48px;
height: 48px;
font-size: 12px;
padding: 2px;
    transition: all 250ms;
}

.thumbnail-image:hover > img, 
.thumbnail-image.active > img {
    opacity: 0.6;
    box-shadow: 2px 2px 6px 1px rgba(0,0,0, 0.5);
    border: 2px solid #3483fa;
}

.card-img {
    position: relative;
    margin-bottom: 15px;
}

.card-img > img {
    display: block;
    margin: 0 auto;
}

.actions {
    font-size: 1.5em;
    height: 40px;
    position: absolute;
    top: 50%;
    margin-top: -20px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #585858;
}

.actions > span {
    cursor: pointer;
    transition: all 250ms;
    font-size: 45px;
}

.actions > span.prev {
    margin-left: 5px;
}

.actions > span.next {
    margin-right: 40px;
}

.actions > span:hover {
    color: #eee;
}

.img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: auto;
    text-align: center; 
    left: -54px;
}

/*    .thumbnail-area {
      max-height: 300px;
      max-width: 500px;
      object-fit: cover; 
  }*/


.thumbnails {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 300px;
    /*text-align: center; */
}

.thumbnails img {
  max-height: 100%;
  max-width: 100%;
  object-fit: cover; 
}
            

/*product*/

/*.card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden;
    margin-bottom: 10px; 
  }
  
*/
.card-product .img-wrap {
    height: auto;
    object-fit: contain;
    width: 100%; 
}
.card-product .img-wrap img {
  max-height: 500px;
  max-width: 500px;
  object-fit: cover;
}

</style>
