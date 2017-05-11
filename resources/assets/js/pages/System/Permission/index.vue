<template>
  <div class="permission">
    <el-row>
      <el-button type="primary" icon="plus" @click="addData">添加</el-button>
    </el-row>
    <br>
    <el-row :gutter='20'>
      <el-table
        v-loading.body="loading"
        :data="permissions"
        stripe
        style="width: 100%">
        <el-table-column
          prop="id"
          label="ID">
        </el-table-column>
        <el-table-column
          prop="display_name"
          label="权限名称">
        </el-table-column>
        <el-table-column
          prop="description"
          label="权限描述">
        </el-table-column>
        <el-table-column label="操作">
          <template scope="scope">
            <el-button
              size="small"
              @click="handleEdit(scope.$index, scope.row)">编辑
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-row>
    <br>
    <el-row :gutter='20'>
      <el-col :push='15' :md='9'>
        <paginator @changePage='getPermissions' :total='total' :current_page='current_page'
                   :per_page='per_page'></paginator>
      </el-col>
    </el-row>

    <el-dialog title="修改" :visible.sync="dialogFormVisible" size="tiny">
      <el-form :model="dialog">
        <el-form-item label="权限名称" v-if="dialog.isAdd">
          <el-input v-model="dialog.name" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="权限显示名称">
          <el-input v-model="dialog.display_name" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="权限描述">
          <el-input type="textarea" v-model="dialog.description"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">取 消</el-button>
        <el-button type="primary" @click="updateData">确 定</el-button>
      </div>
    </el-dialog>

  </div>
</template>

<script>
  import Paginator from '../../../components/Paginator.vue'

  export default {
    data() {
      return {
        permissions: [],
        total: null,
        current_page: null,
        per_page: null,
        loading: true,
        dialogFormVisible: false,
        dialog: {
          row: '',
          id: '',
          display_name: '',
          description: '',
          isAdd: false
        }
      }
    },
    created () {
      this.getPermissions(this.current_page, this.per_page)
    },
    methods: {
      getPermissions (page = 1, pageSize = 10) {
        this.loading = true // 加载的圈圈
        this.$http.get('/system/permission', {
          params: {
            pageSize: pageSize,
            page: page
          }
        }).then((ret) => {
          this.loading = false
          let data = ret.data
          this.permissions = data.data
          this.total = data.meta.pagination.total
          this.current_page = data.meta.pagination.current_page
          this.per_page = data.meta.pagination.per_page
        })
      },
      handleEdit(index, row) {
        this.dialogFormVisible = true
        this.dialog.isAdd = false
        this.dialog.row = index
        this.dialog.id = row.id
        this.dialog.display_name = row.display_name
        this.dialog.description = row.description
      },
      addData () {
        this.dialogFormVisible = true
        this.dialog.isAdd = true
        this.clearDialog()
      },
      updateData () {
        if (this.dialog.id) {
          // 更新操作
          this.$http.patch('/system/permission/' + this.dialog.id, {
            display_name: this.dialog.display_name,
            description: this.dialog.description
          }).then((ret) => {

            // 更新视图
            this.permissions[this.dialog.row].display_name = this.dialog.display_name
            this.permissions[this.dialog.row].description = this.dialog.description

            this.$message.success('更新成功!');

            this.dialogFormVisible = false
            this.clearDialog()
          }).catch(() => {
            this.$message.error('更新失败！');
          })
        } else {
          // 新增操作
          this.$http.post('/system/permission', {
            name: this.dialog.name,
            display_name: this.dialog.display_name,
            description: this.dialog.description
          }).then((ret) => {
            // 更新视图
            this.permissions.unshift({
              'id': ret.data.id,
              'display_name': this.dialog.display_name,
              'description': this.dialog.description
            })

            this.$message.success('添加成功!');

            this.dialog.isAdd = false
            this.dialogFormVisible = false
            this.clearDialog()
          }).catch(() => {
            this.$message.error('添加失败！');
          })
        }
      },
      clearDialog () {
        // 清除 dialog
        this.dialog.id = ''
        this.dialog.name = ''
        this.dialog.display_name = ''
        this.dialog.description = ''
      }
    },
    components: {Paginator}
  };


</script>
