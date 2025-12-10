<template>
    <div class="dart-container">
        <Toast />
        <ConfirmDialog></ConfirmDialog>
        <form action="#" @submit.prevent="store()" class="dart-mt-2">
            <div class="profile_avatar">
                <div ref="avatar-dropzone" class="avatar-dropzone">
                </div>
                <img :src="form.avatar" :alt="form.name" v-if="form.avatar"/>
                <div v-else class="blank-image">
                    +
                </div>
            </div>
            <div class="dart-row">
                <div class="d-col-md-12">
                    <div class="dart-form-group">
                        <FloatLabel variant="on">
                            <InputText id="profile_name" v-model="form.name" />
                            <label for="profile_name">Логин</label>
                        </FloatLabel>
                    </div>
                    <div class="dart-form-group">
                        <FloatLabel variant="on">
                            <InputText id="profile_fullname" v-model="form.fullname" />
                            <label for="profile_fullname">Ф. И. О.</label>
                        </FloatLabel>
                    </div>
                    <div class="dart-form-group">
                        <FloatLabel variant="on">
                            <InputText id="profile_email" v-model="form.email" />
                            <label for="profile_email">E-mail</label>
                        </FloatLabel>
                    </div>
                    <div class="dart-form-group">
                        <FloatLabel variant="on">
                            <InputText id="profile_phone" v-model="form.phone" />
                            <label for="profile_phone">Телефон</label>
                        </FloatLabel>
                    </div>
                </div>
                <div class="d-col-md-24">
                    <button class="btn btn-primary" type="button" disabled v-if="loading">
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Загрузка...</span>
                    </button>
                    <button type="submit" class="btn btn-primary" v-else>Сохранить!</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Toast from 'primevue/toast';
import ConfirmDialog from "primevue/confirmdialog";
import FloatLabel from 'primevue/floatlabel';
import InputText from "primevue/inputtext";
import Axios from "axios";
import Dropzone from 'dropzone'

export default {
    name: "ProfileForm",
    props: {
        user_id: {
          type: Number,
          default: 0
        }
    },
    data() {
        return {
            loading: false,
            dropzone: null,
            form: {
                name: "",
                fullname: "",
                email: "",
                avatar: ""
            }
        }
    },
    methods: {
        ...mapActions([
            'getProfile'
        ]),
        store(){
            this.loading = true
            const form = new FormData();
            const files = this.dropzone.getAcceptedFiles();
            files.forEach(file => {
                form.append('images[]', file);
                this.dropzone.removeFile(file);
            })
            form.append('name', this.form.name);
            form.append('email', this.form.email);
            form.append('fullname', this.form.fullname);
            form.append('phone', this.form.phone);
            axios.post("/api/profile", form)
                .then(() => {
                    this.loading = false
                    window.location.reload()
                })
        }
    },
    mounted() {
        const userData = {
            user_id: this.user_id
        }
        this.getProfile(userData).then(() => {
            this.dropzone = new Dropzone(this.$refs["avatar-dropzone"], {
                url: "/api/profile",
                autoProcessQueue: false,
                addRemoveLinks: true
            });
            this.form.name = this.profile.name;
            this.form.email = this.profile.email;
            this.form.fullname = this.profile.fullname;
            this.form.avatar = this.profile.avatar;
            this.form.phone = this.profile.phone;
        })
    },
    components: {
        Toast,
        ConfirmDialog,
        FloatLabel,
        InputText
    },
    computed: {
        ...mapGetters([
            'profile'
        ])
    },
    watch: {
    }
};
</script>

<style lang="scss">
    .profile_avatar{
        display: block;
        max-width: 120px;
        max-height: 120px;
        border-radius: 50%;
        position: relative;
        margin-bottom: 30px;
        img{
            display: inline-block;
            max-width: 120px;
            max-height: 120px;
            border-radius: 50%;
        }
        .blank-image{
            width: 120px;
            height: 120px;
            background: rgba(0,0,0,.8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            fint-size: 30px;
            color: #fff;
        }
        & .avatar-dropzone{
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            z-index: 9;
            border-radius: 50%;
            cursor: pointer;
            transition: all .2s ease;
            &:hover{
                background: rgba(0,0,0,.6);
                color: #fff;
                opacity: 1;
                transition: all .2s ease;
                &::before{
                    content: "\f4cb";
                    display: inline-block;
                    font-family: bootstrap-icons !important;
                    font-style: normal;
                    font-weight: 400 !important;
                }
            }
            &.dz-started{
                position: relative;
                max-width: 120px;
                max-height: 120px;
                border-radius: 50%;
                opacity: 1;
                color: #fff;
                overflow: hidden;
                &::before{
                    display: none;
                }
                & + *{
                    display: none;
                }
                .dz-preview{
                    position: relative;
                    &::after{
                        content: '';
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        border-radius: 50%;
                        top: 0;
                        left: 0;
                        background: rgba(0,0,0,.6);
                        color: #fff;
                        opacity: 1;
                        transition: all .2s ease;
                    }
                    .dz-image{
                        max-width: 120px;
                        max-height: 120px;
                        border-radius: 50%;
                    }
                    .dz-details{
                        position: absolute;
                        bottom: 50px;
                        left: 0;
                        font-size: 10px;
                        max-width: 120px;
                        z-index: 3;
                        text-align: center;
                    }
                    .dz-success-mark{
                        position: absolute;
                        bottom: 60px;
                        left: 0;
                        font-size: 10px;
                        z-index: 3;
                        display: none;
                    }
                    .dz-error-mark{
                        position: absolute;
                        bottom: 60px;
                        left: 0;
                        font-size: 10px;
                        z-index: 3;
                        display: none;
                    }
                    .dz-remove{
                        position: absolute;
                        width: 100%;
                        display: block;
                        bottom: 5px;
                        font-size: 10px;
                        text-align: center;
                        text-indent: -9999px;
                        z-index: 3;
                        &::before{
                            content: "\f659";
                            position: absolute;
                            display: inline-block;
                            font-family: bootstrap-icons !important;
                            font-style: normal;
                            font-size: 24px;
                            color: #fff;
                            left: 50%;
                            top: -30px;
                            transform: translate(-50%,0);
                            text-indent: 0;
                            font-weight: 400 !important;
                        }
                    }
                }
            }
        }
    }
</style>
