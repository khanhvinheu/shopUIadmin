<template>
    <div v-loading="loading" class="container container--medium" style="padding-top: 10px;">
        <div style="padding-bottom: 20px" v-if="dataProductDetail">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }">Trang chủ</el-breadcrumb-item>
                <el-breadcrumb-item><a href="#">{{dataProductDetail.category.title}}</a></el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <el-row v-if="dataProductDetail" :gutter="10">
            <el-col :sm="12" :xs="24" :lg="12">
                <div class="list--product_image">
                    <VueSlickCarousel
                        v-if="dataProductDetail"
                        ref="c1"
                        v-bind="settingsC1"
                        @afterChange="change"
                        :asNavFor="$refs.c2"
                        :focusOnSelect="true">
                        <div class="box--image" v-for="item in dataProductDetail['images_product']" :key="item.id" >
                            <el-image :preview-src-list="dataProductDetail['images_product'].map(e=>e.path)"
                                      fit="cover" class="image--product" :src="item.path">
                            </el-image>
                        </div>
                    </VueSlickCarousel>

                    <div style="position: absolute; top:10px; left: 10px">
                        <div class="image--item" v-bind:class="{'item-active':itemActive== i}" v-for="(item,i) in dataProductDetail['images_product']" :key="item.id" @click="changeItemSlide(i)" >
                            <el-image style="height: 100%; width: 100%" fit="cover" :src="item.path" lazy></el-image>
                        </div>
                    </div>

                    <el-button circle type="circle" style="position: absolute; top: 50%; left: 10px; background-color: rgb(0,0,0,0.5); border: none; color:#fff" size="mini" :disabled="itemActive==0" @click="$refs.c1.prev()">
                        <i class="el-icon-caret-left"></i>
                    </el-button>
                    <el-button circle type="circle" style="position: absolute; top: 50%; right: 10px; background-color: rgb(0,0,0,0.5); border: none; color:#fff" size="mini" :disabled="itemActive==dataProductDetail['images_product'].length -1 " @click="$refs.c1.next()">
                        <i class="el-icon-caret-right"></i>
                    </el-button>

                </div>
            </el-col>
            <el-col :sm="12" :xs="24" :lg="12" >
                <div class="name--product">
                    <span style="font-size: 18px; font-weight: bold">{{dataProductDetail.name}}</span>
                </div>
                <div class="price--product">
                    <span style="font-size: 18px; font-weight: bold">{{price | toThousandFilter}} đ</span>
                </div>
                <div class="color--product">
                    <span>Màu sắc: {{colorSelect.title}}</span>
                    <span style="font-size: 18px; font-weight: bold"></span>
                </div>

                <div class="options--product_color">
                    <div v-for="(item,i) in listColorProduct"
                         :key="i"
                         class="item--color"
                         v-bind:class="{'active-color':(item['color']['id'] == colorSelect['id'])}"
                         >
                        <div style="height: 100%; width: 100%"  @click="changeColor(item['color'])"
                              v-bind:style="{'background-color':item['color']['value']}">
                        </div>
                    </div>
                </div>
                <div class="color--product">
                    <span>Kích thước: {{sizeSelect.title}}</span>
                    <span style="font-size: 18px; font-weight: bold"></span>
                </div>

                <div class="options--product_size">
                    <div v-for="(item,i) in dataProductDetail['options_product'].filter((a, i) => dataProductDetail['options_product'].findIndex((s) => a.id_size === s.id_size) === i)" :key="i"
                         class="item--size" v-bind:class="{'active-size':item['size']['id']==sizeSelect.id}">
                        <div style="height: 100%; width: 100%;background-color:grey "  @click="changeSize(item['size'])">
                            {{item['size']['title']}}
                        </div>

                    </div>
                </div>

                <div style="padding-top: 10px">
                    <el-input-number :min="1" :max="10" v-model="total"></el-input-number>
                    <el-button :disabled="!colorSelect" @click="colorSelect && addCart(dataProductDetail)" style="width: calc(100% - 200px); background-color: #B22D29; color:#fff;">{{colorSelect?'Mua ngay':'Chọn màu'}}</el-button>
                </div>

                <el-divider></el-divider>

                <div class="product-single__policy">
                    <div class="product-policy">
                        <div class="product-policy__item">
                            <div class="product-policy__icon"><img src="https://www.coolmate.me/images/icons/icon3.svg"
                                                                   alt="Đổi trả với số điện thoại"></div>
                            <span class="product-policy__title">
                                Đổi trả cực dễ<br> chỉ cần số điện thoại
                            </span></div>
                        <div class="product-policy__item">
                            <div class="product-policy__icon"><img src="https://www.coolmate.me/images/icons/icon4.svg"
                                                                   alt="Miễn phí vận chuyển"></div>
                            <span class="product-policy__title">
                                Miễn phí vận chuyển<br> cho đơn hàng trên 200k
                            </span></div>
                        <div class="product-policy__item">
                            <div class="product-policy__icon"><img src="https://www.coolmate.me/images/icons/icon5.svg"
                                                                   alt="Đổi hàng trong 60 ngày"></div>
                            <span class="product-policy__title">
                                60 ngày đổi trả<br> vì bất kỳ lý do gì
                             </span></div>
                        <div class="product-policy__item">
                            <div class="product-policy__icon"><img src="https://www.coolmate.me/images/icons/icon2.svg"
                                                                   alt="Hotline 1900.27.27.37" style="width: 25px;">
                            </div>
                            <span class="product-policy__title">
                            Hotline 1900.27.27.37 <br>
                            hỗ trợ từ 8h30 - 22h mỗi ngày
                            </span>
                        </div>
                        <div class="product-policy__item">
                            <div class="product-policy__icon"><img src="https://www.coolmate.me/images/icons/icon1.svg"
                                                                   alt="Trả hàng tận nơi"></div>
                            <span class="product-policy__title">
                            Đến tận nơi nhận hàng trả,<br> hoàn tiền trong 24h
                            </span>
                        </div>
                        <div class="product-policy__item">
                            <div class="product-policy__icon"><img src="https://www.coolmate.me/images/icons/icon6.svg"
                                                                   alt="Giao hàng"></div>
                            <span class="product-policy__title">
                            Giao hàng nhanh toàn quốc
                            </span>
                        </div>
                    </div>
                </div>

                <el-collapse accordion value="1">
                    <el-collapse-item name="1">
                        <template slot="title">
                            <span style="font-weight: bold; font-size: 15px; padding-right: 5px">Thông tin chi tiết </span><i class="header-icon el-icon-info"></i>
                        </template>
                        <div class="content-detail" style="padding-left: 10px">
                            <span v-html="dataProductDetail.description">
                            </span>
                        </div>
                    </el-collapse-item>
                </el-collapse>
            </el-col>

        </el-row>
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex'
    import ApiService from "../../../backend/common/api.service";
    import VueSlickCarousel from 'vue-slick-carousel'
    import 'vue-slick-carousel/dist/vue-slick-carousel.css'
    // optional style for arrows & dots
    import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
    export default {
        name: "ProductDetail",
        components: { VueSlickCarousel },
        data(){
            return  {
                total:1,
                dataProductDetail:'',
                loading:false,
                settings:{
                    "dotsClass": "slick-dots custom-dot-class",
                    "centerMode": true,
                    "centerPadding": "30px",
                    "dots": false,
                    "infinite": false,
                    "slidesToShow": 3,
                    "slidesToScroll": 1,
                    "vertical": true,
                    "verticalSwiping": true,
                    "swipeToSlide": false,
                    "arrows": false,
                },
                settingsC1:{
                    "dots": false,
                    "edgeFriction": 0.35,
                    "infinite": false,
                    "slidesToShow": 1,
                    "slidesToScroll": 1,
                    "arrows": false,
                },
                itemActive:'',
                colorSelect:'',
                sizeSelect:'',
                listColorProduct:'',
                price:''

            }
        },
        mounted() {
            this.getListDataDetail()
        },

        watch:{
            sizeSelect(size){
                this.listColorProduct=this.dataProductDetail['options_product'].filter(e=>e.size.id==size.id)
                this.colorSelect=''
            },
            colorSelect(color){
                this.price=this.dataProductDetail['options_product'].find(e=>(e.size.id==this.sizeSelect.id && e.color.id==color.id)).price
            }

        },

        methods:{
            changeColor(item){
              this.colorSelect = item
            },
            changeSize(item){
              this.sizeSelect = item
            },
            changeImage(){
                console.log('--')
            },
            change(e){
                this.itemActive= e
            },
            changeItemSlide(i){
                this.$refs.c1.goTo(i)
                this.itemActive = i
            },
            getListDataDetail(){
                this.loading=true
                ApiService.query('/api/admin/products/'+this.$route.params.id).then(({data})=>{
                    this.dataProductDetail = data['data']
                    this.sizeSelect = data['data']['options_product'][0]['size']
                    this.listColorProduct = data['data']['options_product'].filter(e=>e.size.id ==data['data']['options_product'][0]['size']['id'])
                    this.price = data['data']['options_product'][0]['price']
                    this.loading = false
                })
            },
            addCart(item){
                this.$store.dispatch("shoppingCart/addToCart", item);
                this.$notify({
                    title: 'Success',
                    message: 'Thêm sản phẩm vào giỏ hàng thành công',
                    type: 'success'
                });
            }
        },

        computed: {
            ...mapState([
                "cart"
            ]),
            ...mapGetters([
                "cartSize",
                "cartTotalAmount",
            ]),


        },
    }
</script>

<style>
    .trigger{
        position: absolute;
    }
    .image--item{
        height: 50px;
        width: 50px;
        padding: 2px;
        margin: 5px;
        opacity: 0.5;
        cursor: pointer;
    }
    .item-active{
        border: 1px solid rgb(0,0,0,0.3);
        border-radius: 5px;
        opacity: 1;
    }
    .list--product_image{
        position: relative;
    }
    .box--image{
        width: 100%;
        height: 800px;
        border-radius: 20px;
    }
    .image--product{
        width: 100%;
        height: 800px;
        border-radius: 20px;
    }
    .item--color{
        height: 32px;
        width: 60px;
        border-radius: 10px;
        padding: 5px;
        margin-right: 5px;
        color: #fff;
        text-align: center;
    }
    .item--size{
        height: 32px;
        width: 60px;
        border-radius: 10px;
        padding: 5px;
        margin-right: 5px;
        color: #fff;
        text-align: center;
    }
    .active-color{
        border: 1px solid rgb(0,0,0,0.2);
    }
    .active-size{
        border: 1px solid rgb(0,0,0,0.2);
    }
    .options--product_color{
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        width: 500px;
    }
    .product-policy__item{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: calc(90% / 3);
        padding: 5px;
        margin: 5px;
        background-color: rgb(0,0,0,0.03);
        border-radius: 10px;
        text-align: center;
    }
    .product-policy{
        display: flex;
        flex-wrap: wrap;
    }
    .options--product_size{
        display: flex;
    }
</style>
