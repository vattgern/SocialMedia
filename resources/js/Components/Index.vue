<template>
    <section class="main-section">
        <CreatePost></CreatePost>
        <CategoryMoblie></CategoryMoblie>
        <ul>
            <li :class=" tab === 'news' ? 'news active-main-section-li' : 'news'"
                @click="tab = 'news'">Новости</li>
            <li :class=" tab === 'moreNews' ? 'more-news active-main-section-li' : 'more-news'"
                @click="tab = 'moreNews'">Узнай больше</li>
            <li :class=" tab === 'my'? 'my active-main-section-li' : 'my' "
                @click="tab = 'my'">Мои посты</li>
        </ul>
        <div v-show="tab === 'news'">
            <Post v-if="this.$store.state.newsPosts"
                  v-for="(post, index) in this.$store.state.newsPosts"
                  :post="post"
                  :index="index"/>
        </div>
        <div v-show="tab === 'moreNews'">
            <Post v-if="this.$store.state.posts"
                  v-for="(post, index) in this.$store.state.posts"
                  :post="post"
                  :index="index"/>
        </div>
        <div v-show="tab === 'my'">
            <Post v-if="this.$store.state.myPosts"
                  v-for="(post, index) in this.$store.state.myPosts"
                  :post="post"
                  :index="index"/>
        </div>
    </section>
</template>

<script>
import Post from './layout/Post.vue';
import CreatePost from "./layout/CreatePost.vue";
import CategoryMoblie from "./layout/Category-moblie.vue";
import api from "../api";

export default {
    name: "Index",
    data(){
        return {
            tab: 'news',
            myCategories: [],
        }
    },
    components:{
        Post,
        CreatePost,
        CategoryMoblie,
    },
    mounted() {
        this.getLike();
        this.getMyPosts();
        this.getPosts();
    },
    methods: {
        getMyPosts(){
            api.get('/api/posts/my').then(response => {
                this.$store.state.myPosts = response.data.data;
            });
        },
        getPosts(){
            api.get('/api/posts').then(response => {
                this.$store.state.posts = response.data.data;
                this.setNewsPosts();
            });
        },
        setNewsPosts(){
            let posts = this.$store.state.posts;
            posts.forEach((post, index) => {
                let cats = this.$store.state.myCategories;
                cats.forEach(cat => {
                    if (cat.id === post.category.id) {
                        this.$store.state.newsPosts.push(post);
                    }
                });
            });
        },
        getLike(){
            api.get('/api/categories/my').then(r => {
                this.myCategories = r.data.data;
                this.$store.state.myCategories = r.data.data;
            })
        }
    }
}
</script>

<style scoped>
.main-section{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    width: 760px;
    background-color: var(--second-bg-color);
    border-radius: 14px;
}
.main-section ul{
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: start;
    margin-top: 40px;
    margin-bottom: 10px;
    margin-left: 10px;
}
.main-section ul li{
    font-family: 'Comfortaa', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 20px;
    color: var(--main-txt-color);
    margin-right: 50px;
    padding-bottom: 15px;
    cursor: pointer;
}
.active-main-section-li{
    border-bottom: 2px solid var(--second-color);
    border-radius: 1px;
}
@media screen and (max-width: 420px){
    .main-section{
        padding: 20px;
        width: 100vw;
    }
    .main-section ul li{
        font-size: 15px;
        margin-right: 30px;
    }
}
</style>
