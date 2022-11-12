<template>
    <div v-if="comment" class="row my-2">
        <div class="col-md-6">
            <div class="card custom-card">
                <div class="card-header">
                    <a class="author">{{ comment.user.name }}</a>
                    <span class="date" v-if="comment.created_at"> {{ `(${comment.created_at})`  }}</span>
                    <button @click="deleteComment" v-if="myComment" class="deleteComment">delete</button>
                </div>
                <div class="card-body"> {{ comment.content }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCommentItemsComponent",
    props: ['comment'],
    computed: { myComment(){ return this.comment.user.id === this.$store.getters.user.id } },
    methods: {
        deleteComment(){
            this.$store.dispatch('deleteComment', { comment:this.comment })
        }
    }
}
</script>

<style scoped>
    .author{
        text-decoration: none;
        color: black;
    }
    .date{
        margin-left: 5px;
        font-size: 11px;

    }
    .card-header{
        display: flex;
        align-items: center;
        justify-self: flex-start;
        position: relative;
    }
    .deleteComment{
        position: absolute;
        right: 10px;
        top: 5px;
        border: none;
        background-color: black;
        color: #00760f;
        border-radius: 5px;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>
