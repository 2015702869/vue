<template>
  <div>
     <el-table
      v-loading="loading"
      element-loading-text="拼命加载中"
      element-loading-spinner="el-icon-loading"
      :data="tableData"
      :row-style="{height: '0'}"
      :cell-style="{padding: '2'}"
      :default-sort = "{prop: 'date', order: 'descending'}"
      @selection-change="selectionLineChangeHandle"
      style="width: 100%"
      >
      <el-table-column
        type="selection"
        width="55">
      </el-table-column>
      <el-table-column
        fixed
        prop="id"
        label="序号"
        width="100">
      </el-table-column>
      <el-table-column
        fixed
        prop="username"
        label="用户名"
        width="200">
      </el-table-column>
      <el-table-column
        fixed
        label="状态"
        width="200">
        <template slot-scope="scope">
          <el-switch
            v-model="scope.row.status"
            :active-value="1"
            :inactive-value="0"
             @change="changeSwitch(scope.row)">
        </el-switch>
        </template>
      </el-table-column>
      <el-table-column
        prop="nickname"
        label="昵称"
        width="200">
      </el-table-column>
      <el-table-column
        prop="tags.title"
        label="所属管理组"
        width="200">
        <template slot-scope="scope">
          <el-tag size="medium">{{ scope.row.tags.title }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column
        fixed="right"
        label="操作"
        width="100">
        <template slot-scope="scope">
          <el-tooltip class="item" effect="dark" content="修改" placement="top">
            <el-button type="primary" size="mini" icon="el-icon-edit" circle @click="handleEdit(scope.$index, scope.row)"></el-button>
          </el-tooltip>
          <el-tooltip class="item" effect="dark" content="删除" placement="top">
            <el-button type="danger" icon="el-icon-delete" size="mini" circle @click="delect()"></el-button>
          </el-tooltip>
        </template>
      </el-table-column>
    </el-table>
    <el-pagination
      background
      style="margin-top:20px;"
      @current-change="handleCurrentChange"
      layout="prev, pager, next"
      :total="24">
    </el-pagination>
  </div>
</template>

<style>
  body .el-table::before {
      z-index: inherit;
  }
</style>

<script>
export default {
  name: 'Admin',
  data () {
    return {
      tableData: [],
      dataonLineListSelections: [],
      loading: true,
      token: {
        accion: this.$cookies.get('accion'),
        session_id: this.$cookies.get('session_id')
      }
    }
  },
  mounted () {
    this.request.post('/admin/admin/index', this.token).then(res => {
      this.tableData = res.data
      this.loading = false
    }).catch(err => {
      console.log(err)
    })
  },
  methods: {
    changeSwitch (row) {
      console.log(row.status)
    },
    handleClick (row) {
      console.log(row)
    },
    toggleSelection (rows) {
      if (rows) {
        rows.forEach(row => {
          this.$refs.multipleTable.toggleRowSelection(row)
        })
      } else {
        this.$refs.multipleTable.clearSelection()
      }
    },
    selectionLineChangeHandle (val) {
      this.dataonLineListSelections = val
    },
    handleCurrentChange (val) {
      this.request.post('/admin/admin/index?page=' + val, this.token).then(res => {
        this.tableData = res.data
      })
    },
    delect () {
      console.log(this.dataonLineListSelections)
      for (var i = 0; i < this.dataonLineListSelections.length; i++) {
        console.log('id:' + this.dataonLineListSelections[i].id)
      }
    }
  }
}
</script>
