<template>
    <div>
        <div v-if="$store.getters.settingApp.setting.DEBUG_APP">
            Hệ thống đang bảo trì, Vui lòng quay lại sau
        </div>
        <div v-else>
            <app-header></app-header>
            <main class="site-homepage" style="padding-top: 50px;">
                <transition name="slide-fade">
                    <router-view></router-view>
                </transition>
            </main>
            <app-footer></app-footer>
        </div>

    </div>
</template>

<script>
import AppHeader from './layouts/Header';
import AppFooter from './layouts/Footer';
import ApiService from "../../backend/common/api.service";
import Vue from 'vue';
import appConfig from "../../../../public/config/appConfig.json";
import {mapState, mapGetters} from 'vuex'
export default {
    name: 'Index',
    components: {
        AppHeader,
        AppFooter,
    },
    beforeCreate(){
        ApiService.query('/api/admin/setting/fetchSetting').then(({data})=>{
            this.$store.dispatch("settingApp/setSetingApp", data['data']);
        })
    },
    mounted() {

    },
    computed:{
        ...mapState([
            "settingApp"
        ]),
        ...mapGetters([
            "settingApp",
        ]),
    }
}
</script>
<style scoped>
 @import '../../../css/home.css';


</style>
