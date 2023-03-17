<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header" style="background-color: rgb(0,0,0,0.1);">
                    <h3 class="card-title"><i class="el-icon-setting"></i> Setting app</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <el-form label-position="right" label-width="100px">
                                <el-form-item label="Debug Mode">
                                    <el-switch
                                        :active-value="true"
                                        :inactive-value="false"
                                        v-model="DEBUG_APP"
                                        active-color="#13ce66"
                                        inactive-color="#ff4949">
                                    </el-switch>
                                </el-form-item>

                            </el-form>
                        </div>
                        <div class="block" style="margin-left: 0px;margin-right: 8px;padding: 10px;width: 100%">

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>

    </div>

</template>

<script>
import appConfig from '/config/appConfig.json'
import ApiService from "../../common/api.service";

export default {
    data() {
        return {
            DEBUG_APP:'',
            fistLoad:true,
        }
    },
    watch:{
        DEBUG_APP(e){
            !this.fistLoad && this.updateSetting()
            this.fistLoad=false
        }
    },
    mounted() {
       this.fetchSetting()
    },
    methods: {
        fetchSetting(){
            let _this = this
            ApiService.query('/api/admin/setting/fetchSetting').then(({data})=>{
                _this.DEBUG_APP = data['data']['DEBUG_APP']
            })
        },
        updateSetting(){
            let _this = this
            let form = new FormData()
            form.append('DEBUG_APP', this.DEBUG_APP)
            ApiService.post('/api/admin/setting/updateSetting',form) .then(function (response) {
                if(response.data['success']){
                    _this.$notify({
                        title: 'Success',
                        message: response.data['mess'],
                        type: 'success'
                    });
                }else{
                    _this.$notify({
                        title: 'Error',
                        message: response.data['mess'],
                        type: 'error'
                    });
                }

            });
        }
    }
};
</script>

<style>

</style>
