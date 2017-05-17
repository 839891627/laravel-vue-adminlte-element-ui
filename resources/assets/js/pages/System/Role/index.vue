<template>
  <div class="role">
    <el-row>
      <el-button type="primary" icon="plus" @click="$router.push({name: 'system.role.add'})">添加</el-button>
    </el-row>
    <br>
    <el-row :gutter='20'>
      <el-table
        v-loading.body="loading"
        :data="roles"
        stripe
        style="width: 100%">
        <el-table-column
          prop="id"
          label="ID">
        </el-table-column>
        <el-table-column
          prop="display_name"
          label="角色名称">
        </el-table-column>
        <el-table-column
          prop="description"
          label="角色描述">
        </el-table-column>
        <el-table-column label="操作">
          <template scope="scope">
            <el-button
              size="small"
              icon="edit"
              @click="$router.push({name: 'system.role.edit', params: {id: scope.row.id}})"
            >
            </el-button>
            <el-button
              size="small"
              type="danger"
              icon="delete"
              @click="handleDelete(scope.$index, scope.row.id, scope.row.name)">
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-row>
    <br>
    <el-row :gutter='20'>
      <el-col :offset='5' :md='9'>
        <paginator @changePage='getRoles' :total='total' :current_page='current_page'
                   :per_page='per_page'></paginator>
      </el-col>
    </el-row>
  </div>
</template>

<script>
  import Paginator from '../../../components/Paginator.vue'

  export default {
    data() {
      return {
        roles: [],
        total: null,
        current_page: null,
        per_page: null,
        loading: true
      }
    },
    created () {
      this.getRoles(this.current_page, this.per_page)
    },
    methods: {
      getRoles (page = 1, pageSize = 10) {
        this.loading = true // 加载的圈圈
        this.$http.get('/system/role', {
          params: {
            pageSize: pageSize,
            page: page
          }
        }).then((ret) => {
          this.loading = false
          let data = ret.data
          this.roles = data.data
          this.total = data.meta.pagination.total
          this.current_page = data.meta.pagination.current_page
          this.per_page = data.meta.pagination.per_page
        })
      },
      handleDelete(index, id, name) {
        this.$confirm('确认删除角色: ' + name + '?', '警告', {
          confirmButtonText: '确认',
          cancelButtonText: '取消'
        }).then(() => {
          this.$http.delete('/system/role/' + id).then((ret) => {
            if (ret.data === 1) {
              this.roles.splice(index, 1)
              this.$message.success('删除成功！');
            } else {
              this.$message.error('删除失败！');
            }
          })
        }).catch(() => {
          this.$message.info('已取消删除')
        })
      }
    },
    components: {Paginator}
  };

</script>
