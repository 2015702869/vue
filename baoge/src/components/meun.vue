<template>
  <el-menu :default-openeds="openeds"
    style="border-right: none; text-align: left">
      <div v-for="(item ,index) in meun" :key="index">
        <el-submenu v-if="item.children && item.children.length" :index="item.path">
          <template slot="title">
          <i :class="item.icon"></i>
            <span>{{ item.name }}</span>
          </template>
          <template v-for="itemChild in item.children">
            <el-menu-item  :index="itemChild.path" :key="itemChild.path">
              <span slot="title">{{itemChild.name}}</span>
            </el-menu-item>
          </template>
        </el-submenu>
        <el-menu-item v-else :index="item.path" :key="item.path">
          <i :class="item.icon"></i>
          <span slot="title">{{item.name}}</span>
        </el-menu-item>
      </div>
    </el-menu>
</template>
<script>
export default {
  name: 'XxButton', // 注意这里的name命名，就是你以后封装好后使用的组件名
  props: {
    openeds: {
      type: Array,
      default: function () {
        return [
          '/1'
        ]
      }
    },
    meun: {
      type: Array,
      default: function () {
        return [
          {
            path: '/4',
            name: '首页',
            icon: 'el-icon-house'
          }, {
            path: '/5',
            name: '商品管理',
            icon: 'el-icon-menu',
            children: [
              {
                path: '/54',
                name: '商品仓库'
              }, {
                path: '/55',
                name: '商品列表'
              }
            ]
          }, {
            path: '/6',
            name: '用户管理',
            icon: 'el-icon-user',
            children: [
              {
                path: '/57',
                name: '普通用户'
              }, {
                path: '/58',
                name: '会员用户'
              }
            ]
          }, {
            path: '/47',
            name: '导航四',
            icon: 'el-icon-menu'
          }
        ]
      }
    }
  }
}
</script>
