"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[599],{8010:(t,a,e)=>{e.d(a,{Z:()=>i});var s=e(3645),r=e.n(s)()((function(t){return t[1]}));r.push([t.id,".main-login{align-items:center;background-color:#2d3a4b;display:flex;height:100vh;justify-content:center}.login-box{background-color:#fff;box-shadow:-16px 18px 0 5px rgba(222,222,222,.08);-webkit-box-shadow:-16px 18px 0 5px rgba(222,222,222,.08);-moz-box-shadow:-16px 18px 0 5px rgba(222,222,222,.08)}",""]);const i=r},599:(t,a,e)=>{e.r(a),e.d(a,{default:()=>n});const s={name:"login",data:function(){return{rules:{email:[{required:!0,message:"Vui lòng không bỏ trống",trigger:"blur"}],pass:[{required:!0,message:"Vui lòng không bỏ trống",trigger:"blur"}]},formData:{email:"",pass:""}}},methods:{login:function(){var t=this;this.$refs.formData.validate((function(a){if(!a)return!1;"admin@gmail.com"==t.formData.email&&"123456"==t.formData.pass?t.$router.push({name:"form"}):t.$message.error("Tài khoản hoặc mật khẩu chưa đúng! Vui lòng kiểm tra lại")}))}}};var r=e(3379),i=e.n(r),o=e(8010),l={insert:"head",singleton:!1};i()(o.Z,l);o.Z.locals;const n=(0,e(1900).Z)(s,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"main-login"},[e("div",{staticClass:"login-box"},[t._m(0),t._v(" "),e("div",{staticClass:"card-body login-card-body",staticStyle:{"background-color":"unset"}},[e("el-form",{ref:"formData",staticClass:"demo-ruleForm",attrs:{"label-position":"right","status-icon":"",model:t.formData,rules:t.rules}},[e("el-form-item",{attrs:{"inline-message":!0,prop:"email"}},[e("div",{staticClass:"form-group"},[e("el-input",{attrs:{type:"email","validate-event":"",placeholder:"Email"},model:{value:t.formData.email,callback:function(a){t.$set(t.formData,"email",a)},expression:"formData.email"}},[e("i",{staticClass:"el-input__icon el-icon-message",attrs:{slot:"prefix"},slot:"prefix"})])],1)]),t._v(" "),e("el-form-item",{attrs:{"inline-message":!0,prop:"pass"}},[e("div",{staticClass:"form-group"},[e("el-input",{attrs:{"show-password":"","validate-event":"",placeholder:"Password",type:"password"},model:{value:t.formData.pass,callback:function(a){t.$set(t.formData,"pass",a)},expression:"formData.pass"}},[e("i",{staticClass:"el-input__icon el-icon-lock",attrs:{slot:"prefix"},slot:"prefix"})])],1)])],1),t._v(" "),e("div",{staticClass:"row"},[t._m(1),t._v(" "),e("div",{staticClass:"col-4"},[e("el-button",{staticStyle:{background:"#ee4d2d",color:"#fff"},on:{click:function(a){return t.login()}}},[t._v("Sign In")])],1)])],1)])])}),[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"login-logo",staticStyle:{"margin-top":"20px","background-color":"unset"}},[e("a",{staticStyle:{color:"#ee4d2d"},attrs:{href:"/"}},[e("b",[t._v("HADO")]),t._v("VN")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"col-8"},[e("div",{staticClass:"icheck-primary"},[e("input",{attrs:{type:"checkbox",id:"remember"}}),t._v(" "),e("label",{attrs:{for:"remember"}},[t._v("\n                            Remember Me\n                        ")])])])}],!1,null,null,null).exports}}]);