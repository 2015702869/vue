<template>
  <el-menu :default-openeds="openeds"
    style="text-align: left;border-right: none;">
      <div v-for="(item ,index) in meun" :key="index">
        <el-submenu v-if="item.children && item.children.length" :index="item.path">
          <template slot="title">
          <i :class="item.icon"></i>
            <span>{{ item.name }}</span>
          </template>
          <template v-for="itemChild in item.children">
            <el-submenu v-if="itemChild.children && itemChild.children.length" :index="itemChild.path" :key="itemChild.path">
              <template slot="title">
                <span>{{ itemChild.name }}</span>
              </template>
              <template v-for="itemChilds in itemChild.children">
                <el-menu-item  :index="itemChilds.path" :key="itemChilds.path" @click="childMethod(itemChilds.path,itemChilds.name)">
                  <span slot="title">{{itemChilds.name}}</span>
                </el-menu-item>
              </template>
            </el-submenu>
            <el-menu-item  v-else :index="itemChild.path" :key="itemChild.path" @click="childMethod(itemChild.path,itemChild.name)">
              <span slot="title">{{itemChild.name}}</span>
            </el-menu-item>
          </template>
        </el-submenu>
        <el-menu-item v-else :index="item.path" :key="item.path" @click="childMethod(item.path,item.name)">
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
                name: '商品列表',
                children: [
                  {
                    path: '/60',
                    name: '商品仓库'
                  }, {
                    path: '/69',
                    name: '商品库'
                  }
                ]
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
  },
  methods: {
    childMethod (data, names) {
      this.$emit('updTab', {router: data, title: names})
    }
  }
}
</script>
