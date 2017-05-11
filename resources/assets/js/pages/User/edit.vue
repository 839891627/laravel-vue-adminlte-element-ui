<template>
  <el-col :span='6'>
    <el-form ref="form" :model="form" :rules='rules' label-width="80px">
      <el-form-item label="用户名" prop='name'>
        <el-input v-model="form.name"></el-input>
      </el-form-item>
      <el-form-item label="邮箱" prop='email'>
        <el-input v-model="form.email" :disabled='true'></el-input>
      </el-form-item>
      <el-form-item label="密码" prop='password'>
        <el-input type='password' v-model="form.password"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onUpdate">更新</el-button>
        <el-button @click='cancel'>取消</el-button>
      </el-form-item>
    </el-form>
  </el-col>
</template>
<script>
  export default {
    data() {
      return {
        form: {
          id: '',
          name: '',
          email: '',
          password: '',
        },
        rules: {
          name: [{
            required: true,
            message: '请输入用户名'
          }],
          password: [{
            required: true,
            message: '密码必填'
          }, {
            min: 3,
            max: 12,
            message: '密码长度在3-12个字符'
          }]
        }
      }
    },
    created () {
      this.getUser(this.$route.params.id)
    },
    methods: {
      getUser (id) {
        this.$http.get('/user/' + id).then((ret) => {
          this.form.id = ret.data.data.id
          this.form.name = ret.data.data.name
          this.form.email = ret.data.data.email
        })
      },
      onUpdate () {
        this.$refs['form'].validate((valid) => {
          if (valid) {
            this.$http.patch('/user/' + this.form.id, {
              name: this.form.name,
              password: this.form.password
            }).then((ret) => {
              let data = ret.data
              if (data.status_code == 422) {
                this.$message.error(data.message);
              } else {
                this.$message.success(data.message);
                this.$router.push('/user')
              }
            })
          } else {
            this.$message.error('格式不正确！');
          }
        })
      },
      cancel () {
        this.$router.back()
      }
    }
  }

</script>
