import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import * as actions from './actions'
import notif from './modules/notification'

Vue.use(Vuex)

export default new Vuex.Store({
    actions,
    modules: {
        notif
    }
})