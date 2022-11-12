<template>
    <div v-if="author" class="card custom-card mb-3">
        <div class="fs-5 card-header">
            <template v-if="!myPage">
                <span @click="toggleSubscribe($event,false)" v-if="subscribed" class="subscribed">subscribed</span>
                <span @click="toggleSubscribe($event,true)" v-else class="not-subscribed subscribed">subscribe</span>
            </template>

            <span v-else >
                <span class="card-title me-3">My page</span>
                <button @click="$store.commit('setEditMode', !this.editMode)"
                        :class="{ 'active-button': this.editMode }"
                        class="btn header-btn" >
                    Edit
                </button>
            </span>

            <button @click="updatePostsStatus"
                    :class="{ 'active-button': this.modelValue }"
                    class="header-btn">
                Show {{ myPage? 'my' : author.name }} posts
            </button>
        </div>
        <div class="card-body">
            <AuthorCardEditComponent v-if="this.editMode" :author="author"></AuthorCardEditComponent>
            <AuthorCardComponent v-else :author="author"></AuthorCardComponent>
        </div>
        <div class="card-footer"></div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import AuthorCardComponent from "./AuthorCardComponent.vue";
import AuthorCardEditComponent from "./AuthorCardEditComponent.vue";

export default {
    name: "AuthorInfoComponent",
    components: {AuthorCardEditComponent, AuthorCardComponent},
    props: ['author', 'modelValue'],
    methods: {
        updatePostsStatus(){ this.$emit('update:modelValue', !this.modelValue) },
        toggleSubscribe(event,action) {
            this.$store.dispatch('toggleSubscribe', { action: action, button: event.currentTarget})
        }
    },
    computed: {
        ...mapGetters({
            user: 'user',
            editMode : 'editMode'
        }),
        myPage(){ return this.author.id === this.user.id },
        subscribed(){ return !!this.user.subscriptions.find( obj => obj.friend.id === this.author.id ) }
    },
}
</script>

<style scoped>


.header-btn{
    font-size: 14px;
    border: 3px solid black;
    border-radius: 5px;
    background-color: #00760f;
    color: black;
    padding: 2px 10px;
    margin: 0 5px;
    font-weight: bold;
    transition-duration: 0.3s;
}

.show-posts:hover{
    background-color: #00b01b;
}

.active-button{
    border-color: black;
    background-color: #00b01b;
    color: black;
}

.subscribed{
    box-shadow: 0 0 5px black;
    font-size: 16px;
    cursor: pointer;
    transition-duration: 0.3s;
}

.not-subscribed{
    background-color: black;
    color: #00760f;
    box-shadow: unset;
}

.subscribed:hover{
    box-shadow: 0 0 10px black;
}


</style>
