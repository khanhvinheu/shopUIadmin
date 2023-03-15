<template>
    <div class="content__product">
        <VueSlickCarousel v-bind="setting" v-if="dataProduct.length > 0">
            <div v-for="(item, i) in dataProduct">
                <div class="home__page-product" @click="$router.push({name:'product-detail', params:{id:item.id}})">
                    <div class="product__item" v-on:mouseover="hoverIndex =i"
                         v-on:mouseleave="hoverIndex =-1">
                        <transition name="slide-fade">
<!--                            <el-image v-if="hoverIndex==i && item.images_product.length>1" class="product&#45;&#45;image" fit="cover"-->
<!--                                      :src="(item.images_product[1].path)">-->
<!--                            </el-image>-->
                            <el-image class="product--image" fit="cover"
                                      :src="(item.images_product[0].path)">
                            </el-image>
                        </transition>


                        <div class="product-list__size">
                            <div
                                v-for="itemSize in item['options_product'].filter((a, i) => item['options_product'].findIndex((s) => a.id_size === s.id_size) === i)"
                                class="product-size__item">
                                {{ itemSize['size']['title'] }}
                            </div>
                        </div>
                    </div>
                    <div class="product-grid__content">
                        <div class="product-grid__options">
                            <div class="options-color">
                                <div
                                    v-for="itemColor in item['options_product'].filter((a, i) => item['options_product'].findIndex((s) => a.id_color === s.id_color) === i)"
                                    class="option-color__item">
                                    <div class="product-color__item"
                                         v-bind:style="{'background-color':itemColor['color']['value']}"></div>
                                </div>
                            </div>
                        </div>
                        <h3 class="product-grid__title">
                            <a>
                                {{ item.name }}
                            </a>
                        </h3>
                        <div class="product-grid__prices">
                            <div rel-script="product-price" data-price="299000" data-compare-price="299000"
                                 data-sale="1"
                                 class="product-prices"><span
                                style="color: red; margin-left: 10px;">{{ item.disksCount }}</span>
                                <del>{{ item['options_product'][0].price | toThousandFilter }} đ</del>
                                <ins>{{ item['options_product'][0].price | toThousandFilter }} đ</ins>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </VueSlickCarousel>
    </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
//   optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
//   optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import ApiService from "../../../backend/common/api.service";

export default {
    components: {
        VueSlickCarousel
    },
    data() {
        return {
            hoverIndex: '',
            dataProduct: [],
            setting: {
                "dots": false,
                "infinite": false,
                "speed": 500,
                "slidesToShow": 4,
                "slidesToScroll": 4,
                "initialSlide": 2,
                "swipeToSlide": true,
                "responsive": [
                    {
                        "breakpoint": 1600,
                        "settings": {
                            "slidesToShow": 3,
                            "slidesToScroll": 3,
                            "infinite": true,
                            "dots": true
                        }
                    },
                    {
                        "breakpoint": 1024,
                        "settings": {
                            "slidesToShow": 2,
                            "slidesToScroll": 2,
                            "infinite": true,
                            "dots": true
                        }
                    },

                    {
                        "breakpoint": 600,
                        "settings": {
                            "slidesToShow": 2,
                            "slidesToScroll": 2,
                            "initialSlide": 2
                        }
                    },
                    {
                        "breakpoint": 480,
                        "settings": {
                            "slidesToShow": 2,
                            "slidesToScroll": 2
                        }
                    }
                ]
            }
        }
    },
    mounted() {
        this.getDataProduct()
    },
    methods: {
        getDataProduct() {
            ApiService.query('/api/admin/products', {page: 1, limit: 10}).then(({data}) => {
                if (data['success']) {
                    this.dataProduct = data['data']
                }
            })
        }
    }
}
</script>

<style>
.product-color__item {
    height: 25px;
    width: 50px;
    border-radius: 20px;
    border: 1px solid rgb(255, 255, 255, 0.5);

}

.home__page-product img {
    height: 100%;
    width: 100%;
    /*object-fit: cover;*/
}

.slick-prev:before, .slick-next:before {
    color: black;
    font-size: 30px;
}

.home__page-product:hover .product-list__size {
    visibility: visible;
    pointer-events: visible;
    transform: translateZ(0);
    opacity: 1;
    /*height: 60px;*/
    padding-top: 10px;
    background-color: rgb(0, 0, 0, 0.3);
}

.product-list__size {
    width: 100%;
    padding: 5px;
    position: absolute;
    z-index: 9;
    bottom: 0;
    display: flex;
    visibility: hidden;
    transform: translate3d(0, 20px, 0);
    transition: all .3s;
    opacity: 0;
}

.product-size__item {
    width: 40px;
    height: 30px;
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    border-radius: 5px;
    margin-right: 5px;
}

.home__page-product {
    height: 700px;
    position: relative;
    z-index: 1;
}

@media screen and (max-width: 700px) {
    .home__page-product {
        height: 350px;
    }

    .content__product {
        padding: 0 !important;
    }

    .slick-prev {
        left: 13px !important;
        z-index: 99999999999999999 !important;
    }

    .slick-next {
        right: 13px !important;
        z-index: 99999999999999999 !important;
    }
}

.product__item {
    width: 100%;
    height: calc(100% - 60px);
    background-color: beige;
    /*background-image: url('https://media.coolmate.me/cdn-cgi/image/width=672,height=990,quality=85,format=auto/uploads/January2023/jogger-casual-xam-nhat2_60.jpg');*/
    background-size: cover;
    background-position: center;
    border-radius: 10px;
    transition: all linear;
    position: relative;
}

/*.product__item:hover{*/
/*    background-image: url('https://media.coolmate.me/cdn-cgi/image/width=672,height=990,quality=85,format=auto/uploads/September2022/jogger-casual-xam-nhat1_79.jpg') ;*/
/*}*/

.home__page-product {
    padding: 10px;
}

.product__list-color {
    margin-top: 10px;
    height: 20px;
    width: 100%;
    display: flex;
}

.color__item {
    height: 20px;
    width: 35px;
    background-color: black;
    border: 1px solid rgb(0, 0, 0, 0.2);
    border-radius: 8px;
    margin-right: 5px;
}

.product-size__item:hover {
    background-color: #000;
    color: #fff;
}

.content__product {
    padding: 50px;
}

#colorItem {
    background-color: #2F5ACF;
}
.product--image{
    width: 100%;
    height: 100%;
}
</style>
