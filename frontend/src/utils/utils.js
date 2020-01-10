import Swal from 'sweetalert2/dist/sweetalert2.js'

export const util = {
  getBoolean (value, defaultValue) {
    switch (value) {
      case true:
      case 'true':
      case 1:
      case '1':
      case 'on':
      case 'yes':
        return true
      case false:
      case 'false':
      case 0:
      case '0':
      case 'off':
      case 'no':
        return false
      default:
        return defaultValue || false
    }
  },
  showLoading (strMensagem) {
    strMensagem = strMensagem || 'Aguarde carregando'

    Swal.fire({
      title: '',
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      showConfirmButton: false,
      html: '<h4>' + strMensagem + '</h4><br />'
    })
  },

  hideLoading () {
    Swal.close()
  }
}
