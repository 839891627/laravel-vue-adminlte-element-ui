<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <el-form ref="form" :model="form" label-width="80px" :rules="rules">
                            <el-form-item label="用户名" prop="name">
                                <el-input v-model="form.name" placeholder='请填写登录邮箱'></el-input>
                            </el-form-item>
                            <el-form-item label="密码" prop="password">
                                <el-input type="password" v-model="form.password"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="login">登录</el-button>
                                <el-button @click='reset'>取消</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

  export default {
    data () {
      return {
        form: {
          name: '',
          password: ''
        },
        rules: {
          name: [{
            required: true,
            message: '用户名必填'
          },{
            type: 'email',
            message: '邮箱格式不正确'
          }],
          password: [{
            required: true,
            message: '密码必填'
          },{
            min: 3,
            max: 12,
            message: '密码长度在3-12个字符'
          }]
        }
      }
    },
    methods: {
      login () {
        this.$refs['form'].validate((valid) => {
          if (valid) {
            let name = this.form.name
            let password = this.form.password
            this.$http.post('/login').then((ret) => {
                this.$router.push('/')
            })
          } else {
            alert('格式错误！');
            return false
          }
        })
      },
      reset () {
        this.$refs['form'].resetFields()
      }
    }
  }
</script>
