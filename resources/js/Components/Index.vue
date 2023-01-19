<template>
    <section class="main-section">
        <CreatePost></CreatePost>
        <ul>
            <li :class=" tab === 'news' ? 'news active-main-section-li' : 'news'"
                @click="tab = 'news'">Новости</li>
            <li :class=" tab === 'moreNews' ? 'more-news active-main-section-li' : 'more-news'"
                @click="tab = 'moreNews'">Узнай больше</li>
            <li :class=" tab === 'my'? 'my active-main-section-li' : 'my' "
                @click="tab = 'my'">Мои посты</li>
        </ul>
        <Post></Post>
    </section>
</template>

<script>
import Post from './layout/Post.vue';
import CreatePost from "./layout/CreatePost.vue";

export default {
    name: "Index",
    data(){
        return {
            tab: 'news',
        }
    },
    components:{
        Post,
        CreatePost,
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
</style>
