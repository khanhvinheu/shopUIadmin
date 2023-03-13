<template>
    <div class="container" style="display: flex; align-items: center; flex-direction: column; position: relative; padding-bottom: 50px">
        <img width="400" src="/img/success.gif">
        <div style="position: absolute; bottom: 0; display: flex; flex-direction: column; text-align:center ; ">
            <span style="font-weight: bold; font-size: 20px; color: #239a1a;">Đơn hàng: {{$route.params.order_code}}</span>
            <span style="font-weight: bold; font-size: 20px; color: #239a1a;">Đã đặt hàng thành công, Cảm ơn quý khách đã ủng hộ</span>
            <span style="color: rgb(0,0,0,0.2)">Quí khách vui lòng thường xuyên kiểm tra điện thoại, để bên giao hàng dễ dàng liên hệ</span>
            <el-button @click="$router.push({name:'home'})" style="margin-top: 10px">
                <i class="el-icon-shopping-cart-2"></i>
                Tiếp tục mua sắm</el-button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "OrderSuccess"
    }
</script>

<style scoped>

</style>
