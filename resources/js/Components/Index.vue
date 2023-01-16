<template>
    <section class="main-section">
        <CreatePost></CreatePost>
        <ul>
            <li class="news active-main-section-li">Новости</li>
            <li class="more-news">Узнай больше</li>
            <li class="my">Мои посты</li>
        </ul>
        <Post></Post> 
    </section>
</template>

<script>
import CreatePost from "./layout/CreatePost.vue";
import Post from "./layout/Post.vue";
export default {
    name: "Index",
    data(){
        return {

        }
    },
    components: {
        CreatePost,
        Post,
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
    font-family: 'Comfortaa';
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 20px;
    color: var(--main-txt-color);
    margin-right: 50px;
    padding-bottom: 15px;
}
.main-section ul li:hover{
    cursor: pointer;
}
.active-main-section-li{
    border-bottom: 2px solid #D17A28;
    border-radius: 1px;
}

</style>
