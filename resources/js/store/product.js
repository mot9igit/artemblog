import Axios from 'axios'

export default {
    state: {
        productCategories: [],
        productCategoriesTree: []
    },
    actions: {
        getProductCategories ({ commit }, {filter, filtersdata, page, sort, perpage}) {
            return Axios('/api/product/category', {
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
                    commit('SET_PRODUCT_CATEGORIES', response.data)
                })
                .catch(error => {
                    if (error.response.status === 403) {
                        // TODO: to auth page
                    }
                })
        },
        getProductCategoriesTree ({ commit }) {
            return Axios('/api/product/category/tree', {
                method: 'GET'
            })
                .then((response) => {
                    commit('SET_PRODUCT_CATEGORIES_TREE', response.data)
                })
                .catch(error => {
                    if (error.response.status === 403) {
                        // TODO: to auth page
                    }
                })
        }
    },
    mutations: {
        SET_PRODUCT_CATEGORIES: (state, data) => {
            state.productCategories = data
        },
        SET_PRODUCT_CATEGORIES_TREE: (state, data) => {
            state.productCategoriesTree = data
        }
    },
    getters: {
        productCategories (state) {
            return state.productCategories
        },
        productCategoriesTree (state) {
            return state.productCategoriesTree
        }
    }
}
