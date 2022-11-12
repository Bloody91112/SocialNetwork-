import { createStore } from 'vuex'
import User from './modules/user'
import Post from './modules/post'
import Category from './modules/category'
import Tag from './modules/tag'
import Author from './modules/author'
import Common from './modules/common'

const store = createStore({
    modules: {
        Category,
        User,
        Post,
        Tag,
        Author,
        Common
    }
})

export default store;
