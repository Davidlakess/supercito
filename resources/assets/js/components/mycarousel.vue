<template>
    <div  class="card-carousel" @mouseover="stopTimer" @mouseleave="restartTimer">
        <div class="progressbar" v-if="autoSlideInterval && showProgressBar">
            <div :style="{width: progressBar + '%' }"></div>
        </div>
            <b-row align-h="center">
               <b-col md="1" lg="1" style="padding-left: 10px;padding-right: 0;">
                    <div class="thumbnails" >
                        <div 
                            v-for="(image, index) in  images"
                            :key="image.id"
                            style="    z-index: 1024;" 
                            :class="['thumbnail-image', (activeImage == index) ? 'active' : '']"
                            @mouseover="activateImage(index)"
                        >
                            <img :src="image.thumb">
                        </div>
                    </div>
                </b-col>
           <b-col md="11" lg="11" >     
                
               
                <div v-for="(image, index) in  images" class="card-img" v-if="(activeImage == index) ? true: false"  :key="image.id">               
                    <figure  id="thumb" class="thumbnail-area card-product">
                        <div class="img-wrap"> 
                           <img :src="image.img" :style="thumbnailStyle" :data-zoom="image.big" alt="" style="cursor: crosshair;" id="img-r">
                         
                           <!-- <div :style="pointerBoxStyle" ></div>     -->
                        </div>
                    </figure>

          
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
  
import Drift from 'drift-zoom';

export default {
    name: 'mycarousel',
    data() {
        return {
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
      thumbnailStyle: function () {
        return { 
          // "background-image": "url(" + this.img + ")",
          "background-size": "cover",
          height:"500px",
          // width: this.toPx(this.width) 
        };              
      },
      currentImage() {
        this.timeLeft = this.autoSlideInterval;
        return this.images[this.activeImage].big;
      },
      progressBar() {
        //Calculate the width of the progressbar
        return 100 - (this.timeLeft/this.autoSlideInterval) * 100;
      },
      getzoom(){

        // Vue.nextTick(function () {
        //   new Drift(document.querySelector('#img-r'), {
        //     paneContainer: document.querySelector('.zoom-container'),
        //     inlinePane: 900,
        //     inlineOffsetY: -85,
        //     containInline: true,
        //     hoverBoundingBox: true
        //   });
        // })
        // console.log('yes')
        return true 
      }
      
    },
    methods: {
      
        // Go forward on the images array 
        // or go at the first image if you can't go forward
      nextImage() {
          var active = this.activeImage + 1;
          if(active >= this.images.length) {
              active = 0;
          }
          this.activateImage(active);
      },

      prevImage() {
          var active = this.activeImage - 1;
          if(active < 0) {
              active = this.images.length - 1;
          }
          this.activateImage(active);            
      },
      activateImage(imageIndex) {
          this.activeImage = imageIndex;
          
          new Drift(document.querySelector('#img-r'), {
            paneContainer: document.querySelector('.zoom-container'),
            inlinePane: 900,
            inlineOffsetY: -85,
            containInline: true,
            hoverBoundingBox: true
          });

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
      },
      restartTimer() {
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
      mounted(){
          new Drift(document.querySelector('#img-r'), {
            paneContainer: document.querySelector('.zoom-container'),
            inlinePane: 900,
            inlineOffsetY: -85,
            containInline: true,
            hoverBoundingBox: true
          });
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
.activa{
  display: block !important;
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
    /*display: flex;
    justify-content: space-evenly;
    flex-direction: row;*/
}

.thumbnail-image {
    /*display: flex;*/
    /*align-items: center;*/
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
    /*overflow: hidden;*/
    position: relative;
    /*height: auto;*/
    text-align: center; 
    /*left: -54px;*/
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
    height: 100%;
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
    margin-top: 40px;
}
.card-product .img-wrap img {
  /*max-height: 500px;*/
  max-height: 467px;
  max-width: 700px;
  object-fit: cover;
}

</style>
