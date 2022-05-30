<template>
  <div>
    <el-container>
      <el-aside :style="menu" class="menu">
        <el-scrollbar style="width:100%;height: 100%;">
          <el-header>
            <img :src="imgSrc" alt="" style="width: 100%;height: 100%;">
          </el-header>
          <XxButton @updTab="updTab"></XxButton>
        </el-scrollbar>
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
        <el-main style="padding: 10px 10px 15px 10px;">
          <el-tabs v-model="editableTabsValue" type="border-card" tab-position="top" @tab-remove="removeTab" >
            <el-tab-pane
              v-for="(item) in editableTabs"
              :key="item.name"
              :label="item.title"
              :name="item.name"
              closable
            >
            <component :is='item.content'></component>
            </el-tab-pane>
          </el-tabs>
        </el-main>
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
      imgSrc: require('../../assets/20201124032511.png'),
      menu: {
        width: '230px',
        height: document.documentElement.clientHeight - 16 + 'px'
      },
      toekn: {
        accion: this.$cookies.get('accion'),
        session_id: this.$cookies.get('session_id')
      },
      editableTabsValue: '/1',
      editableTabs: [{
        title: '仓库管理',
        name: '/1',
        content: 'Admin'
      }],
      tabIndex: 1
    }
  },
  mounted () {
  },
  methods: {
    updTab (data) {
      for (var o in this.editableTabs) {
        if (this.editableTabs[o].name === data.router) {
          this.editableTabsValue = data.router
          return false
        }
      }
      this.editableTabs.push({
        title: data.title,
        name: data.router,
        content: 'XxButton'
      })
      this.editableTabsValue = data.router
    },
    removeTab (targetName) {
      console.log(targetName)
      let tabs = this.editableTabs
      let activeName = this.editableTabsValue
      if (activeName === targetName) {
        tabs.forEach((tab, index) => {
          if (tab.name === targetName) {
            let nextTab = tabs[index + 1] || tabs[index - 1]
            if (nextTab) {
              activeName = nextTab.name
            }
          }
        })
      }
      this.editableTabsValue = activeName
      this.editableTabs = tabs.filter(tab => tab.name !== targetName)
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style  scoped>
  /deep/ :focus {
    outline: 0;
  }
  .menu{
    border-right: solid 1px #e6e6e6;
  }
  ::-webkit-scrollbar {
    width: 8px;/* 滚动条宽度 */
  }
  ::-webkit-scrollbar-thumb {
    background-color: #eaecf1;
    border-radius: 3px;
  }
</style>
