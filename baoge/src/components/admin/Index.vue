<template>
  <div>
    <el-container>
      <el-aside style="width: 200px;">
        <el-header>
          <img :src="imgSrc" alt="" style="width: 100%;height: 100%;">
        </el-header>
        <XxButton></XxButton>
      </el-aside>
      <el-container>
        <el-header style="text-align: right; font-size: 12px">
          <el-menu
            :default-active="activeIndex2"
            class="el-menu-demo"
            mode="horizontal">
            <el-menu-item index="1">处理中心</el-menu-item>
            <el-submenu index="2">
              <template slot="title">我的工作台</template>
              <el-menu-item index="2-1">选项1</el-menu-item>
              <el-menu-item index="2-2">选项2</el-menu-item>
              <el-menu-item index="2-3">选项3</el-menu-item>
              <el-submenu index="2-4">
                <template slot="title">选项4</template>
                <el-menu-item index="2-4-1">选项1</el-menu-item>
                <el-menu-item index="2-4-2">选项2</el-menu-item>
                <el-menu-item index="2-4-3">选项3</el-menu-item>
              </el-submenu>
            </el-submenu>
            <el-menu-item index="3" disabled>消息中心</el-menu-item>
            <el-dropdown>
              <span class="el-dropdown-link">
                <div class="demo-type" style="margin-top: 10px;">
                  <el-avatar :size="40">
                    <img src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"/>
                  </el-avatar>
                </div>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item>个人中心</el-dropdown-item>
                <el-dropdown-item>退出登录</el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-menu>
        </el-header>
      </el-container>
    </el-container>
  </div>
</template>

<script>
export default {
  data () {
    return {
      activeIndex: '1',
      activeIndex2: '1',
      msg: 'Welcome to Your Vue.js App',
      imgSrc: require('../../assets/20201124032511.png')
    }
  },
  methods: {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style  scoped>
  /deep/ :focus {
    outline: 0;
  }
</style>
