<template>
    <div class="author-info">
        <div>
            <div class="image">
                <img width="100" :src="author.avatar" :alt="author.name">
            </div>
        </div>

        <ul class="list-group list-group-flush">
            <li v-if="author.name" class="list-group-item">
                Name<span class="info-value">{{ author.name }}</span>
            </li>

            <li v-if="author.age" class="list-group-item">
                Age<span class="info-value">{{ author.age }}</span>
            </li>

            <li v-if="author.gender" class="list-group-item">
                Gender<span class="info-value">{{ author.gender }}</span>
            </li>

            <li class="list-group-item">
                Role<span class="info-value">{{ author.role }}</span>
            </li>

            <li class="list-group-item">
                Registered<span class="info-value">{{ author.created_at }}</span>
            </li>

            <li class="list-group-item" v-if="author.posts">
                Posts published<span class="info-value">{{ author.posts.length }}</span>
            </li>

            <li class="list-group-item" v-if="author.posts">
                Сomments left<span class="info-value">{{ author.comments.length }}</span>
            </li>

            <li class="list-group-item" v-if="author.subscriptions.length > 0">
                Subscribed to
                <div class="d-inline-flex flex-wrap gap-2">
                    <span class="info-value" v-for="sub in author.subscriptions">
                        <router-link :to="{ name: 'author.show', params: { id: sub.friend.id } }" @click="$store.dispatch('getAuthor', sub.friend.id)" class="btn-green-link">{{sub.friend.name }}</router-link>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "AuthorCardComponent",
    props: ['author']
}
</script>

<style scoped>
.author-info {
    display: flex;
    min-width: 100%;
    gap: 30px;
    padding: 0 20px;
    justify-content: center;
}

.author-info ul {
    flex: 0 1 500px;
}

.author-info ul li {
    background-color: #00760f;
    color: black;
    display: flex;
    justify-content: space-between;
}

.info-value {
    color: green;
    background-color: black;
    padding: 2px 8px;
    margin-left: 10px;
}

@media (max-width: 500px) {
    .author-info {
        flex-wrap: wrap;
    }
}
</style>
