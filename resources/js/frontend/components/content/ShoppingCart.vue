<template>
    <div class="site-content">
        <div class="container">
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
                            <div class="grid">
                                <div class="grid__column four-twelfths mobile--one-whole">
                                    <div dir="auto" class="v-select vue-select vs--single vs--searchable"
                                         name="nhanh_city">
                                        <el-select style="width: 100%" v-model="value" placeholder="Chọn Tỉnh/ Thành Phố">
                                            <el-option
                                                v-for="item in options"
                                                :key="item.value"
                                                :label="item.label"
                                                :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <div class="grid__column four-twelfths mobile--one-whole">
                                    <div dir="auto" class="v-select vue-select vs--single vs--searchable"
                                         name="nhanh_district">
                                        <el-select style="width: 100%" v-model="value" placeholder="Chọn Quận / Huyện">
                                            <el-option
                                                v-for="item in options"
                                                :key="item.value"
                                                :label="item.label"
                                                :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <div class="grid__column four-twelfths mobile--one-whole">
                                    <div dir="auto" class="v-select vue-select vs--single vs--searchable"
                                         name="nhanh_ward" id="nhanh_ward">
                                        <el-select style="width: 100%;"  v-model="value" placeholder="Chọn Phường/ Xã">
                                            <el-option
                                                v-for="item in options"
                                                :key="item.value"
                                                :label="item.label"
                                                :value="item.value">
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="grid__column">
                                    <el-input placeholder="Ghi chú thêm (Ví dụ: Giao hàng giờ hành chính)"></el-input>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="cart-section">
                        <div class="title">
                            Hình thức thanh toán
                        </div>
                        <div>
                            <form>
                                <label for="payment-COD" class="payment-method__item active">
                                    <span class="payment-method__item-custom-checkbox custom-radio">
                                        <input type="radio" id="payment-COD" name="payment-method" autocomplete="off"
                                               value="COD"> <span class="checkmark"></span></span> <span
                                    class="payment-method__item-icon-wrapper"><img src="/img/COD.svg"
                                                                                   alt="COD <br>Thanh toán khi nhận hàng"></span>
                                    <span class="payment-method__item-name">COD <br>Thanh toán khi nhận
                                        hàng</span></label><label for="payment-momo" class="payment-method__item"><span
                                class="payment-method__item-custom-checkbox custom-radio"><input type="radio"
                                                                                                 id="payment-momo" name="payment-method" autocomplete="off" value="momo">
                                        <span class="checkmark"></span></span> <span
                                class="payment-method__item-icon-wrapper"><img
                                src="https://www.coolmate.me/images/momo-icon.png"
                                alt="Thanh Toán MoMo"></span>
                                <span class="payment-method__item-name">Thanh Toán MoMo</span></label><label
                                for="payment-zalopay" class="payment-method__item"><span
                                class="payment-method__item-custom-checkbox custom-radio"><input type="radio"
                                                                                                 id="payment-zalopay" name="payment-method" autocomplete="off"
                                                                                                 value="zalopay"> <span class="checkmark"></span></span> <span
                                class="payment-method__item-icon-wrapper"><img
                                src="https://www.coolmate.me/images/logo-zalopay.svg"
                                alt="Ví điện tử ZaloPay"></span>
                                <span class="payment-method__item-name">Ví điện tử ZaloPay</span></label><label
                                for="payment-shopeepay" class="payment-method__item"><span
                                class="payment-method__item-custom-checkbox custom-radio"><input type="radio"
                                                                                                 id="payment-shopeepay" name="payment-method" autocomplete="off"
                                                                                                 value="shopeepay"> <span class="checkmark"></span></span>
                                <span class="payment-method__item-icon-wrapper"><img
                                    src="https://mcdn.coolmate.me/image/September2021/195dbf69c0ac36f26fbd_(1).png"
                                    alt="Ví ShopeePay <br><i>Giảm thêm 50k cho khách hàng lần đầu mở ví và thanh toán bằng ShopeePay</i>"></span>
                                <span class="payment-method__item-name">Ví ShopeePay <br><i>Giảm thêm 50k cho khách
                                            hàng lần đầu mở ví và thanh toán bằng ShopeePay</i></span></label><label
                                for="payment-vnpay" class="payment-method__item"><span
                                class="payment-method__item-custom-checkbox custom-radio"><input type="radio"
                                                                                                 id="payment-vnpay" name="payment-method" autocomplete="off" value="vnpay">
                                        <span class="checkmark"></span></span> <span
                                class="payment-method__item-icon-wrapper"><img
                                src="https://www.coolmate.me/images/vnpay.png"
                                alt="Thẻ ATM / Internet Banking<br>Thẻ tín dụng (Credit card) / Thẻ ghi nợ (Debit card)<br>VNPay QR"></span>
                                <span class="payment-method__item-name">Thẻ ATM / Internet Banking<br>Thẻ tín dụng
                                        (Credit card) / Thẻ ghi nợ (Debit card)<br>VNPay QR</span></label><label
                                for="payment-9pay" class="payment-method__item"><span
                                class="payment-method__item-custom-checkbox custom-radio"><input type="radio"
                                                                                                 id="payment-9pay" name="payment-method" autocomplete="off" value="9pay">
                                        <span class="checkmark"></span></span> <span
                                class="payment-method__item-icon-wrapper"><img
                                src="https://mcdn.coolmate.me/uploads/May2022/9pay.svg"
                                alt="Ví điện tử 9Pay"></span>
                                <span class="payment-method__item-name">Ví điện tử 9Pay</span></label>
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
                            Thanh toán <span>329k</span> <span>(COD)</span></button>
                    </div>
                </div>
                <div class="grid__column five-twelfths mobile--one-whole">
                    <div class="cart-section">
                        <div class="title">
                            Giỏ hàng
                        </div>
                        <div>
                            <div class="dummy-cart-items" style="display: none;">
                                <div class="grid dummy-cart-item">
                                    <div class="grid__column four-twelfths flex">
                                        <div class="dummy-cart-item__thumbnail-block">
                                            <div class="dummy-cart-item__thumbnail"></div>
                                            <span class="dummy-cart-item__thumbnail-quantity"></span>
                                        </div>
                                    </div>
                                    <div class="grid__column eight-twelfths">
                                        <div class="dummy-cart-item__block">
                                            <div class="dummy-cart-item__info">
                                                <div class="dummy-cart-item__title"></div>
                                                <div class="dummy-cart-item__variant"></div>
                                            </div>
                                            <div class="dummy-cart-item__actions">
                                                <div class="dummy-cart-item__price"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-items">
                                <div class="cart-item" v-for="item in $store.getters.shoppingCart.cart" style="margin-bottom: 10px">
                                    <span class="cart-item__remove">✕</span>
                                    <div class="cart__column cart__column-left">
                                        <div class="cart-item__thumbnail-block">
                                            <img
                                            src="https://media.coolmate.me/cdn-cgi/image/width=320,height=362,quality=80/image/January2023/sQuan_Jogger_Nam_tui_hop_Cargo_Outdoor_-_Xam_5.jpg"
                                            alt="Quần Jogger nam túi hộp Cargo Outdoor"
                                            class="cart-item__thumbnail">
                                        </div>
                                    </div>
                                    <div class="cart__column cart__column-right">
                                        <div class="cart-item__block">
                                            <div class="cart-item__info"><a
                                                href="/product/quan-jogger-nam-tui-hop-cargo-outdoor"
                                                target="_blank" class="cart-item__title">
                                                Quần Jogger nam túi hộp Cargo Outdoor
                                            </a>
                                                <div class="cart-item__variant">
                                                    Xám / M
                                                </div>
                                            </div>
                                            <div class="cart-item__actions">
                                                <div style="display: flex">
                                                    <div style="padding-right: 5px; padding-bottom: 5px"
                                                         class="v-select vue-select cart-item__select vs--single vs--unsearchable">
                                                        <el-select size="small" v-model="value" placeholder="Select">
                                                            <el-option
                                                                v-for="item in options"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                    <div dir="auto"
                                                         class="v-select vue-select cart-item__select vs--single vs--unsearchable">
                                                        <el-select size="small" v-model="value" placeholder="Select">
                                                            <el-option
                                                                v-for="item in options"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                                <div class="cart-item__actions-bottom">
                                                    <div class="quantity-box">
                                                        <el-input-number size="small" v-model="num" :min="1" :max="10"></el-input-number>
                                                    </div>
                                                    <div class="flex flex--column"><span>
                                                            329.000đ
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
                            <p class="pricing-info__sub"><span>329.000đ</span>

                            </p>
                        </div>
                        <div class="pricing-info__item">
                            <p>Giảm giá</p>
                            <p class=""><span>0đ</span> </p>
                        </div>

                        <div class="pricing-info__item">
                            <p>Phí giao hàng</p>
                            <p class=""><span>Miễn phí</span></p>
                        </div>
                        <el-divider></el-divider>
                        <div class="pricing-info__item pricing-info__total">
                            <p>
                                Tổng</p>
                            <p class=""><span>329.000đ</span> </p>
                        </div>
                    </div>
                </div>
            </div>
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
    computed: {
        ...mapState([
            "cart"
        ]),
        ...mapGetters([
            "cartSize",
            "cartTotalAmount"
        ])
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
