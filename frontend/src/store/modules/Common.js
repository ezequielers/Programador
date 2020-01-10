import { util } from '@/utils/utils.js'
const _stateMenu = util.getBoolean(localStorage.getItem('_menuState_'), true)

export const Common = {
  state: {
    stateMenu: _stateMenu
  },
  mutations: {
    SET_STATE_MENU: (state) => {
      state.stateMenu = !state.stateMenu
      localStorage.setItem('_menuState_', state.stateMenu)
    }
  },
  actions: {
    setStateMenu ({ commit }) {
      commit('SET_STATE_MENU')
    }
  }
}

export default Common
