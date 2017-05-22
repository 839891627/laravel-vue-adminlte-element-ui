<template>
  <el-row class="tac">
    <el-col>
      <el-menu default-active="1" @open="handleOpen" @close="handleClose" theme="dark">
        <router-link :to="{name: 'user.index'}">
          <el-menu-item index="1">
            <i class="el-icon-menu"></i>用户管理
          </el-menu-item>
        </router-link>
        <el-submenu index="2">
          <template slot="title"><i class="el-icon-message"></i>系统管理</template>
          <el-menu-item-group>
            <router-link :to="{name: 'system.role'}">
              <el-menu-item index="2-1">
                角色管理
              </el-menu-item>
            </router-link>
            <router-link :to="{name: 'system.permission'}">
              <el-menu-item index="2-2">
                权限管理
              </el-menu-item>
            </router-link>
          </el-menu-item-group>
        </el-submenu>
      </el-menu>
    </el-col>
  </el-row>
</template>

<script>
  export default {
    methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>
