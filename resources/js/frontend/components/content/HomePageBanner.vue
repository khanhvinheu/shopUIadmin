<template>
    <section class="homepage-banner" v-loading="!SlideData.length">
        <el-carousel indicator-position="outside" height="750px">
            <el-carousel-item v-for="(item,i) in SlideData" :key="i"
                              v-bind:style="{'background-image': 'url('+item.path+')'}"
                              style="background-repeat: repeat; background-position: center; background-size: cover;">
                <div style="width: 100%;">
                </div>
                <div class="banner-policy">
                    <div class="banner-policy__wrapper">
                        <a href="#" class="banner-policy__item" style="background-color: rgb(0,0,0,0.1);">
                            Miễn phí vận chuyển cho<br>
                            đơn hàng trên 200K
                        </a> <a href="#" class="banner-policy__item" style="background-color: rgb(0,0,0,0.1);">
                        60 ngày đổi trả vì<br>
                        bất kì lý do gì
                    </a> <a href="#" class="banner-policy__item" style="background-color: rgb(0,0,0,0.1);">
                        Đến tận nơi nhận hàng trả,<br>
                        hoàn tiền trong 24h
                    </a>
                    </div>
                </div>
            </el-carousel-item>
        </el-carousel>
    </section>
</template>
<script>
    import ApiService from "../../../backend/common/api.service";
    import VueSlickCarousel from 'vue-slick-carousel'
    import 'vue-slick-carousel/dist/vue-slick-carousel.css'
    import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
    export default {
        components: {
            VueSlickCarousel
        },
        data() {
            return {
                setting: {
                    "infinite": false,
                    "dots": false,
                    "dotsClass": "slick-dots custom-dot-class",
                    "edgeFriction": 0.35,
                    "speed": 500,
                    "slidesToShow": 1,
                    "slidesToScroll": 1
                },
                SlideData: []
            }
        },
        mounted(){
          this.getBanner()
        },
        methods:{
            getBanner(){
                ApiService.query('/api/admin/banners').then(({data})=>{
                    if(data['success']){
                        this.SlideData = data['data'].filter(e=>e.hidden == 1)
                    }
                })
            }
        }
    }
</script>

<style>
    .el-carousel__item h3 {
        color: #475669;
        font-size: 18px;
        opacity: 0.75;
        line-height: 300px;
        margin: 0;
    }

    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }

    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }

    .slide-banner> .slick-prev{
        left: 13px !important;
        z-index: 99999999999999999 !important;
        width: 100px;
    }
    .slide-banner> .slick-next {
        right: 13px !important;
        z-index: 99999999999999999 !important;
        width: 100px;
    }
</style>
