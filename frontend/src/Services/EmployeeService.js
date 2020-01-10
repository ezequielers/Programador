import Http from '@/Services/Http.js'
const baseApiUrl = process.env.VUE_APP_APIENDPOINT

export const EmployeeService = {
  getEmployees () {
    return new Promise((resolve, reject) => {
      Http.get(`${baseApiUrl}/employees`).then(res => {
        resolve(res.data)
      }).catch(() => {
        resolve(false)
      })
    })
  },
  saveEmployee (data) {
    let frmData = new FormData()
    frmData.append('id', data.id)
    frmData.append('name', data.name)
    return new Promise((resolve, reject) => {
      Http.post(`${baseApiUrl}/employees/create`, frmData).then(res => {
        resolve(res)
      }).catch(() => {
        resolve(false)
      })
    })
  },
  deleteEmployee (idEmployee) {
    return new Promise((resolve, reject) => {
      Http.delete(`${baseApiUrl}/employees/delete/${idEmployee}`).then(res => {
        resolve(true)
      }).catch(() => {
        resolve(false)
      })
    })
  },
  getEmployeesAvaliable (idProject) {
    return new Promise((resolve, reject) => {
      Http.get(`${baseApiUrl}/employees/${idProject}`).then(res => {
        resolve(res.data)
      }).catch(() => {
        resolve(false)
      })
    })
  }
}

export default EmployeeService
