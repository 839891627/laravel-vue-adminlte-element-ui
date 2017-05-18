<template>
  <el-row>
    <el-col :span='12'>
      <el-form ref="form" :model="form" :rules='rules' label-width="80px">
        <el-form-item label="角色名" prop='name'>
          <el-input v-model="form.name" :disabled='true'></el-input>
        </el-form-item>
        <el-form-item label="角色显示名称" prop='display_name'>
          <el-input v-model="form.display_name"></el-input>
        </el-form-item>
        <el-form-item label="角色描述" prop='description'>
          <el-input type="textarea" v-model="form.description"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">更新</el-button>
          <el-button @click='cancel'>取消</el-button>
        </el-form-item>
      </el-form>
    </el-col>
  </el-row>
</template>
<script>
  export default {
    data() {
      return {
        form: {
          id: '',
          name: '',
          display_name: '',
          description: ''
        },
        rules: {
          name: [{
            required: true,
            message: '请输入角色码'
          }],
          display_name: [{
            required: true,
            message: '请输入角色显示名称'
          }]
        }
      }
    },
    created () {
      this.getRole(this.$route.params.id)
    },
    methods: {
      getRole(id) {
        this.$http.get('/system/role/' + id).then((ret) => {
          this.form.id = ret.data.data.id
          this.form.name = ret.data.data.name
          this.form.display_name = ret.data.data.display_name
          this.form.description = ret.data.data.description
        })
      },
      onSubmit() {
        this.$refs['form'].validate((valid) => {
          if (valid) {
            this.$http.patch('/system/role/' + this.form.id, {
              name: this.form.name,
              display_name: this.form.display_name,
              description: this.form.description
            }).then((ret) => {
              let data = ret.data
              if (data.status_code === 422) {
                this.$message.error(data.message + data.errors.name.join('-'));
              } else {
                this.$message.success('更新成功！');
                this.$router.push({name: 'system.role'})
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
