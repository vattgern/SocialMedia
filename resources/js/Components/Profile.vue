<template>
    <section class="main-content-profile">
        <div class="profile">
            <div class="cover-profile"></div>
            <div class="bottom-div-profile">
                <img src="/img/profile-img.png" alt="No Ethernet">
                <div>
                    <h1>{{ this.$store.state.user.name }}</h1>
                    <p>Астрахань</p>
                </div>
            </div>
        </div>
        <div class="main-content-profile-bottom">
            <CreatePost></CreatePost>
            <Post></Post>
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
        const selectSingle = document.querySelector('.__select');
        const selectSingle_title = selectSingle.querySelector('.__select__title');
        const selectSingle_labels = selectSingle.querySelectorAll('.__select__label');

        // Toggle menu
        selectSingle_title.addEventListener('click', () => {
            if ('active' === selectSingle.getAttribute('data-state')) {
                selectSingle.setAttribute('data-state', '');
            } else {
                selectSingle.setAttribute('data-state', 'active');
            }
        });

        // Close when click to option
        for (let i = 0; i < selectSingle_labels.length; i++) {
            selectSingle_labels[i].addEventListener('click', (evt) => {
                selectSingle_title.textContent = evt.target.textContent;
                selectSingle.setAttribute('data-state', '');
            });
        }
    },
    methods: {
        openCreatePost(){
            document.querySelector('.new-post').classList.add('active-post');
        },
        closeCreatePost(){
            console.log('asdgasdhj')
            document.querySelector('.new-post').classList.remove('active-post');
        }
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
    background: url("/img/cover-profile.png");
    width: 100%;
    height: 172px;
    background-size: cover;
    background-repeat: no-repeat;
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
    position: relative;
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
