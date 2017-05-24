<template>
  <div class="wrapper">
    <header>
      <div class="up">

        <div class="logo">
          <h4>Larave Admin with Element && Vue</h4>
        </div>
        <div class="profile">
          <div class="dropdown">
            <span>{{ name }}</span>
            <img class="logout"
                 src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=3443681203,2121587026&fm=11&gp=0.jpg">
            <i class="glyphicon glyphicon-log-out dropdown-toggle" type="button" id="dropdownMenu1"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="true"></i>
            <ul class="logout-menu dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a @click="logout">退出</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <div class="my-container">
      <main class="content">
        <div class="row">
          <div class="panel panel-info">
            <div class="panel-heading">页面标题</div>
            <div class="panel-body">
              <!--<transition enter-active-class="animated fadeInDown">-->
              <router-view></router-view>
              <!--</transition>-->
            </div>
          </div>
        </div>
      </main>
      <nav class="nav">
        <v-side-menu></v-side-menu>
      </nav>
    </div>
  </div>
</template>

<script>
  import vSideMenu from './SideMenu.vue'

  export default {
    computed: {
      name () {
        return sessionStorage.getItem('name')
      }
    },
    methods: {
      logout () {
        this.$router.push('/login')
        sessionStorage.removeItem('token')
      }
    },
    components: {
      vSideMenu,
    }
  }

</script>

<style>
  .body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
  }

  header {
    flex: 1;
    height: 5%;
  }

  .my-container {
    display: flex;
    flex: 1;
    height: 95%;
  }

  .content {
    flex: 1;
    padding: 20px;
  }

  .nav {
    /* 两边侧栏宽度*/
    flex: 0 0 16em;
    /* 导航放到最左边*/
    order: -1;
    background-color: #324057;
    color: #fff;
  }

  .up {
    height: 100%;
    background-color: #324057;
    font-size: 14px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .profile {
    width: 240px;
    margin-right: 50px;
  }

  .logout {
    height: 40px;
    border-radius: 50%;
  }

  .logout-menu {
    min-width: 80px !important;
    left: 200px !important;
  }

  .dropdown {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

</style>
