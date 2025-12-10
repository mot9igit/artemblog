import Axios from 'axios'

export default {
    state: {
        profile: [],
        users: []
    },
    actions: {
        getUsers ({ commit }, {filter, filtersdata, page, sort, perpage}) {
            return Axios('/api/users/', {
                method: 'GET',
                params: {
                    filter: filter,
                    filtersdata: filtersdata,
                    sort: sort,
                    page: page,
                    perpage: perpage
                }
            })
                .then((response) => {
                    commit('SET_USERS', response.data)
                })
                .catch(error => {
                    if (error.response.status === 403) {
                        // TODO: to auth page
                    }
                })
        },
        getProfile ({ commit }, {user_id}) {
            return Axios(`/api/profile/${user_id}`, {
                method: 'GET'
            })
                .then((response) => {
                    console.log(response)
                    commit('SET_PROFILE', response.data)
                })
                .catch(error => {
                    if (error.response.status === 403) {
                        // TODO: to auth page
                    }
                })
        }
    },
    mutations: {
        SET_PROFILE: (state, data) => {
            state.profile = data
        },
        SET_USERS: (state, data) => {
            state.users = data
        }
    },
    getters: {
        profile (state) {
            return state.profile
        },
        users (state) {
            return state.users
        }
    }
}
