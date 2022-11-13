<template>
    <div class="author-info">
        <div>
            <div class="image">
                <img width="100" :src="avatar" :alt="name">
                <button :disabled="imageStatus" @click="imageStatus = !imageStatus" class="my-1 d-block btn btn-green" ref="dropzone">
                    {{ imageStatus ? 'Ready to load' : 'Update image' }}
                </button>
                <button v-if="imageStatus" class="my-1 d-block btn btn-green" @click="updateImage" >Upload image</button>
            </div>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Name <input v-on:focusout="editProfile('name', name)" v-model="name" type="text">
            </li>
            <transition name="fade">
                <span v-if="nameError" class="ms-5 text-green"> {{ nameError }} </span>
            </transition>


            <li class="list-group-item">
                Age <input v-on:focusout="editProfile('age', age)" v-model="age" type="number">
            </li>

            <li class="list-group-item">
                Gender <select v-on:change="editProfile('gender', gender)" v-model="gender" class="form-select form-select-sm" aria-label=".form-select-sm">
                    <option :selected="gender ==='male' ? 'selected' : ''"  value="male">Male</option>
                    <option :selected="gender ==='female' ? 'selected' : ''" value="female">Female</option>
                </select>
            </li>

        </ul>
    </div>
</template>

<script>
import {Dropzone} from "dropzone";

export default {
    name: "AuthorCardEditComponent",
    props: ['author'],
    data(){
        return {
            avatar: this.author.avatar,
            name: this.author.name,
            gender: this.author.gender,
            age: this.author.age,
            email: this.author.email,
            dropzone: null,
            imageStatus: false,
            nameError: null,
        }
    },
    watch:{
      author(){this.avatar = this.author.avatar}
    },

    mounted(){

        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: `none`,
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            paramName: 'avatar',
            resizeWidth: 80
        })
    },
    methods: {
        updateImage(){
            this.imageStatus = !this.imageStatus
            this.$store.dispatch('editAvatar', this.dropzone.getAcceptedFiles());
            this.dropzone.removeAllFiles()
        },
        editProfile(property, value){
            if (!this.name) return this.nameError = 'Field name is required!'
            let payload = { [property]: value }
            this.$store.dispatch('editProfile', payload)
            this.nameError = null
        }
    }
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

.form-select-sm{
    width: 100px;
    color: #00760f;
    background-color: black;
    border: none!important;
}

.form-select-sm:active{
    border:none;
    outline:none;
    box-shadow: none;
}


@media (max-width: 500px){
    .author-info{
        flex-wrap: wrap;
    }
}
</style>
