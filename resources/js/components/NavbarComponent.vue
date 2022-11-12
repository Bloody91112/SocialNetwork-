<template>
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <router-link class="navbar-brand" :to="{ name: 'post.index'}">
                Social network
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars"></i>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul v-if="this.user" class="navbar-nav me-auto">
                    <li class="nav-item">
                        <Transition name="fade">
                        <button
                            class="btn-green"
                            :class="{'active': $store.getters.createFormStatus}"
                            @click="$store.dispatch('toggleCreateForm')">New post</button>
                        </Transition>
                    </li>
                </ul>

                <form v-if="this.user" class="custom-search d-flex my-2">
                    <input class="form-control me-2 shadow-none" type="search" v-model="searchValue" placeholder="Search(by title)" aria-label="Search">
                    <button @click.prevent="$store.dispatch('searchPosts', this.searchValue )" class="btn btn-green"><i class="fas fa-search"></i></button>
                </form>

                <!-- Center Of Navbar -->
                <ul v-if="this.user" class="navbar-nav mx-auto">

                    <li @click.prevent="$store.dispatch('getSortedPosts', 'all')"
                        :class="{ 'active': this.mode === 'all' }"
                        class="nav-item mx-2 text-green fw-bold">
                        All
                    </li>
                    <li @click.prevent="$store.dispatch('getSortedPosts', 'sub')"
                        :class="{ 'active': this.mode === 'sub' }"
                        class="nav-item mx-2 text-green fw-bold">
                        Subscriptions
                    </li>
                    <li @click.prevent="$store.dispatch('getSortedPosts', 'pop')"
                        :class="{ 'active': this.mode === 'pop' }"
                        class="nav-item mx-2 text-green fw-bold">
                        Popular
                    </li>
                    <li @click.prevent="$store.dispatch('getSortedPosts', 'mine')"
                        :class="{ 'active': this.mode === 'mine' }"
                        class="nav-item mx-2 text-green fw-bold">
                        My posts
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                    <li v-if="this.user" class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ this.user.name }}
                        </a>


                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <router-link :to="{ name: 'author.show', params: { id : this.user.id } }"
                                         @click="$store.dispatch('getAuthor', this.user.id )"
                                         class="dropdown-item">My page</router-link>
                            <a @click.prevent="logout" class="dropdown-item" href="#">Logout</a>
                        </div>
                    </li>

                    <template v-else>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'auth.login' }">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'auth.register' }">Register</router-link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from "axios";
import router from "../router";
import {mapGetters} from "vuex";

export default {
    name: "NavbarComponent",
    data(){
      return {
          searchValue: null
      }
    },
    computed: {
        ...mapGetters({
            user: 'user',
            mode: 'postsMode'
            }),
    },

    methods : {
        logout() {
            localStorage.removeItem('x_xsrf_token')
            axios.post('/api/logout')
            this.$store.commit('setUser', null)
            router.push({ name: 'auth.login' })
        }
    }
}
</script>

<style scoped>
    a{
        color: #00760f!important;
    }
    nav{
        background-color: rgba(0,0,0,0.7);
    }

    li:hover{
        cursor: pointer;
    }

    li.active{
        color: #00b01b;
        text-shadow: 0 0 5px #00760f
    }

    .nav-item .active{
        color: #00760f;
        background-color: black;
        outline: 3px solid #00760f;
    }

    .navbar-brand{
        color: #00760f;
    }
    .navbar-toggler{
        background-color: black;
        color: #00760f;
    }
    .navbar-toggler-icon i {
        color: #00760f;
        font-size: 26px;
    }
    .dropdown-menu{
        background: rgba(0,0,0,0.8);
    }
    .dropdown-menu a, .dropdown-toggle{
        font-weight: bold;
    }
    .dropdown-item:hover, .dropdown-item:focus{
        background: rgba(0,0,0,1.0);
    }

    .custom-search .form-control{
        background-color: black;
        color: #00b01b;
        border: 2px solid #00b01b;
    }



    @media (max-width: 768px) {
        .navbar-nav {
            display: inline-flex;
        }

        ul.mx-auto{
            flex-direction: row;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 358px) {
        ul.mx-auto{
            margin-top: 10px;
        }

        #navbarDropdown{
            margin-left: 8px;
        }
    }
</style>
