<template>
    <div class="user">
        <el-row>
            <el-col :span='6'>
                <router-link :to="{name: 'user.add'}">
                    <el-button type='primary' icon='plus'>添加</el-button>
                </router-link>
            </el-col>
            <el-col :span="6" :offset='12'>
                <el-form :inline="true" :model="search" class="demo-form-inline">
                    <el-form-item label="用户名">
                        <el-input v-model="search.name" placeholder="用户名" @keyup.enter.native='doSearch'></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="doSearch">查询</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-row :gutter='20'>
            <el-table
                    v-loading.body="loading"
                    :data="users"
                    border
                    style="width: 100%">
                <el-table-column
                        label="ID"
                        width="180">
                    <template scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.id }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        label="姓名"
                        width="180">
                    <template scope="scope">
                        <el-popover trigger="hover" placement="top">
                            <p>姓名: {{ scope.row.name }}</p>
                            <p>邮箱: {{ scope.row.email }}</p>
                            <div slot="reference" class="name-wrapper">
                                <el-tag>{{ scope.row.name }}</el-tag>
                            </div>
                        </el-popover>
                    </template>
                </el-table-column>
                <el-table-column
                        label="创建时间"
                        width="180">
                    <template scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.created_at }}</span>
                    </template>
                </el-table-column>
                <el-table-column label="操作">
                    <template scope="scope">
                        <router-link :to="{name: 'user.edit', params: {id: scope.row.id}}">
                            <el-button
                                    size="small"
                                    @click="handleEdit(scope.row.id)">
                                编辑
                            </el-button>
                        </router-link>
                        <el-button
                                size="small"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row.id)">删除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-row>
        <el-row :gutter='20'>
            <paginator @changePage='getUsers' :total='total' :current_page='current_page'
                       :per_page='per_page'></paginator>
        </el-row>
    </div>
</template>

<script>
  import Paginator from '../../components/Paginator.vue'

  export default {
    data() {
      return {
            users: [],
            total: null,
            current_page: null,
            per_page: null,
            loading: true,
            search: {
              name: ''
            }
         }
    },
    created () {
        this.getUsers()
    },
    methods: {
      getUsers (page = 1, pageSize = 10, name = '') {
        this.loading = true // 加载的圈圈
        this.$http.get('/api/user', {
            params: {
                pageSize: pageSize,
                page: page,
                name: name
            }
        }).then((ret) => {
          this.loading = false
          let data = ret.data
          this.users =  data.data
          this.total =  data.meta.pagination.total
          this.current_page =  data.meta.pagination.current_page
          this.per_page =  data.meta.pagination.per_page
        })
      },
      doSearch () {
        this.getUsers(this.current_page, this.per_page, this.search.name)
      },
      handleEdit(uid) {
        console.log(uid);
      },
      handleDelete(index, uid) {
        let $this = this
        this.$http.delete('/api/user/'+uid).then((ret) => {
            if (ret.data === 1) {
                $this.users.splice(index, 1)
                this.$message.success('删除成功！');
            } else {
                this.$message.error('删除失败！');
            }
        })
      }
    },
    components: { Paginator }
  };











</script>