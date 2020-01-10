import Http from '@/Services/Http.js'
const baseApiUrl = process.env.VUE_APP_APIENDPOINT

export const ProjectService = {
  // getProjectById (idProject) {
  //   return new Promise((resolve, reject) => {
  //     Http.get(`${baseApiUrl}/projects/${idProject}`).then(res => {
  //       resolve(res.data)
  //     }).catch(() => {
  //       resolve(false)
  //     })
  //   })
  // },
  getProjects (idProject) {
    return new Promise((resolve, reject) => {
      Http.get(`${baseApiUrl}/projects/${idProject}`).then(res => {
        resolve(res.data)
      }).catch(() => {
        resolve(false)
      })
    })
  },
  saveProject (data) {
    let frmData = new FormData()
    frmData.append('id', data.id)
    frmData.append('name', data.name)
    frmData.append('description', data.description)
    frmData.append('dt_start', data.dt_start)
    frmData.append('dt_end', data.dt_end)
    return new Promise((resolve, reject) => {
      Http.post(`${baseApiUrl}/projects/create`, frmData).then(res => {
        resolve(res)
      }).catch(() => {
        resolve(false)
      })
    })
  },
  deleteProject (idProject) {
    return new Promise((resolve, reject) => {
      Http.delete(`${baseApiUrl}/projects/delete/${idProject}`).then(res => {
        resolve(true)
      }).catch(() => {
        resolve(false)
      })
    })
  },
  getProjectEmployee (idProject) {
    return new Promise((resolve, reject) => {
      Http.get(`${baseApiUrl}/project-employee/${idProject}`).then(res => {
        resolve(res.data)
      }).catch(() => {
        resolve(false)
      })
    })
  },
  saveProjectEmployee (data) {
    let frmData = new FormData()
    frmData.append('project_id', data.pem_project_id)
    frmData.append('employee_id', data.pem_employee_id)
    frmData.append('manager', data.pem_manager)
    return new Promise((resolve, reject) => {
      Http.post(`${baseApiUrl}/project-employee/create`, frmData).then(res => {
        resolve(res.data)
      }).catch(() => {
        resolve(false)
      })
    })
  }
}

export default ProjectService
