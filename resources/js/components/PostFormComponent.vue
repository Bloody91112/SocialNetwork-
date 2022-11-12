<template>
    <Transition name="fade">
        <div v-if="visible" class="card custom-card mb-3">
            <div class="card-header"></div>
            <div class="card-body">
                <!-- TITLE -->
                <div class="row mb-3">
                    <label for="title" class="col-md-2 col-form-label text-md-end">Title</label>
                    <div class="col-md-8">
                        <input id="title" v-model="title" type="text" class="form-control" name="title">
                        <Transition name="fade">
                            <span v-if="titleError" class="text-green mt-2"> {{ titleError }} </span>
                        </Transition>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="row mb-3">
                    <label for="content" class="col-md-2 col-form-label text-md-end">Content</label>
                    <div class="col-md-8">
                        <textarea id="content" v-model="content" type="text" class="form-control" name="content"></textarea>
                        <Transition name="fade">
                            <span v-if="contentError" class="text-green mt-2"> {{ contentError }} </span>
                        </Transition>
                    </div>
                </div>

                <div class="row">
                    <!-- CATEGORIES -->
                    <div v-if="categories" class="col-md-3 mb-2 d-flex align-items-center gap-3 offset-md-2 dropdown">
                        <div>Category</div>
                        <button class="btn btn-green dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ selectedCategory != null ? selectedCategory.name : 'none' }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li v-for="category in categories" >
                                <a @click.prevent="this.selectedCategory = category" class="dropdown-item" href="#">
                                    {{ category.name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--TAGS-->
                    <div v-if="tags.length > 0" class="col-md-5 mb-2 d-flex align-items-center gap-3 dropdown">
                        <div>Tags</div>
                        <button class="btn btn-green dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ selectedTags.length > 0 ? selectedTags[selectedTags.length - 1].name : 'none' }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <li v-for="tag in tags" >
                                <a @click.prevent="addTag(tag)" class="dropdown-item" href="#">
                                    {{ tag.name }}
                                </a>
                            </li>
                        </ul>
                        <span v-if="selectedTags.length" >
                            <span class="selectedTagsList" >
                                <span v-for="tag in selectedTags" class="selectedTag">{{ tag.name }}</span>
                            </span>
                        </span>
                    </div>
                </div>
                <Transition name="fade">
                    <div v-if="tagsError" class="col-md-5 mt-1 offset-md-2">{{ tagsError }}</div>
                </Transition>
            </div>
            <div @click.prevent="createPost" class="card-footer card-footer-green-btn">
                <span>Create</span>
            </div>
        </div>
    </Transition>

</template>

<script>
export default {
    name: "PostFormComponent",
    data(){
        return{
            title: null,
            content: null,
            selectedCategory: null,
            selectedTags: [],
            titleError: null,
            contentError: null,
            tagsError: null,
        }
    },
    mounted() {
        this.$store.dispatch('getCategories')
        this.$store.dispatch('getTags')
    },
    computed: {
        visible(){ return this.$store.getters.createFormStatus },
        user_id(){ return this.$store.getters.user.id },
        categories(){ return this.$store.getters.categories },
        tags(){ return this.$store.getters.tags }
    },
    methods: {
        addTag(tag){
            let tagSelected = false;
            this.selectedTags.forEach( selectedTag => selectedTag.id === tag.id ? tagSelected = true: null )
            if (tagSelected){
                this.selectedTags = this.selectedTags.filter( selectedTag => selectedTag.id !== tag.id  )
            } else {
                this.selectedTags.push(tag)
            }
        },


        createPost(){
            if ( !this.title ) return this.titleError = "Field title is required"
            if ( !this.content ) return this.contentError = "Field title is required"
            if ( this.selectedTags.length > 3 ) return this.tagsError = 'Maximum number of tags - 3'

            let payload = { title:this.title, content:this.content, user_id: this.user_id  }

            if (this.selectedTags.length > 0 ){
                let tags = [];
                this.selectedTags.forEach( tag => tags.push(tag.id) )
                payload.tags = tags
            }

            if (this.selectedCategory != null) payload.category_id = this.selectedCategory.id
            this.$store.dispatch('createPost', payload)

            this.title = null
            this.content = null
            this.selectedCategory = null
            this.selectedTags = []

        }
    },
}
</script>

<style scoped>
    .selectedTagsList{
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    .selectedTag{
        background-color: #00760f;
        padding: 2px 5px;
        border-radius: 5px;
        color: black;
        font-size: 11px;
    }
    .dropdown-toggle{
        padding: 1px 4px!important;
    }
    .card-body{
        padding-bottom: 5px;
    }
</style>
