import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/auth/login",
            name: "auth.login",
            component: () => import("../views/auth/Login.vue"),
        },

        {
            path: "/auth/register",
            name: "auth.register",
            component: () => import("../views/auth/Register.vue"),
        },


        {
            path: "/",
            name: "post.index",
            component: () => import("../views/post/Index.vue"),
        },

        {
            path: "/author/:id",
            name: "author.show",
            component: () => import("../views/author/Show.vue"),
        },

    ],
});

router.beforeEach(( to, from, next )=> {

    let token = localStorage.getItem('x_xsrf_token')

    if(!token) {
        if (to.name === 'auth.login' || to.name === 'auth.register'){
            return next()
        } else {
            return next({name:'auth.login'})
        }
    }

    if (to.name === 'auth.login' || to.name === 'auth.register' && token){
        return next({name: 'post.index'})
    }
    next()
})

export default router;
