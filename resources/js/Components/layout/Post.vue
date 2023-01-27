<template>
    <div class="my-post">
        <div class="top-post">
            <router-link :to="{ name:'anotherUser', params: {id: post.author.id} }">
                <div>
                    <img :src="post.author.avatar" alt="No Ethernet">
                    <h1>{{ post.author.name }}</h1>
                </div>
            </router-link>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" @click="dropMenu">
                <path d="M12 17C13.1046 17 14 17.8954 14 19C14 20.1046 13.1046 21 12 21C10.8954 21 10 20.1046 10 19C10 17.8954 10.8954 17 12 17Z" fill="#E5E5E5"/>
                <path d="M12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10Z" fill="#E5E5E5"/>
                <path d="M12 3C13.1046 3 14 3.89543 14 5C14 6.10457 13.1046 7 12 7C10.8954 7 10 6.10457 10 5C10 3.89543 10.8954 3 12 3Z" fill="#E5E5E5"/>
            </svg>
            <div class="menu-drop" v-show="menu && post.author.id === this.$store.state.user.id">
                <button>Редактировать</button>
                <button @click.prevent="deletePost(post.id)">Удалить</button>
            </div>
        </div>
        <p class="category">{{post.category.name}}</p>
        <p>{{ post.content }}</p>
        <div class="img-post">
            <img :class="post.images.length === 1 ? 'one-picture' : 'no-one-picture'" v-for="image in post.images" :src="'/storage/'+image.url" alt="No Ethernet">
        </div>
    </div>
</template>

<script>
import api from "../../api";
    export default {
        props:{
            post: Object,
            index: Number
        },
        data(){
            return {
                menu: false,
            }
        },
        methods:{
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
                    let cat = this.myCategories;
                    for (let i=0; i < cat.length; i++){
                        if(post.id === cat[i].id){
                            this.$store.state.newsPosts.push(post);
                        }
                    }
                });
            },
            getLike(){
                api.get('/api/categories/my').then(r => {
                    this.myCategories = r.data.data;
                    this.$store.state.myCategories = r.data.data;
                })
            },
            activeMenu(){
                if(this.menu){
                    document.querySelector('.menu-drop').style.right = 20 + 'px';
                    setTimeout(() => {  document.querySelector('.menu-drop').classList.add('menu-drop-animate'); }, 250);

                }else if(this.menu){
                    document.querySelector('.menu-drop').classList.remove('menu-drop-animate');
                    document.querySelector('.menu-drop').style.right = -220 + 'px';

                }

            },
            dropMenu(){
                this.menu = !this.menu;
            },
            deletePost(id){
                api.delete(`/api/posts/${id}`).then(r => {
                    this.$store.state.myPostsCount--;
                    if(this.$route.name === 'profile'){
                        this.$store.state.myPosts.splice(this.index, 1);
                    } else {
                        // this.$store.state.posts.splice(this.index, 1);
                        this.getLike();
                        this.getMyPosts();
                        this.getPosts();
                    }
                });
            },
        }
    }
</script>

<style lang="css" scoped>
.category{
    border: 2px #686FFD solid;
    padding: 10px 25px;
    border-radius: 15px;
    background-color: #686FFD;
}
.my-post{
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: var(--main-bg-color);
    width: 720px;
    border-radius: 14px;
    padding: 20px;
    margin-top: 30px;
    z-index: 1;
    overflow: hidden;
}
.top-post{
    position: relative;
    z-index: 5;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 20px;
}
.top-post div:first-child{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.top-post div img{
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 100px;
}
.top-post div h1{
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--second-txt-color);
    margin-left: 20px;
}
.menu-drop{
    position: absolute;
    display: flex;
    flex-direction: row;
    z-index: 5;
    right: 25px;
    top: 15px;
    transition: 400ms;
}
.menu-drop-animate{
    animation: animate ease-in-out 400ms;
}
@keyframes animate {
    from{
        right: 30px;
    }
    to{
        right: 20px;
    }
}
.menu-drop button{
    width: 100%;
    border: none;
    background: transparent;
    color: var(--main-txt-color);
    font-family: "Comfortaa", sans-serif;
    font-size: 12px;
    padding: 10px;
}
.menu-drop button:first-child:hover{
    cursor: pointer;
    color: var(--second-color);
}
.menu-drop button:last-child:hover{
    cursor: pointer;
    color: #e44747;
}

.my-post p{
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 151.69%;
    color: var(--main-txt-color);
    margin-bottom: 30px;
    position: relative;
    z-index: 2;
}
.one-picture{
    display: flex;
    flex-direction: column;
    align-items: center;
    object-fit: cover;
    max-width: 610px;
    transition: 400ms;
}
.no-one-picture {
    object-fit: cover;
    max-width: 300px;
    margin-left: 10px;
    margin-bottom: 10px;
}
/*.my-post > img{*/
/*    display: flex;*/
/*    flex-direction: column;*/
/*    align-items: center;*/
/*    object-fit: cover;*/
/*    max-width: 680px;*/
/*}*/
.img-post {
    display: flex;
    flex-wrap: wrap;
    max-width: 630px;
}
.my-post .img-post img:nth-child(2) {
    object-fit: cover;
    max-width: 300px;
    margin-left: 10px;
    margin-bottom: 10px;
}
.my-post .img-post img:nth-child(3) {
    object-fit: cover;
    max-width: 610px;
    margin-left: 10px;
    margin-bottom: 10px;
}
@media screen and (max-width: 420px){
    .my-post{
        width: 90vw;
        padding: 20px;
        margin-top: 30px;
    }
    .top-post div img{
        width: 50px;
    }
    .menu-drop{
        top: 35px;
    }
    .img-post {
        max-width: 95%;
    }
    .my-post .img-post img:nth-child(2) {
        max-width: 45%;
    }
    .my-post .img-post img:nth-child(3) {
        max-width: 95%;
    }
    .one-picture{
        max-width: 95%;
    }
    .no-one-picture {
        max-width: 45%;
    }
}
</style>
