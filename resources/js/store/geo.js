import Axios from 'axios'

export default {
    state: {
        cities: [],
        regions: [],
        countries: []
    },
    actions: {
        getCities ({ commit }, {filter, filtersdata, page, sort, perpage}) {
            return Axios('/api/system/geo/city', {
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
                    commit('SET_CITIES', response.data)
                })
                .catch(error => {
                    if (error.response.status === 403) {
                        // TODO: to auth page
                    }
                })
        },
        getRegions ({ commit }, {filter, filtersdata, page, sort, perpage}) {
            return Axios('/api/system/geo/region', {
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
                    commit('SET_REGIONS', response.data)
                })
                .catch(error => {
                    if (error.response.status === 403) {
                        // TODO: to auth page
                    }
                })
        },
        getCountries ({ commit }, {filter, filtersdata, page, sort, perpage}) {
            return Axios('/api/system/geo/country', {
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
                    commit('SET_COUNTRIES', response.data)
                })
                .catch(error => {
                    if (error.response.status === 403) {
                        // TODO: to auth page
                    }
                })
        }
    },
    mutations: {
        SET_CITIES: (state, data) => {
            state.cities = data
        },
        SET_REGIONS: (state, data) => {
            state.regions = data
        },
        SET_COUNTRIES: (state, data) => {
            state.countries = data
        }
    },
    getters: {
        cities (state) {
            return state.cities
        },
        regions (state) {
            return state.regions
        },
        countries (state) {
            return state.countries
        }
    }
}
