<template>
    <el-col :span='6'>
        <el-form ref="form" :model="form" :rules='rules' label-width="80px">
            <el-form-item label="用户名" prop='name'>
                <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="邮箱" prop='email'>
                <el-input v-model="form.email"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop='password'>
                <el-input type='password' v-model="form.password"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">立即创建</el-button>
                <el-button>取消</el-button>
            </el-form-item>
        </el-form>
    </el-col>
</template>
<script>
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: '',
        },
        rules: {
            name: [{
                required: true,
                message: '请输入用户名'
            }],
            email: [{
                required: true,
                message: '请输入邮箱'
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
      onSubmit() {
        this.$http.post('/api/user/add', {
            name: this.form.name,
            email: this.form.email,
            password: this.form.password
        }).then((ret) => {
            console.log(ret.data)
        })
      }
    }
  }
</script>