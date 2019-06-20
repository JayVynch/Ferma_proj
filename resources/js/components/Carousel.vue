<template>
    <div>        
        <vueper-slides 
            autoplay
            :pauseOnHover="false"
        >
            <vueper-slide v-for="(slide, i) in slides"
                :key="slide.id"
                :style="'height:' + 100+'vh;' + 'opacity:' + 0.5 +';'"
                :image="slide.image">
            </vueper-slide>
        </vueper-slides>
    </div>
</template>

<script>
    // import Carousel for slides of images
    import { VueperSlides, VueperSlide } from 'vueperslides';
    import 'vueperslides/dist/vueperslides.css';
    import ModalTrigger from './ModalTrigger.vue'

    export default {
        components: {
            VueperSlides, 
            VueperSlide,
            ModalTrigger
        },

        data() { 
            return{
                slides: [
                    {
                        id: 'slide-1',
                        image: '/images/ferma_road.jpeg'
                    },
                    {
                        id: 'slide-2',
                        image: '/images/ferma_road1.jpg'
                    },
                    {
                        id: 'slide-3',
                        image: '/images/ferma_traffic.png'
                    },
                    {
                        id: 'slide-4',
                        image: '/images/ferma_working.jpg'
                    },
                ]
            }
        }
    }
</script>
<style>
    .vueperslides__parallax-wrapper{
        height: 100vh;
    }
</style>