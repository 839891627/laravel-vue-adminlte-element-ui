<template>
  <div class="wrapper">
    <header>
      <div class="up">
        header
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
    justify-content: center;
  }

</style>
