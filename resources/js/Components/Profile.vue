<template>
    <section class="main-content-profile">
        <div class="profile">
            <div class="cover-profile"
                 :style="`background: url('${this.$store.state.user.background}'); background-size:cover; background-repeat: no-repeat; background-position: 50% 25%;`"></div>
            <div class="bottom-div-profile">
                <img :src="this.$store.state.user.avatar" alt="No Ethernet">
                <div>
                    <h1>{{ this.$store.state.user.name }}</h1>
                    <p>Астрахань</p>
                    <router-link :to="{ name: 'profileEdit' }">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="settings">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2788 2.15224C13.9085 2 13.439 2 12.5 2C11.561 2 11.0915 2 10.7212 2.15224C10.2274 2.35523 9.83509 2.74458 9.63056 3.23463C9.53719 3.45834 9.50065 3.7185 9.48635 4.09799C9.46534 4.65568 9.17716 5.17189 8.69017 5.45093C8.20318 5.72996 7.60864 5.71954 7.11149 5.45876C6.77318 5.2813 6.52789 5.18262 6.28599 5.15102C5.75609 5.08178 5.22018 5.22429 4.79616 5.5472C4.47814 5.78938 4.24339 6.1929 3.7739 6.99993C3.30441 7.80697 3.06967 8.21048 3.01735 8.60491C2.94758 9.1308 3.09118 9.66266 3.41655 10.0835C3.56506 10.2756 3.77377 10.437 4.0977 10.639C4.57391 10.936 4.88032 11.4419 4.88029 12C4.88026 12.5581 4.57386 13.0639 4.0977 13.3608C3.77372 13.5629 3.56497 13.7244 3.41645 13.9165C3.09108 14.3373 2.94749 14.8691 3.01725 15.395C3.06957 15.7894 3.30432 16.193 3.7738 17C4.24329 17.807 4.47804 18.2106 4.79606 18.4527C5.22008 18.7756 5.75599 18.9181 6.28589 18.8489C6.52778 18.8173 6.77305 18.7186 7.11133 18.5412C7.60852 18.2804 8.2031 18.27 8.69012 18.549C9.17714 18.8281 9.46533 19.3443 9.48635 19.9021C9.50065 20.2815 9.53719 20.5417 9.63056 20.7654C9.83509 21.2554 10.2274 21.6448 10.7212 21.8478C11.0915 22 11.561 22 12.5 22C13.439 22 13.9085 22 14.2788 21.8478C14.7726 21.6448 15.1649 21.2554 15.3694 20.7654C15.4628 20.5417 15.4994 20.2815 15.5137 19.902C15.5347 19.3443 15.8228 18.8281 16.3098 18.549C16.7968 18.2699 17.3914 18.2804 17.8886 18.5412C18.2269 18.7186 18.4721 18.8172 18.714 18.8488C19.2439 18.9181 19.7798 18.7756 20.2038 18.4527C20.5219 18.2105 20.7566 17.807 21.2261 16.9999C21.6956 16.1929 21.9303 15.7894 21.9827 15.395C22.0524 14.8691 21.9088 14.3372 21.5835 13.9164C21.4349 13.7243 21.2262 13.5628 20.9022 13.3608C20.4261 13.0639 20.1197 12.558 20.1197 11.9999C20.1197 11.4418 20.4261 10.9361 20.9022 10.6392C21.2263 10.4371 21.435 10.2757 21.5836 10.0835C21.9089 9.66273 22.0525 9.13087 21.9828 8.60497C21.9304 8.21055 21.6957 7.80703 21.2262 7C20.7567 6.19297 20.522 5.78945 20.2039 5.54727C19.7799 5.22436 19.244 5.08185 18.7141 5.15109C18.4722 5.18269 18.2269 5.28136 17.8887 5.4588C17.3915 5.71959 16.7969 5.73002 16.3099 5.45096C15.8229 5.17191 15.5347 4.65566 15.5136 4.09794C15.4993 3.71848 15.4628 3.45833 15.3694 3.23463C15.1649 2.74458 14.7726 2.35523 14.2788 2.15224ZM12.5 15C14.1695 15 15.5228 13.6569 15.5228 12C15.5228 10.3431 14.1695 9 12.5 9C10.8305 9 9.47716 10.3431 9.47716 12C9.47716 13.6569 10.8305 15 12.5 15Z" fill="#E5E5E5"/>
                        </svg>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="main-content-profile-bottom">
            <CreatePost></CreatePost>
            <Post v-if="this.$store.state.myPosts" v-for="(post, index) in this.$store.state.myPosts"
                  :post="post"
                  :index="index"/>
        </div>
    </section>
</template>

<script>
import api from "../api";
import Post from "./layout/Post.vue";
import CreatePost from "./layout/CreatePost.vue";

export default {
    name: "Profile",
    components:{
        Post,
        CreatePost,
    },
    mounted(){
        this.getUser();
        this.getPosts();
        this.getCountFriends();
        this.getCountPosts();
        // const selectSingle = document.querySelector('.__select');
        // const selectSingle_title = selectSingle.querySelector('.__select__title');
        // const selectSingle_labels = selectSingle.querySelectorAll('.__select__label');
        //
        // // Toggle menu
        // selectSingle_title.addEventListener('click', () => {
        //     if ('active' === selectSingle.getAttribute('data-state')) {
        //         selectSingle.setAttribute('data-state', '');
        //     } else {
        //         selectSingle.setAttribute('data-state', 'active');
        //     }
        // });
        //
        // // Close when click to option
        // for (let i = 0; i < selectSingle_labels.length; i++) {
        //     selectSingle_labels[i].addEventListener('click', (evt) => {
        //         selectSingle_title.textContent = evt.target.textContent;
        //         selectSingle.setAttribute('data-state', '');
        //     });
        // }
    },
    methods: {
        getUser(){
            api.get('/api/me').then(r => {
                this.$store.state.user = r.data;
            })
        },
        openCreatePost(){
            document.querySelector('.new-post').classList.add('active-post');
        },
        closeCreatePost(){
            document.querySelector('.new-post').classList.remove('active-post');
        },
        getPosts(){
            api.get('/api/posts/my').then(response => {
                this.$store.state.myPosts = response.data.data;
            });
        },
        getCountFriends(){
            api.get('/api/friends/count').then(r => {
                this.$store.state.friendCount = r.data.count;
            })
        },
        getCountPosts(){
            api.get('/api/posts/my').then(r => {
                this.$store.state.myPostsCount = r.data.count;
            });
        }
    }

}
</script>

<style scoped>
html{
    overflow-y: hidden;
}
/* main section open */

.settings{
    display: none;
}
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
@media screen and (max-width: 420px){
    .main-content-profile{
        width: 100%;
    }
    .bottom-div-profile {
        padding-left: 30px;
    }

    .bottom-div-profile img {
        width: 125px;
        height: 125px;
        margin-top: -73px;
    }

    .bottom-div-profile div {
        margin-top: 10px;
    }

    .bottom-div-profile div h1 {
        font-size: 20px;
        margin-bottom: 5px;
    }

    .bottom-div-profile div p {
        font-size: 14px;
    }
}
@media screen and (max-width: 420px){
    .bottom-div-profile div p {
        font-size: 14px;
    }
    .settings{
        display: block;
        margin-top: 10px;
    }
}
/* main section close */
</style>
