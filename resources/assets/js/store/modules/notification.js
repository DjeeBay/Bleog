import * as types from '../mutations'

let defautStatus = 'alert-info'

const state = {
    show: false,
    message: '',
    status: defautStatus
}

const getters = {
    isOpen: state => state.show,
    getMessage: state => state.message,
    getStatus: state => state.status
}

const actions = {
    showAlert ({commit}, obj) {
        if (obj.message !== undefined) {
            let status = (obj.status !== undefined) ? getStatus(obj.status) : defautStatus
            commit(types.SET_MESSAGE_ALERT, obj.message)
            commit(types.SHOW_ALERT)
            commit(types.SET_STATUS_ALERT, status)
        }
    },
    hideAlert ({commit}) {
        commit(types.HIDE_ALERT)
    }
}

const mutations = {
    [types.SHOW_ALERT] (state) {
        state.show = true
    },
    [types.HIDE_ALERT] (state) {
        state.show = false
        state.message = ''
        state.status = defautStatus
    },
    [types.SET_MESSAGE_ALERT] (state, message) {
        state.message = message
    },
    [types.SET_STATUS_ALERT] (state, status) {
        state.status = status
    },
}

let getStatus = ($status) => {
    let status
    switch ($status) {
        case 'success':
            status = 'success'
            break
        case 'danger':
            status = 'danger'
            break
        case 'warning':
            status = 'warning'
            break
        case 'info':
            status = 'info'
            break
        default:
            status = 'info'
            break
    }

    return 'alert-'+status
}

export default {
    state,
    getters,
    actions,
    mutations
}