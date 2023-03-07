<template>
    <div class="site-content">
        <div class="container" v-if="$store.getters.shoppingCart.cart.length">
            <div class="grid">
                <div class="grid__column seven-twelfths mobile--one-whole cart-left-section">
                    <div class="cart-section">
                        <div class="title-with-actions">
                            <div class="title">
                                Thông tin vận chuyển
                            </div>
                        </div>
                        <div id="customer-info-block" customerinfo="[object Object]">
                            <div class="grid">
                                <div class="grid__column six-twelfths">
                                    <el-input placeholder="Họ và tên"></el-input>
                                </div>
                                <div class="grid__column six-twelfths">
                                    <el-input placeholder="Số điện thoại"></el-input>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="grid__column">
                                    <el-input placeholder="Email"></el-input>
                                </div>
                                <div class="grid__column">
                                    <div class="address-block">
                                        <el-input placeholder="Địa chỉ (ví dụ: 103 Vạn Phúc, phường Vạn Phúc)"></el-input>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="grid">-->
<!--                                <div class="grid__column four-twelfths mobile&#45;&#45;one-whole">-->
<!--                                    <div dir="auto" class="v-select vue-select vs&#45;&#45;single vs&#45;&#45;searchable"-->
<!--                                         name="nhanh_city">-->
<!--                                        <el-select style="width: 100%" placeholder="Chọn Tỉnh/ Thành Phố">-->
<!--                                            <el-option-->
<!--                                                v-for="item in 10"-->
<!--                                                :key="item"-->
<!--                                                :label="item"-->
<!--                                                :value="item">-->
<!--                                            </el-option>-->
<!--                                        </el-select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="grid__column four-twelfths mobile&#45;&#45;one-whole">-->
<!--                                    <div dir="auto" class="v-select vue-select vs&#45;&#45;single vs&#45;&#45;searchable"-->
<!--                                         name="nhanh_district">-->
<!--                                        <el-select style="width: 100%" placeholder="Chọn Quận / Huyện">-->
<!--                                            <el-option-->
<!--                                                v-for="item in 10"-->
<!--                                                :key="item"-->
<!--                                                :label="item"-->
<!--                                                :value="item">-->
<!--                                            </el-option>-->
<!--                                        </el-select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="grid__column four-twelfths mobile&#45;&#45;one-whole">-->
<!--                                    <div dir="auto" class="v-select vue-select vs&#45;&#45;single vs&#45;&#45;searchable"-->
<!--                                         name="nhanh_ward" id="nhanh_ward">-->
<!--                                        <el-select style="width: 100%;"  placeholder="Chọn Phường/ Xã">-->
<!--                                            <el-option-->
<!--                                                v-for="item in 10"-->
<!--                                                :key="item"-->
<!--                                                :label="item"-->
<!--                                                :value="item">-->
<!--                                            </el-option>-->
<!--                                        </el-select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="grid">
                                <div class="grid__column">
                                    <el-input placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính)"></el-input>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="cart-section">
                        <div class="title"> Hình thức thanh toán</div>
                        <div>
                            <form>
                                <label for="payment-COD" class="payment-method__item active">
                                    <span class="payment-method__item-custom-checkbox custom-radio">
                                        <input type="radio" id="payment-COD" name="payment-method" autocomplete="off" value="COD">
                                        <span class="checkmark"> </span>
                                    </span>
                                    <span class="payment-method__item-icon-wrapper">
                                        <img src="/img/COD.svg" alt="COD <br>Thanh toán khi nhận hàng">
                                    </span>
                                    <span class="payment-method__item-name">COD <br>Thanh toán khi nhận hàng</span>
                                </label>
                                <label for="payment-momo" class="payment-method__item">
                                    <span class="payment-method__item-custom-checkbox custom-radio"><input type="radio" id="payment-momo" name="payment-method" autocomplete="off" value="momo">
                                        <span class="checkmark"></span>
                                    </span>
                                    <span class="payment-method__item-icon-wrapper">
                                        <img src="https://www.coolmate.me/images/momo-icon.png" alt="Thanh Toán MoMo">
                                    </span>
                                    <span class="payment-method__item-name">Thanh Toán MoMo</span>
                                </label>
                            </form>
                        </div>

                        <p class="cart-return-text">
                            Nếu bạn không hài lòng với sản phẩm của chúng tôi? Bạn hoàn toàn có thể trả lại sản phẩm.
                            Tìm hiểu thêm <a href="#" target="_blank"><b>tại đây</b></a>.
                        </p>
                    </div>
                    <input type="hidden" id="gclid_field" name="gclid_field" value="">
                    <div class="cart-section">
                        <button class="checkout-btn">
                            Thanh toán <span>{{TotalPrice |toThousandFilter }}</span> <span>(COD)</span></button>
                    </div>
                </div>
                <div class="grid__column five-twelfths mobile--one-whole">
                    <div class="cart-section">
                        <div class="title">
                            Giỏ hàng
                        </div>
                        <div>
                            <div class="cart-items">
                                <div class="cart-item" v-for="item in $store.getters.shoppingCart.cart" style="margin-bottom: 10px">
                                    <span class="cart-item__remove" @click="deleteItemCart(item.id)">✕</span>
                                    <div class="cart__column cart__column-left">
                                        <div class="cart-item__thumbnail-block">
                                            <img style="width: 120px; height: 140px; object-fit: cover"
                                            :src="item.images_product[0]['path']"
                                            :alt="item.name"
                                            class="cart-item__thumbnail">
                                        </div>
                                    </div>
                                    <div class="cart__column cart__column-right">
                                        <div class="cart-item__block">
                                            <div class="cart-item__info"><a
                                                target="_blank" class="cart-item__title">
                                                {{item.name}}
                                            </a>
                                                <div class="cart-item__variant">
                                                   {{item.payment.color.title}} / {{item.payment.size.title}}
                                                </div>
                                            </div>
                                            <div class="cart-item__actions">
                                                <div style="display: flex">
                                                    <div style="padding-right: 5px; padding-bottom: 5px"
                                                         class="v-select vue-select cart-item__select vs--single vs--unsearchable">
                                                           {{item.payment.price| toThousandFilter}} x{{item.payment.total}}
                                                    </div>
                                                </div>
                                                <div class="cart-item__actions-bottom">
                                                    <div class="quantity-box" style="display: flex">
                                                        <el-input :value="item.payment.total">
                                                            <template v-slot:append>
                                                                <el-button :disabled="item.payment.total>=10" @click="addItem(item)">+</el-button>
                                                            </template>
                                                            <template v-slot:prepend>
                                                                <el-button :disabled="item.payment.total<=1" @click="removeItem(item)">-</el-button>
                                                            </template>
                                                        </el-input>
                                                    </div>
                                                    <div class="flex flex--column"><span>
                                                            {{item.payment.price * item.payment.total | toThousandFilter}}đ
                                                     </span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <el-divider></el-divider>
                    <div class="pricing-info">
                        <div class="pricing-info__item">
                            <p>Tạm tính</p>
                            <p class="pricing-info__sub"><span>{{tempTotalPrice | toThousandFilter}}đ</span></p>
                        </div>
                        <div class="pricing-info__item">
                            <p>Giảm giá</p>
                            <p><span>0đ</span></p>
                        </div>

                        <div class="pricing-info__item">
                            <p>Phí giao hàng</p>
                            <p><span>Miễn phí</span></p>
                        </div>
                        <el-divider></el-divider>
                        <div class="pricing-info__item pricing-info__total">
                            <p>Tổng</p>
                            <p><span>{{TotalPrice | toThousandFilter}}đ</span> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex justify--center align--center" v-else>
           <span style="font-size: 20px"> Chưa có sản phẩm trong giỏ hàng ...</span>
        </div>
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex'
export default {
    name: "ShoppingCart",
    data(){
        return{
            num:1
        }
    },
    methods:{
        addItem(item){
            this.$store.dispatch("shoppingCart/pushItem", item);
        },
        removeItem(item){
            this.$store.dispatch("shoppingCart/removeItem", item);
        },
        deleteItemCart(item){
            this.$store.dispatch("shoppingCart/deleteFromCart", item);
        }
    },
    computed: {
        ...mapState([
            "cart"
        ]),
        ...mapGetters([
            "cartSize",
            "cartTotalAmount"
        ]),
        tempTotalPrice(){
            let total=0
            this.$store.getters.shoppingCart.cart.map(e=>{
                total+= e.payment.total*e.payment.price
            })
            return total

        },
        TotalPrice(){
            let total=0
            this.$store.getters.shoppingCart.cart.map(e=>{
                total+= e.payment.total*e.payment.price
            })
            return total

        }
    },
}
</script>

<style scoped>
.cart-item {
    position: relative;
    display: flex;
    flex-flow: row wrap;
    padding: 0;
}

.cart-item__remove {
    cursor: pointer;
    position: absolute;
    top: 0;
    right: 0;
    transition: all .2s;
    z-index: 3;
}

.cart-item__title {
    font-weight: 700;
    font-size: .9rem;
    max-width: 85%;
    display: block;
}

.pricing-info__item {
    display: flex;
    justify-content: space-between;
}

.cart-item__thumbnail {
    border-radius: 20px;
}

.cart-item__thumbnail-block {
    position: relative;
    width: 126px;
}

.payment-method__item {
    display: flex;
    align-items: center;
    border: 1px solid #D9D9D9;
    border-radius: 16px;
    padding: 15px 20px;
    cursor: pointer;
    transition: .2s all;
    opacity: .6;
}

.payment-method__item-icon-wrapper img {
    min-width: 35px;
    max-height: 35px;
    max-width: 55px;
}

.payment-method__item.active,
.payment-method__item:not(.disabled):hover {
    border: 1px solid #2f5acf;
    opacity: 1;
}

.checkout-btn {
    border-radius: 16px;
    height: 55px;
    width: 100%;
    padding: 15px 20px;
    background-color: #000;
    color: #fff;
    text-align: center;
    border: none;
    cursor: pointer;
    transition: all .2s;
}

.payment-method__item:not(:last-child) {
    margin-bottom: 1rem;
}

.cart-item__block {
    display: flex;
    height: 100%;
    flex-flow: row;
    flex-wrap: wrap;
}

.cart-item__select .vs__dropdown-toggle {
    display: inline-flex !important;
    padding: 3px 6px !important;
    height: 30px !important;
    border-radius: 8px !important;
    border: 1px solid #000 !important;
    margin-bottom: 5px !important;
}

.cart-item__actions {
    width: 100%;
    margin-top: auto;
    display: flex;
    flex-flow: column;
    flex-wrap: wrap;
}

.cart-item__variant {
    font-size: .8rem;
}

.cart-item__info {
    width: 100%;
}

.cart-item__actions-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: right;
}

.cart__column-right {
    margin-left: 1.5rem;
    flex: 3;
}

.cart-left-section {
    border-right: 1px solid #d9d9d9;
}
.payment-method__item-icon-wrapper {
    margin: 0 1.5rem;
}
</style>
