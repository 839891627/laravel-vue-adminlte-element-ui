<template>
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a>{{ name }}</a>
          </li>
          <li @click='logout'>
            <a>
              <el-button size='small' type="text"><span style='color: #fff'>退出</span></el-button>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
  export default{
    computed: {
      name () {
          return sessionStorage.getItem('name')
      }
    },
    methods: {
        logout () {
            this.$confirm('确认退出？', '提示', {
              confirmButtonText: '确定',
              cancelButtonText: '取消',
              type: 'warning'
            }).then(() => {
                sessionStorage.removeItem('token')
                sessionStorage.removeItem('name')
                this.$router.push('/login')
            }).catch(() => {
              return false
            })
        }
    }
  }

</script>

