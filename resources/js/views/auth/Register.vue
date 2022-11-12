<template>
    <div class="card custom-card">
        <div class="card-header">Register</div>

        <div class="card-body">
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                <div class="col-md-6">
                    <input id="name" v-model="name" type="text" class="form-control" name="name">
                    <Transition name="fade">
                        <span v-if="nameError" class="text-green mt-2"> {{ nameError }} </span>
                    </Transition>

                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                <div class="col-md-6">
                    <input id="email" v-model="email" type="email" class="form-control" name="email">
                    <Transition name="fade">
                        <span v-if="emailError" class="text-green mt-2"> {{ emailError }} </span>
                    </Transition>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                <div class="col-md-6">
                    <input id="password" v-model="password" type="password" class="form-control" name="password">
                    <Transition name="fade">
                        <span v-if="passwordError" class="text-green mt-2"> {{ passwordError }} </span>
                    </Transition>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
                <div class="col-md-6">
                    <input id="password-confirm" v-model="password_confirmation" type="password" class="form-control"
                           name="password_confirmation">
                    <Transition name="fade">
                        <span v-if="password_confirmationError" class="text-green mt-2"> {{ password_confirmationError }}</span>
                    </Transition>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button @click.prevent="register" type="submit" class="btn btn-green">Register</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../../router";

export default {
    name: "Register",
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            nameError: null,
            emailError: null,
            passwordError: null,
            password_confirmationError: null,
        }
    },
    methods: {
        register() {

            this.nameError = null;
            this.emailError = null;
            this.passwordError = null;
            this.password_confirmationError = null;

            if (!this.name) return this.nameError = 'Field name is required'
            if (!this.email) return this.emailError = 'Field email is required'
            if (!this.password) return this.passwordError = 'Field password is required'
            if (!this.password_confirmation) return this.password_confirmationError = 'Confirm password'

            axios.get('/sanctum/csrf-cookie').then(() => {
                axios.post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then((data) => {
                    localStorage.setItem('x_xsrf_token', data.config.headers['X-XSRF-TOKEN'])
                    this.$store.dispatch('initializeUser')
                    router.push({name: 'post.index'})
                }).catch(error => {
                    if (error.response.data.errors) {
                        let errors = error.response.data.errors;
                        if (errors.email) this.emailError = errors.email[0]
                        if (errors.password) {
                            this.passwordError = errors.password[0]
                            this.password_confirmationError = errors.password[1]
                        }
                    }
                })

            })
        },
    }
}
</script>

<style scoped>

</style>
