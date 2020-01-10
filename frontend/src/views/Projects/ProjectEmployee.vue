<template>
  <div v-if="project">
    <h4>{{ project.pro_name }}</h4>

    <b-button @click="openModal" variant="primary" class="mb-3">Vincular Funcionário <i class="fas fa-plus"></i></b-button>
    <b-table striped hover :items="projectsEmployees" :fields="tableColumn" :busy="isBusy">
      <template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong> Carregando...</strong>
        </div>
      </template>
      <template v-slot:cell(actions)="data">
        <b-button variant="danger" @click.prevent="remove(data.item.pem_id)" class="text-white">
          <i class="fas fa-trash-alt"></i>
        </b-button>
      </template>
    </b-table>

    <b-modal v-model="show" title="Vincular Funcionário">
        <b-form @submit="onSave" @reset="() => {}">
          <b-form-group id="g-pem_employee_id" label="Nome do Projeto" label-for="pem_employee_id" description="Informe Funcionário">
            <b-form-select v-model="projectEmployee.pem_employee_id" :options="listEmployees" required></b-form-select>
          </b-form-group>

          <b-form-group id="g-pem_manager" label="Descrição do Projeto" label-for="pem_manager" description="Informe se Gerente">
            <b-form-select v-model="projectEmployee.pem_manager" :options="listOptionManager" required></b-form-select>
          </b-form-group>
        </b-form>
      <template v-slot:modal-footer>
        <b-button type="submit" variant="primary" @click="onSave">Salvar</b-button>
        <b-button type="reset" variant="danger" @click="onReset">Limpar</b-button>
        <b-button type="button" @click="show=false">Fechar</b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
import ProjectService from '@/Services/ProjectService'
import EmployeeService from '@/Services/EmployeeService'

import { util } from '@/utils/utils'

export default {
  name: 'ProjectEmployee',
  data () {
    return {
      project: null,
      tableColumn: [
        { key: 'pem_id', label: '#', sortable: true },
        { key: 'pem_employee_name', label: 'Funcionário', sortable: true },
        { key: 'pem_manager', label: 'Gerente', sortable: true, formatter: (value, key, item) => { return item.pem_manager === 1 ? 'Sim' : 'Não' } },
        { key: 'actions', label: 'Ações' }
      ],
      isBusy: false,
      projectsEmployees: [],
      show: false,
      projectEmployee: {
        pem_project_id: '',
        pem_employee_id: '',
        pem_manager: ''
      },
      listEmployees: [],
      listOptionManager: [
        { value: '1', text: 'Sim' },
        { value: '0', text: 'Não' }
      ]
    }
  },
  methods: {
    getProject () {
      ProjectService.getProjects(this.$route.params.idProject).then((res) => {
        this.project = res.data[0]
        this.getProjectEmployee()
      })
    },
    getProjectEmployee () {
      this.isBusy = true
      ProjectService.getProjectEmployee(this.project.pro_id).then((res) => {
        this.projectsEmployees = res.data
        this.isBusy = false
      })
    },
    openModal () {
      util.showLoading()
      this.getEmployeeAvaliables()
    },
    getEmployeeAvaliables () {
      EmployeeService.getEmployeesAvaliable(this.project.pro_id).then(res => {
        res.data.map((item, index) => {
          this.listEmployees.push({ value: item.emp_id, text: item.emp_name })
        })
        this.show = true
        util.hideLoading()
      })
    },
    onSave () {
      this.isBusy = true
      this.show = false
      ProjectService.saveProjectEmployee(this.projectEmployee).then(res => {
        if (res === false) {
          this.$alertSwal.toast('Erro ao inserir o registro', 'error')
        } else {
          this.getProjectEmployee()
          this.onReset()
          this.$alertSwal.toast('Registro salvo com sucesso', 'success')
        }
      })
    },
    onReset () {
      this.projectEmployee = {
        pem_project_id: this.$route.params.idProject,
        pem_employee_id: '',
        pem_manager: '0'
      }
    }
  },
  mounted () {
    this.getProject()
    this.projectEmployee = {
      pem_project_id: this.$route.params.idProject,
      pem_employee_id: '',
      pem_manager: '0'
    }
  }
}
</script>
