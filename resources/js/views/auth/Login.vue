<template>
    <div class="card custom-card">
        <div class="card-header">Login</div>

        <div class="card-body">
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
                    <input v-model="password" id="password" type="password" class="form-control" name="password">
                    <Transition name="fade">
                        <span v-if="passwordError" class="text-green mt-2"> {{ passwordError }} </span>
                    </Transition>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-8 offset-md-4">
                    <Transition name="fade">
                        <span v-if="commonError" class="text-green mt-2"> {{ commonError }} </span>
                    </Transition>
                </div>
            </div>


            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button @click="login" type="submit" class="btn btn-green">Login</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../../router";

export default {
    name: "Login",
    data() {
        return {
            email: null,
            password: null,
            emailError: null,
            passwordError: null,
            commonError: null,
        }
    },
    methods: {
        login() {

            this.emailError = null;
            this.passwordError = null;

            if (!this.email) return this.emailError = 'Field email is required'
            if (!this.password) return this.passwordError = 'Field password is required'

            axios.get('/sanctum/csrf-cookie')
                .then(() => {
                    axios.post('/api/login', {email: this.email, password: this.password})
                        .then((data) => {
                            console.log(data)
                            localStorage.setItem('x_xsrf_token', data.config.headers['X-XSRF-TOKEN'])
                            this.$store.dispatch('initializeUser')
                            router.push({name: 'post.index'})
                        })
                        .catch((error) => {
                            this.commonError = error.response.data.message
                        })
                });
        },
    }
}
</script>

<style scoped>

</style>
