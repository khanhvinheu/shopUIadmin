    <template>
    <section class="homepage-banner" v-loading="!SlideData.length">
        <el-carousel indicator-position="outside" height="750px">
            <el-carousel-item v-for="(item,i) in SlideData" :key="i"
                              v-bind:style="{'background-image': 'url('+item.path+')'}"
                              style="background-repeat: repeat; background-position: center; background-size: cover;">
                <div class="banner-policy">
                    <div class="banner-policy__wrapper">
                        <a class="banner-policy__item">
                            Miễn phí vận chuyển cho<br>
                            đơn hàng trên 200K
                        </a>
                        <a class="banner-policy__item">
                            60 ngày đổi trả vì<br>
                            bất kì lý do gì
                        </a>
                        <a class="banner-policy__item">
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

</style>
