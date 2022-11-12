<template>
    <NavbarComponent></NavbarComponent>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 app-content">
                        <RouterView/>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import NavbarComponent from "./components/NavbarComponent.vue";
export default {
    name: "App",
    components: {
        NavbarComponent
    },
    created() {
        this.$store.dispatch('initializeUser')
    }
}

</script>

<style>
    .app-content{
        padding: 10px;
        min-height: 82vh;
        max-height: 82vh;
        overflow: auto;
    }

    .app-content::-webkit-scrollbar {
        width: 5px;
    }

    .app-content::-webkit-scrollbar-track {
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 100px;
    }

    .app-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 118, 15, 1);
        border-radius: 100px;
    }

</style>
