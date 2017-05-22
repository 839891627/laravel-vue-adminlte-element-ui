<template>
  <el-row class="tac">
    <el-col>
      <el-menu :default-active="$route.path" theme="dark" :router="true">
        <router-link :to="{name: 'user.index'}">
          <el-menu-item index="/user">
            <i class="el-icon-menu"></i>用户管理
          </el-menu-item>
        </router-link>
        <el-submenu index="system">
          <template slot="title"><i class="el-icon-message"></i>系统管理</template>
          <el-menu-item-group>
            <el-menu-item index="/system/roles">
              角色管理
            </el-menu-item>
            <el-menu-item index="/system/permissions">
              权限管理
            </el-menu-item>
          </el-menu-item-group>
        </el-submenu>
      </el-menu>
    </el-col>
  </el-row>
</template>

<script>
  export default {}
</script>
