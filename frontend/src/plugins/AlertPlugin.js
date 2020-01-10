import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

const AlertPlugin = {
  showLoading (strMensagem) {
    strMensagem = strMensagem || 'Carregando...'

    var strProgressHTML = `<span class="flower-loader"></span><div clas="d-block" style="margin-top: 15px; color: black; font-weight: 600">${strMensagem}</div>`

    Swal.fire({
      title: '',
      background: 'transparent',
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      showConfirmButton: false,
      html: strProgressHTML
    })
  },
  hideLoading () {
    Swal.close()
  },
  modalAlert: (title, message, type) =>
    Swal.fire({
      title: title,
      html: message,
      type: type || 'info',
      showCancelButton: false,
      showCloseButton: false
    }),
  modalConfirm: (title, message, type, okButton, cancelButton, preConfirmFunc) =>
    Swal.fire({
      title: title,
      html: message,
      type: type || 'question',
      showCancelButton: true,
      confirmButtonText: okButton || 'Sim',
      cancelButtonText: cancelButton || 'Não',
      showCloseButton: true,
      showLoaderOnConfirm: preConfirmFunc || true,
      preConfirm: preConfirmFunc
    }),
  toast: (msg, type) => {
    const toast = Swal.mixin({
      toast: true,
      position: 'bottom',
      showConfirmButton: false,
      timer: 3000
    })
    toast.fire({
      type: type === undefined ? 'success' : type,
      title: msg
    })
  },
  modalConfirm2 (title, message, type, okButton, cancelButton, preConfirmFunc) {
    // eslint-disable-next-line
    let me = preConfirmFunc
    Swal.fire({
      title: title,
      text: message,
      type: type || 'warning',
      showCancelButton: true,
      confirmButtonText: okButton || 'Sim',
      cancelButtonText: cancelButton || 'Não',
      showCloseButton: true,
      showLoaderOnConfirm: true,
      preConfirm: preConfirmFunc
    }).then((result) => {
      // codigo
    })
  }
}

export default {
  install (Vue, options) {
    Vue.prototype.$alertSwal = AlertPlugin
  }
}
