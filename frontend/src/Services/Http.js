import axios from 'axios'

const clientHttp = axios.create({
  baseURL: process.env.VUE_APP_APIENDPOINT
})

export default clientHttp
