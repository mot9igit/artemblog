<template>
    <div class="dart-container">
        <Toast />
        <ConfirmDialog></ConfirmDialog>
        <div class="dart-row">
            <div class="d-col-md-24">
                <v-table
                    class=""
                    :filters="this.userTable.filters"
                    :items_data="users.data"
                    :total="users.total"
                    :pagination_items_per_page="this.pagination_items_per_page"
                    :pagination_offset="this.pagination_offset"
                    :page="this.userTable.page"
                    :table_data="this.userTable.table_data"
                    title="Пользователи"
                    @filter="filter"
                    @sort="filter"
                    @paginate="paginate"
                    @deleteElem="deleteElem"
                >
                    <template v-slot:button>
                        <div>
                            <a href="/adm/products/categories/create" class="btn btn-primary"> Создать пользователя </a>
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
import vTable from "../../admin/main/table/v-table.vue";
import Axios from "axios";

export default {
    name: "Users",
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
            userTable:{
                page: 1,
                pagination_offset: 0,
                pagination_items_per_page: 25,
                filter: {},
                filters: {
                    name: {
                        name: "Имя",
                        placeholder: "Имя",
                        type: "text",
                    }
                },
                table_data: {
                    id: {
                        label: "№",
                        type: "text",
                    },
                    name: {
                        label: 'Наименование',
                        type: 'text',
                    },
                    email: {
                        label: 'E-mail',
                        type: 'text',
                    },
                    phone: {
                        label: 'Телефон',
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
            'getUsers'
        ]),
        filter (data) {
            this.getUsers(data)
        },
        paginate (data) {
            this.userTable.page = data.page
            this.getUsers(data)
        },
        deleteElem (data) {
            // 1. Запрашиваем подтверждение
            this.$confirm.require({
                message: `Вы уверены, что хотите удалить пользователя - ${data.name}?`,
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
                    return Axios(`/api/users/${data.id}`, {
                        method: 'DELETE'
                    })
                        .then((response) => {
                            this.usersTable.page = 1
                            this.getUsers({
                                page: this.userTable.page,
                                perpage: this.pagination_items_per_page
                            })
                        })
                        .catch(error => {
                            if (error.response.status === 404) {
                                this.$toast.add({ severity: 'error', summary: 'Не найден', detail: 'Объект не найден', life: 3000 });
                                this.getUsers({
                                    page: this.userTable.page,
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
        this.getUsers({
            page: this.userTable.page,
            perpage: this.pagination_items_per_page
        })
    },
    components: {
        vTable,
        Toast,
        ConfirmDialog
    },
    computed: {
        ...mapGetters([
            "users"
        ])
    },
    watch: {
    },
};
</script>

<style lang="scss">
</style>
