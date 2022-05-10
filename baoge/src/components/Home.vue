<template>
  <div class="home login-cont">
    <el-row :gutter="20" class="lgoin" :style="sgi">
      <el-col :span="6" :offset="9">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="0px" class="demo-ruleForm">
          <div class="grid-content bg-purple">
            <div>
              <el-form-item prop="username">
                <el-input
                  size="medium"
                  placeholder="请输入内容"
                  suffix-icon="el-icon-user"
                  v-model="ruleForm.username">
                </el-input>
              </el-form-item>
            </div>
            <div style="margin-top: 20px;">
              <el-form-item prop="password">
                <el-input
                  show-password
                  size="medium"
                  placeholder="请输入密码"
                  v-model="ruleForm.password">
                </el-input>
              </el-form-item>
            </div>
            <div style="margin-top: 20px;">
              <el-row>
                <el-col :span="12">
                  <el-form-item prop="inputcaptcha">
                    <el-input v-model="ruleForm.inputcaptcha" placeholder="请输入验证码"></el-input>
                  </el-form-item>
                </el-col>
                <el-col :span="2" :push="3">
                  <div id="v_container"></div>
                </el-col>
              </el-row>
            </div>
            <el-row style="margin-top: 20px;">
              <el-col :span="10">
                <el-button type="primary" @click="poot('ruleForm')" plain size="medium">登录</el-button>
              </el-col>
              <el-col :span="10">
                <el-button type="info" plain size="medium">注册</el-button>
              </el-col>
            </el-row>
          </div>
        </el-form>
      </el-col>
    </el-row>
  </div>
</template>
<script>
import { GVerify } from '../../static/js/verif'
export default {
  name: 'Home',
  data () {
    return {
      rules: {
        username: [
          {required: true, message: '请输入用户名称', trigger: 'blur'}
        ],
        password: [
          {required: true, message: '请输入密码', trigger: 'blur'}
        ],
        inputcaptcha: [
          {required: true, message: '请输入验证码', trigger: 'blur'}
        ]
      },
      sgi: {
        height: '50%',
        width: '100%',
        position: 'absolute',
        top: '0',
        left: '0',
        right: '0',
        bottom: '0',
        margin: 'auto'
      },
      ruleForm: {
        username: null,
        password: null,
        inputcaptcha: null
      },
      verifyCode: ''
    }
  },
  mounted () {
    this.verifyCode = new GVerify('v_container')
  },
  methods: {
    poot (formName) {
      this.$refs[formName].validate(valid => {
        if (!valid) {
          return false
        } else {
          var verifys = this.verifyCode.validate(this.ruleForm.inputcaptcha)
          if (!verifys) {
            this.$notify.error({
              title: '失败',
              message: '验证码错误',
              duration: 1000,
              onClose: () => {
                this.verifyCode.refresh()
              }
            })
            return false
          } else {
            this.$http.post('http://www.lime.com/admin/login/login', this.ruleForm, {emulateJSON: true}).then(function (response) {
              console.log(response.body)
            }, function (response) {
              console.log(response)
            })
          }
        }
      })
    }
  }
}
</script>
