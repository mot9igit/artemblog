<template>
    <div class="dart-container">
        <Toast />
        <ConfirmDialog></ConfirmDialog>
        <div class="dart-row">
            <div class="d-col-md-6">
                <Tree :value="productCategoriesTree" filter filterBy="title">
                    <template #default="slotProps">
                        <b>{{ slotProps.node.title }} <small>({{ slotProps.node.id }})</small></b>
                    </template>
                </Tree>
            </div>
            <div class="d-col-md-18">
                <v-table
                    class=""
                    :filters="this.productCategoryTable.filters"
                    :items_data="productCategories.data"
                    :total="productCategories.total"
                    :pagination_items_per_page="this.pagination_items_per_page"
                    :pagination_offset="this.pagination_offset"
                    :page="this.productCategoryTable.page"
                    :table_data="this.productCategoryTable.table_data"
                    title="Категории товаров"
                    @filter="filter"
                    @sort="filter"
                    @paginate="paginate"
                    @deleteElem="deleteElem"
                >
                    <template v-slot:button>
                        <div>
                            <a href="/adm/products/categories/create" class="btn btn-primary"> Создать категорию </a>
                        </div>
                    </template>
                </v-table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Toast from 'primevue/toast';
import ConfirmDialog from "primevue/confirmdialog";
import Tree from 'primevue/tree';
import vTable from "../../../admin/main/table/v-table.vue";
import Axios from "axios";

export default {
    name: "ProductCategories",
    props: {
        pagination_items_per_page: {
            type: Number,
            default: 24,
        },
        pagination_offset: {
            type: Number,
            default: 0,
        }
    },
    data() {
        return {
            confirm: null,
            toast: null,
            productCategoryTable:{
                page: 1,
                pagination_offset: 0,
                pagination_items_per_page: 25,
                filter: {},
                filters: {
                    name: {
                        name: "Наименование Категории",
                        placeholder: "Наименование Категории",
                        type: "text",
                    }
                },
                table_data: {
                    id: {
                        label: "№",
                        type: "text",
                    },
                    title: {
                        label: 'Наименование',
                        type: 'text',
                    },
                    actions: {
                        label: 'Действия',
                        type: 'actions',
                        sort: false,
                        available: {
                            edit: {
                                icon: 'bi bi-eye',
                                label: 'Подробнее'
                            },
                            delete: {
                                icon: 'bi bi-trash',
                                label: 'Удалить'
                            }
                        }
                    }
                },
            }
        };
    },
    methods: {
        ...mapActions([
            'getProductCategories',
            'getProductCategoriesTree'
        ]),
        filter (data) {
            this.getProductCategories(data)
        },
        paginate (data) {
            this.productCategoryTable.page = data.page
            this.getProductCategories(data)
        },
        deleteElem (data) {
            // 1. Запрашиваем подтверждение
            this.$confirm.require({
                message: `Вы уверены, что хотите удалить категорию товаров - ${data.title}?`,
                header: 'Подтверждение',
                icon: 'bi bi-exclamation-triangle',
                rejectProps: {
                    label: 'Отмена',
                    severity: 'secondary',
                    outlined: true
                },
                acceptProps: {
                    label: 'Да'
                },
                accept: () => {
                    // 2. Отправляем запрос на API
                    return Axios(`/api/product/category/${data.id}`, {
                        method: 'DELETE'
                    })
                        .then((response) => {
                            this.productCategoryTable.page = 1
                            this.getProductCategories({
                                page: this.productCategoryTable.page,
                                perpage: this.pagination_items_per_page
                            })
                        })
                        .catch(error => {
                            if (error.response.status === 404) {
                                this.$toast.add({ severity: 'error', summary: 'Не найден', detail: 'Объект не найден', life: 3000 });
                                this.getProductCategories({
                                    page: this.productCategoryTable.page,
                                    perpage: this.pagination_items_per_page
                                })
                            }
                            if (error.response.status === 500) {
                                this.$toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Внутренняя ошибка сервера', life: 3000 });
                            }
                            if (error.response.status === 403) {
                                // TODO: to auth page
                            }
                        })
                },
                reject: () => {
                    this.$toast.add({ severity: 'error', summary: 'Отмена', detail: 'Действие отменено', life: 3000 });
                }
            });
        }
    },
    mounted() {
        this.getProductCategoriesTree()
        this.getProductCategories({
            page: this.productCategoryTable.page,
            perpage: this.pagination_items_per_page
        })
    },
    components: {
        vTable,
        Toast,
        ConfirmDialog,
        Tree
    },
    computed: {
        ...mapGetters([
            "productCategories",
            "productCategoriesTree"
        ])
    },
    watch: {
    },
};
</script>

<style lang="scss">
.p-tree-node-children{
    padding-left: 15px !important;
}
</style>
