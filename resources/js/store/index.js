import Vuex from 'vuex'

import product from './product'
import user from './user'
import geo from './geo'

export default new Vuex.Store({
    modules: {
        product,
        user,
        geo
    }
})
