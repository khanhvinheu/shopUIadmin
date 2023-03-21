<template>
    <div class="header-top">
    <header class="site-header " v-bind:class="{'is-scroll-top':hiddenHeader}">
        <div class="header__inner" style="border-bottom: 1px solid rgb(217, 217, 217);">
            <div class="header__toggle">
                <div class="menu-toggle" style="display: flex; align-items: center;">
                    <transition name="slide-fade">
                        <i v-if="showMenuMobile" style="font-size: 29px" class="el-icon-s-unfold" @click="showMenuMobile=!showMenuMobile"></i>
                        <i v-else style="font-size: 29px" class="el-icon-close" @click="showMenuMobile=!showMenuMobile"></i>
                    </transition>
                </div>
            </div>
            <div class="header__logo">
                <a href="/">
                    <img :src="$appSetting.LOGO_APP" alt="Logo HADOVN">
                </a>
            </div>
            <div class="header__menu-mobile" rel-script="header-menu" v-bind:style="{'display':showMenuMobile?'none':'block', 'visibility':showMenuMobile?'unset':'unset','opacity':showMenuMobile?1:1}">
                <div class="mobile--visible tablet--visible" style="display: none">
                    <div class="header-search-mobile" rel-script="header-search-content">
                        <form action="/collections" method="GET">
                            <div class="header-search__wrapper">
                                <label class="header-search__field">
                                    <input type="text" name="keyword" rel-script="spotlight-search-control"
                                           placeholder="Tìm kiếm sản phẩm..."
                                           class="header-search__control one-whole" autocomplete="off">
                                </label>
                                <div class="header-search__filter">
                                    <button class="header-search__submit">
                                        <i class="el-icon-search" style="font-size: 15px"></i>
                                    </button>
                                </div>
                                <a href="#" class="header-search__close"
                                   rel-script="spotlight-search-close">
                                </a>
                            </div>
                        </form>
                        <div class="spotlight-search">
                            <div class="spotlight-search__wrapper" rel-script="spotlight-search">
                                <img src="https://www.coolmate.me/images/icons/loading.svg" class="loading">
                            </div>
                        </div>
                    </div>
                    <div class="nav-tab">
                        <div class="nav-tab__head">
                            <a href="#san-pham" class="nav-tab__title is-current" rel-script="nav-tab">
                                Danh mục
                            </a>

                        </div>
                        <div class="nav-tab__content" data-nav-tab="#san-pham">
                            <div class="nav-tab__label"
                                 style="flex-flow: column;align-items: flex-start;padding-bottom: 10px">
                                <a href="/collections?itm_source=navbar">
                                    <b>Tất cả sản phẩm</b>
                                </a>
                            </div>
                            <ul class="nav-tab__menu">
                                <li class="nav__item nav__item--has-child" rel-script="mobile-menu-toggle" v-for="item in data">
                                    <a href="#">
                                        {{item.title}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="header__menu mobile--hidden tablet--hidden">
                <div>
                    <ul class="nav">
                        <li class="nav__item has-child" v-for="item in menuItem" @mouseover="menuActive=item.value; menuSubActive=''">
                            <a href="/?itm_source=navbar" rel-script="sub-menu">
                                {{item.title}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header__actions">
                <div class="header-actions__button">
                    <el-popover
                        placement="bottom-end"
                        trigger="hover"
                        width="430"
                    >
                        <mini-cart/>
                        <el-badge slot="reference" :value="$store.getters.shoppingCart.cart.length" class="item">
                            <i class="el-icon-sell" style="font-size: 25px"></i>
                        </el-badge>
                    </el-popover>

                </div>

            </div>
        </div>
        <div class="sub-header__menu mobile--hidden tablet--hidden" style="border-bottom: 1px solid rgb(217, 217, 217);">
            <div>
                <ul class="nav" v-show="menuActive==1">
                    <li @mouseover="menuSubActive=5" v-for="itemCatelogry in data" class="nav__item has-child"><a href="/?itm_source=navbar" rel-script="sub-menu">
                        {{itemCatelogry.title}}
                    </a></li>
                </ul>
                <ul class="nav"  v-show="menuActive==2">
                    <li rel-script="sub-menu" data-menu-id="84rising" class="nav__item"><a href="/84rising?itm_source=navbar">
                        84RISING
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="cm24" class="nav__item"><a href="/cm24?itm_source=navbar" class="-item" style="position: relative;">
                        CM24
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="cxp" class="nav__item"><a href="/lp/coolxprint-mo-hinh-dat-san-xuat-theo-yeu-cau?itm_source=navbar">
                        COOLXPRINT
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="about" class="nav__item"><a href="/page/coolmate-story?itm_source=navbar">
                        VỀ COOLMATE
                    </a></li>
                    <li rel-script="sub-menu" data-menu-id="blog" class="nav__item"><a href="/blog?itm_source=navbar">
                        BLOG
                    </a></li>
                </ul>
            </div>
        </div>
        <div class="mega-menu mega-menu--product" v-bind:class="{'active':menuActive==3}">
            <div class="mega-menu__wrapper">
                <div class="mega-menu__inner" style="max-width: 1200px;">
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="flex: 0 0 18%;"></div>
                    <div rel-script="mega-menu-item" class="mega-menu__item">
                        <ul rel-script="mega-menu-active">
                            <li><a href="/collection/coolmate-activewear?itm_source=navbar">
                                Coolmate Active
                            </a></li>
                            <li><a href="/collection/care-and-share?itm_source=navbar">
                                Care &amp; Share <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip9.png" alt="" style="height: 15px;"></span></a></li>
                            <li><a href="/collection/en-comics?itm_source=navbar">
                                Én Comics
                            </a></li>
                            <li><a href="/collection/vang-xam-comics?itm_source=navbar">
                                Vàng Xám Comics
                            </a></li>
                            <li><a href="/collection/vu-tru-ao-thun-marvel?itm_source=navbar">
                                Vũ trụ áo Marvel
                            </a></li>
                            <li><a href="/collection/coolmate-basics?itm_source=navbar">
                                Coolmate Basics
                            </a></li>
                            <li><a href="/collection/san-pham-moi-ben-vung?itm_source=navbar">
                                Sản phẩm bền vững
                            </a></li>
                        </ul>
                    </div>
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="display: flex; flex: 0 0 55%; gap: 30px;">
                        <div style="max-width: 240px;"><a href="/collection/care-and-share?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip3_96.jpg" alt="">
                                <div class="content">
                                    Care &amp; Share <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                        <div style="max-width: 240px;"><a href="/collection/san-pham-moi-ben-vung?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip0_2.jpg" alt="">
                                <div class="content">
                                    Sản phẩm bền vững <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                    </div>
                </div>
            </div>
            <div class="close-menu" @mouseover="menuSubActive=''; menuActive=''"></div>
        </div>
        <div class="mega-menu mega-menu--product" v-bind:class="{'active':menuSubActive==5}">
            <div class="mega-menu__wrapper">
                <div class="mega-menu__inner" style="max-width: 1200px;">
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="flex: 0 0 18%;"></div>
                    <div rel-script="mega-menu-item" class="mega-menu__item">
                        <ul rel-script="mega-menu-active">
                            <li><a href="/collection/coolmate-activewear?itm_source=navbar">
                                Coolmate Active
                            </a></li>
                            <li><a href="/collection/care-and-share?itm_source=navbar">
                                Care &amp; Share <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip9.png" alt="" style="height: 15px;"></span></a></li>
                            <li><a href="/collection/en-comics?itm_source=navbar">
                                Én Comics
                            </a></li>
                            <li><a href="/collection/vang-xam-comics?itm_source=navbar">
                                Vàng Xám Comics
                            </a></li>
                            <li><a href="/collection/vu-tru-ao-thun-marvel?itm_source=navbar">
                                Vũ trụ áo Marvel
                            </a></li>
                            <li><a href="/collection/coolmate-basics?itm_source=navbar">
                                Coolmate Basics
                            </a></li>
                            <li><a href="/collection/san-pham-moi-ben-vung?itm_source=navbar">
                                Sản phẩm bền vững
                            </a></li>
                        </ul>
                    </div>
                    <div rel-script="mega-menu-item" class="mega-menu__item" style="display: flex; flex: 0 0 55%; gap: 30px;">
                        <div style="max-width: 240px;"><a href="/collection/care-and-share?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip3_96.jpg" alt="">
                                <div class="content">
                                    Care &amp; Share <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                        <div style="max-width: 240px;"><a href="/collection/san-pham-moi-ben-vung?itm_source=navbar">
                            <div class="mega-menu__item-image"><img loading="lazy" src="https://mcdn.coolmate.me/image/March2023/mceclip0_2.jpg" alt="">
                                <div class="content">
                                    Sản phẩm bền vững <span><img src="https://mcdn.coolmate.me/image/March2023/mceclip3_3.png"></span>
                                </div>
                            </div>
                        </a></div>
                    </div>
                </div>
            </div>
            <div class="close-menu" @mouseover="menuSubActive=''; menuActive=''"></div>
        </div>
    </header>
    </div>

</template>
<script>
    import ApiService from "../../../backend/common/api.service";
    import MiniCart from "./MiniCart";
    export default {
        components:{MiniCart},
        data(){
            return{
                menuItem:[
                    {title:'DANH MỤC', value:1},
                    {title:'SẢN PHẨM MỚI', value:2},
                    {title:'VỀ CHÚNG TÔI', value:3},
                    {title:'LIÊN HỆ', value:3},
                    {title:'BLOG', value:3},
                ],
                menuActive:1,
                menuSubActive:'',
                hiddenHeader:false,
                showMenuMobile:true,
                data:[]
            }

        },
        mounted() {
            this.getList()
            window.addEventListener("scroll", this.handleScroll, { passive: true });
        },
        methods:{
            handleScroll(){
                this.hiddenHeader = window.scrollY > 100
                window.scrollY > 100 && (this.showMenuMobile=true)
            },

            getList(){
                let _this = this
                ApiService.query('/api/admin/categorys', {params:{type:'treeData'}}).then(({data})=>{
                    _this.data = data['data']
                })
            },

        }
    }
</script>
<style>
    .active{
        visibility: visible !important;
        opacity: 1 !important;
        top: unset !important;
        height: 100% !important;

    }
    .close-menu{
        pointer-events: visible;
        width: 100%;
        height: 100%;
    }
</style>
