<template>
  <el-menu :default-openeds="openeds"
    style="border-right: none; text-align: left">
      <el-submenu v-for="(itme ,index) in meun" :index="itme.id.toString()" :key="index">
        <template slot="title"><i :class="itme.icon"></i>{{ itme.label }}</template>
         <el-menu-item-group>
          <template slot="title">分组一</template>
          <el-menu-item :index="'itme.id' + -1">选项1</el-menu-item>
          <el-menu-item :index="'itme.id' + -2">选项2</el-menu-item>
        </el-menu-item-group>
        <el-menu-item-group title="分组2">
          <el-menu-item :index="'itme.id' + -3">选项3</el-menu-item>
        </el-menu-item-group>
        <el-submenu :index="'itme.id' + -4">
          <template slot="title">选项4</template>
          <el-menu-item :index="'itme.id' + -4-1">选项4-1</el-menu-item>
        </el-submenu>
      </el-submenu>
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
          '2',
          '3'
        ]
      }
    },
    meun: {
      type: Array,
      default: function () {
        return [
          {
            id: '1',
            label: '仓库管理',
            icon: 'el-icon-message'
          },
          {
            id: '2',
            label: '商品管理',
            icon: 'el-icon-menu'
          },
          {
            id: '3',
            label: '订单管理',
            icon: 'el-icon-document'
          },
          {
            id: '4',
            label: '订单管理',
            icon: 'el-icon-document'
          },
          {
            id: '5',
            label: '订单管理',
            icon: 'el-icon-document'
          }
        ]
      }
    }
  }
}
</script>
