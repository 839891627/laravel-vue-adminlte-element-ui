<template>
  <div class="paginator">
    <el-pagination
      @size-change="handleSizeChange"
      @current-change="handleCurrentChange"
      :current-page="current_pages"
      :page-sizes="[10, 20, 30, 40]"
      :page-size="per_page"
      layout="total, sizes, prev, pager, next, jumper"
      :total="total">
    </el-pagination>
  </div>
</template>

<script>
  export default {
    name: 'Paginator',
    computed: {
        current_pages () {
            return this.current_page
        }
    },
    props:['total', 'current_page', 'per_page'],
    methods: {
      handleSizeChange(val) {
        //console.log(`每页 ${val} 条`);
        this.$emit('changePage', 1, val)
      },
      handleCurrentChange(val) {
        //console.log(`当前页: ${val}`);
        this.current_pages = val;
        this.$emit('changePage', val, this.per_page)
      }
    }
  }


</script>
