<template>
    <section class="main-content-profile">
        <div class="profile">
            <div class="cover-profile"
                 :style="`background: url('${user.background}'); background-size:cover; background-repeat: no-repeat; background-position: 50% 25%;`"></div>
            <div class="bottom-div-profile">
                <img :src="user.avatar" alt="No Ethernet">
                <div>
                    <h1>{{ user.name }}</h1>
                    <p>Астрахань</p>
                </div>
            </div>
        </div>
        <div class="main-content-profile-bottom">
            <Post v-for="(post, index) in posts" :post="post" :index="index"/>
        </div>
    </section>
</template>

<script>
import Post from './layout/Post.vue';
import api from "@/api";
export default {
    name: "User",
    data(){
      return{
          idUser: this.$route.params['id'],
          user: {},
          posts: [],
      }
    },
    mounted() {
        this.getUser();
        this.getPosts();
    },
    components: {
        Post,
    },
    methods:{
        getUser(){
            api.get(`/api/users/${this.idUser}`).then(r => {
                console.log(r.data);
                this.user = r.data.data;
            });
        },
        getPosts(){
            api.get(`/api/posts/all/${this.idUser}`).then(res => {
                console.log(res.data.data);
                this.posts = res.data.data;
            })
        },
        openCreatePost(){
            document.querySelector('.new-post').classList.add('active-post');
        },
        closeCreatePost(){
            console.log('asdgasdhj')
            document.querySelector('.new-post').classList.remove('active-post');
        },
    }
}
</script>

<style scoped>
html{
    overflow-y: hidden;
}
/* main section open */

.main-content-profile{
    width: 760px;
}
.profile{
    width: 100%;
    background-color: var(--second-bg-color);
    border-radius: 8px;
}
.cover-profile{
    width: 100%;
    height: 172px;
    background-repeat: no-repeat;
    background-position: bottom;
    border-radius: 8px 8px 0 0;
}
.bottom-div-profile{
    display: flex;
    flex-direction: row;
    gap: 10px;
    width: 100%;
    background-color: var(--second-bg-color);
    padding-left: 62px;
    padding-bottom: 20px;
    border-radius: 6px;
}
.bottom-div-profile img{
    width: 175px;
    margin-top: -103px;
    border-radius: 100px;
    object-fit: cover;
    object-position: center;
}
.bottom-div-profile div{
    margin-top: 18px;
}
.bottom-div-profile div h1{
    font-style: normal;
    font-weight: 400;
    font-size: 24px;
    color: var(--second-txt-color);
    margin-bottom: 10px;
}
.bottom-div-profile div p{
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--another-txt-color);
}
.main-content-profile-bottom{
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: var(--second-bg-color);
    width: 100%;
    padding: 20px;
    margin-top: 40px;
    border-radius: 14px;
    overflow: unset;
    z-index: 0;
}

/* main section close */
</style>
