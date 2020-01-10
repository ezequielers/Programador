<template>
  <div>
    <b-button @click="show = true" variant="primary" class="mb-3">Adicionar Funcionário <i class="fas fa-plus"></i></b-button>
    <b-table striped hover :items="employees" :fields="tableColumn" :busy="isBusy">
      <template v-slot:table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong> Carregando...</strong>
        </div>
      </template>
      <template v-slot:cell(actions)="data">
        <b-button variant="warning" @click.prevent="onEdit(data.item)" class="mr-2 text-white">
          <i class="fas fa-pencil-alt"></i>
        </b-button>
        <b-button variant="danger" @click.prevent="remove(data.item.emp_id)" class="text-white">
          <i class="fas fa-trash-alt"></i>
        </b-button>
      </template>
    </b-table>

    <b-modal v-model="show" title="Adicionar Funcionário">
        <b-form @submit="onSave" @reset="() => {}">
          <b-form-group id="g-emp_name" label="Nome do Funcionário" label-for="emp_name" description="Informe o nome do funcionário">
            <b-form-input id="emp_name" v-model="employee.name" type="text" required placeholder="Nome do Funcionário" />
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
import EmployeeService from '@/Services/EmployeeService'

export default {
  name: 'Employees',
  data () {
    return {
      tableColumn: [
        { key: 'emp_id', label: '#', sortable: true },
        { key: 'emp_name', label: 'Funcionário', sortable: true },
        { key: 'actions', label: 'Ações' }
      ],
      employees: [],
      isBusy: false,
      show: false,
      employee: {
        id: '',
        name: ''
      }
    }
  },
  methods: {
    getEmployees () {
      this.isBusy = true
      this.employees = []
      EmployeeService.getEmployees().then((res) => {
        this.employees = res.data
        this.isBusy = false
      })
    },
    onSave (idProduct) {
      this.isBusy = true
      this.show = false
      EmployeeService.saveEmployee(this.employee).then(res => {
        if (res === false) {
          this.$alertSwal.toast('Erro ao salvar o funcionário', 'error')
        } else {
          this.getEmployees()
          this.onReset()
          this.$alertSwal.toast('Funcionário salvar com sucesso', 'success')
        }
      })
    },
    onEdit (data) {
      this.employee.id = data.emp_id
      this.employee.name = data.emp_name
      this.show = true
    },
    remove (idEmployee) {
      this.$alertSwal.modalConfirm('Aviso', 'Você deseja deletar este registo?', 'warning', 'Sim', 'Não', async (e) => {
        await EmployeeService.deleteEmployee(idEmployee)
      }).then((result) => {
        if (result.value) {
          this.getEmployees()
          this.$alertSwal.toast('Registro deletado com sucesso', 'success')
        }
      })
    },
    onReset (event) {
      this.employee = {
        id: '',
        name: ''
      }
    }
  },
  mounted () {
    this.getEmployees()
  }
}
</script>
