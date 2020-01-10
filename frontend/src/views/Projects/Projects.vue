<template>
  <div>
    <b-button @click="show = true" variant="primary" class="mb-3">Adicionar Projeto <i class="fas fa-plus"></i></b-button>
    <b-table striped hover :items="projects" :fields="tableColumn" :busy="isBusy">
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
        <b-link :to="{ name: 'ProjectEmployee', params: { idProject: data.item.pro_id } }" class="btn btn-primary mr-2 text-white">
          <i class="fas fa-sitemap"></i>
        </b-link>
        <b-button variant="danger" @click.prevent="remove(data.item.pro_id)" class="text-white">
          <i class="fas fa-trash-alt"></i>
        </b-button>
      </template>
    </b-table>

    <b-modal v-model="show" title="Adicionar Projeto">
      <!-- <div class="d-block"> -->
        <b-form @submit="onSave" @reset="() => {}">
          <b-form-group id="g-pro_name" label="Nome do Projeto" label-for="pro_name" description="Informe o nome do projeto">
            <b-form-input id="pro_name" v-model="project.name" type="text" required placeholder="Nome do Projeto" />
          </b-form-group>

          <b-form-group id="g-pro_description" label="Descrição do Projeto" label-for="pro_description" description="Informe a descrição do projeto">
            <b-form-textarea id="pro_description" v-model="project.description" required placeholder="Descrição do Projeto" />
          </b-form-group>

          <b-form-group id="g-pro_dt_start" label="Data de início" label-for="pro_dt_start" description="Informe a Data de início do Projeto">
            <b-form-input id="pro_dt_start" v-model="project.dt_start" type="date" required placeholder="Data de início" />
          </b-form-group>

          <b-form-group id="g-pro_dt_end" label="Data de final" label-for="pro_dt_end" description="Informe a Data de final do Projeto">
            <b-form-input id="pro_dt_end" v-model="project.dt_end" type="date" required placeholder="Data de final" />
          </b-form-group>

          <!-- <b-button type="submit" variant="primary" class="">Salvar</b-button>
          <b-button type="reset" variant="danger">Limpar</b-button> -->
        </b-form>
      <!-- </div> -->
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
import dayjs from 'dayjs'
import customParseFormat from 'dayjs/plugin/customParseFormat'

dayjs.extend(customParseFormat)

export default {
  name: 'Projects',
  data () {
    return {
      dayjs,
      tableColumn: [
        { key: 'pro_id', label: '#', sortable: true },
        { key: 'pro_name', label: 'Projeto', sortable: true },
        { key: 'pro_dt_start', label: 'Data Início', sortable: true, formatter: (value, key, item) => { return dayjs(item.pro_dt_start, 'YYYY-MM-DD').format('DD/MM/YYYY') } },
        { key: 'pro_dt_end', label: 'Data Fim', sortable: true, formatter: (value, key, item) => { return dayjs(item.pro_dt_end, 'YYYY-MM-DD').format('DD/MM/YYYY') } },
        { key: 'actions', label: 'Ações' }
      ],
      projects: [],
      isBusy: false,
      show: false,
      project: {
        id: '',
        name: '',
        description: '',
        dt_start: '',
        dt_end: ''
      }
    }
  },
  methods: {
    getProjects () {
      this.isBusy = true
      this.projects = []
      ProjectService.getProjects().then((res) => {
        this.projects = res.data
        this.isBusy = false
      })
    },
    onSave (idProduct) {
      this.isBusy = true
      this.show = false
      ProjectService.saveProject(this.project).then(res => {
        if (res === false) {
          this.$alertSwal.toast('Erro ao inserir o projeto', 'error')
        } else {
          this.getProjects()
          this.onReset()
          this.$alertSwal.toast('Projeto inserido com sucesso', 'success')
        }
      })
    },
    onEdit (data) {
      this.project.id = data.pro_id
      this.project.name = data.pro_name
      this.project.description = data.pro_description
      this.project.dt_start = data.pro_dt_start
      this.project.dt_end = data.pro_dt_end
      this.show = true
    },
    remove (idProject) {
      this.$alertSwal.modalConfirm('Aviso', 'Você deseja deletar este registo?', 'warning', 'Sim', 'Não', async (e) => {
        await ProjectService.deleteProject(idProject)
      }).then((result) => {
        if (result.value) {
          this.getProjects()
          this.$alertSwal.toast('Registro deletado com sucesso', 'success')
        }
      })
    },
    onReset (event) {
      this.project = {
        id: '',
        name: '',
        description: '',
        dt_start: '',
        dt_end: ''
      }
    }
  },
  mounted () {
    this.getProjects()
  }
}
</script>
