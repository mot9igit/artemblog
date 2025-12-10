<template>
    <div>
        <vForm
            title="Создание новой категории"
            submit_text="Создать категорию"
            method="post"
            form_url="/api/product/category"
            redirect_url="/adm/products/categories/"
            :form_data="this.formData"
        />
    </div>
</template>

<script>
import vForm from '../../main/form/v-form.vue';

export default {
    name: "CreateComponent",
    components: {
        vForm
    },
    data() {
        return {
            // 1 уровень - срока, 2 уровень сетка, 3 уровень - поле
            formData: [{
                grids: [{
                    class: "d-col-md-24",
                    fields: {
                        title: {
                            type: 'text',
                            value: '',
                            label: "Наименование"
                        }
                    }
                },{
                    class: "d-col-md-24",
                    fields: {
                        description: {
                            type: 'textarea',
                            value: '',
                            label: "Описание"
                        }
                    }
                },{
                    class: "d-col-md-24",
                    fields: {
                        content: {
                            type: 'richtext',
                            value: '',
                            label: "Контент"
                        }
                    }
                }]
            }]
        }
    },
    methods: {
        addCategory(){
            axios.post('/api/product/category', this.form)
                .then(res => {
                    window.location.href = "/adm/products/categories/";
                })
                .catch((error) => {
                    this.errors = error.response?.data?.errors
                });
        }
    }
}
</script>

<style scoped>

</style>
