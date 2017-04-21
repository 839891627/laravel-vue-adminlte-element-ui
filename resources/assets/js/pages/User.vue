<template>
    <el-table
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
                <el-button
                        size="small"
                        @click="handleEdit(scope.row.id)">编辑
                </el-button>
                <el-button
                        size="small"
                        type="danger"
                        @click="handleDelete(scope.$index, scope.row.id)">删除
                </el-button>
            </template>
        </el-table-column>
    </el-table>
</template>

<script>
  export default {
    data() {
      return {
            users: []
         }
    },
    created () {
        this.getUsers()
    },
    methods: {
      getUsers () {
        this.$http.get('/api/user').then((ret) => {
          this.users = ret.data.data
        })
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
    }
  };
</script>