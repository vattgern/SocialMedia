<template>
    <aside>
        <div class="mini-profile">
            <div class="cover-mini-profile"
                 :style="`background: url('${this.$store.state.user.background}'); background-size:cover; background-repeat: no-repeat; background-position: 50% 25%;`"></div>
            <img :src=" this.$store.state.user.avatar" alt="No Ethernet" />
            <h1>{{ this.$store.state.user.name }}</h1>
            <h2 v-show="this.$store.state.user.city !== null">{{ this.$store.state.user.city }}</h2>
            <div class="friends-posts">
                <div>
                    <h3>Друзья</h3>
                    <p>{{ this.$store.state.friendsCount }}</p>
                </div>
                <div>
                    <h3>Посты</h3>
                    <p>{{ this.$store.state.myPostsCount }}</p>
                </div>
            </div>
            <router-link :to="{ name: 'profileEdit' }">Редактировать профиль</router-link>
            <a @click.prevent="logout" style="margin-bottom: 1.5vw;" >Выйти</a>
        </div>
        <nav>
            <ul>
                <router-link :to="{ name: 'profile' }">
                    <li class="first-li">
                        <img src="/img/Home.png" alt="No Ethernet" />
                        <p>Моя страница</p>
                    </li>
                </router-link>
                <router-link :to="{ name: 'main' }">
                    <li>
                        <img src="/img/News.png" alt="No Ethernet" />
                        <p>Новости</p>
                    </li>
                </router-link>
                <router-link :to="{ name: 'messenger' }">
                    <li>
                        <img src="/img/Messaging.png" alt="No Ethernet" />
                        <p>Сообщения</p>
                    </li>
                </router-link>
                <router-link :to="{ name:'friends' }">
                    <li>
                        <img src="/img/People.png" alt="No Ethernet" />
                        <p>Друзья</p>
                    </li>
                </router-link>
            </ul>
        </nav>
<!--        <div class="possible-friends">-->
<!--            <h1>Возможно вы знакомы</h1>-->
<!--            <div>-->
<!--                <div>-->
<!--                    <img src="/img/second-profile-img.png" alt="No Ethernet" />-->
<!--                    <p>Кормеев Руслан</p>-->
<!--                </div>-->
<!--                <a href="">-->
<!--                    <div class="border-svg-possible">-->
<!--                        <svg-->
<!--                            width="22"-->
<!--                            height="22"-->
<!--                            viewBox="0 0 22 22"-->
<!--                            fill="none"-->
<!--                            xmlns="http://www.w3.org/2000/svg"-->
<!--                        >-->
<!--                            <circle cx="9.16667" cy="5.50001" r="3.66667" fill="#E5E5E5" />-->
<!--                            <path-->
<!--                                d="M16.4999 16.0417C16.4999 18.3198 16.4999 20.1667 9.16659 20.1667C1.83325 20.1667 1.83325 18.3198 1.83325 16.0417C1.83325 13.7635 5.1165 11.9167 9.16659 11.9167C13.2167 11.9167 16.4999 13.7635 16.4999 16.0417Z"-->
<!--                                fill="#E5E5E5"-->
<!--                            />-->
<!--                            <path-->
<!--                                d="M19.2499 9.16669H17.4166M17.4166 9.16669H15.5833M17.4166 9.16669L17.4166 7.33334M17.4166 9.16669L17.4166 11"-->
<!--                                stroke="#E5E5E5"-->
<!--                                stroke-width="1.5"-->
<!--                                stroke-linecap="round"-->
<!--                            />-->
<!--                        </svg>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
    </aside>
    <div class="nav-mobile" v-show="this.$route.name !== 'chat'">
        <ul>
            <li class="active-li list">
                <router-link :to="{ name: 'profile' }">
          <span class="icon">
            <img src="/img/Home.png" alt="No Ethernet" />
          </span>
                    <span class="text">Моя страница</span>
                </router-link>
            </li>
            <li class="list">
                <router-link :to="{ name: 'main' }">
          <span class="icon">
            <img src="/img/News.png" alt="No Ethernet" />
          </span>
                    <span class="text">Новости</span>
                </router-link>
            </li>
            <li class="list">
                <router-link :to="{ name: 'messenger' }">
          <span class="icon">
            <img src="/img/Messaging.png" alt="No Ethernet" />
          </span>
                    <span class="text">Сообщения</span>
                </router-link>
            </li>
            <li class="list">
                <router-link :to="{ name: 'friends' }">
          <span class="icon">
            <img src="/img/People.png" alt="No Ethernet" />
          </span>
                    <span class="text">Друзья</span>
                </router-link>
            </li>
            <div class="indicator"></div>
        </ul>
    </div>
</template>

<script>
import api from "../../api";

export default {
    name: "Header",
    mounted() {
        this.getUser();
        this.getCountFriends();
        this.getCountPosts();

        const list = document.querySelectorAll('.list');
        function activeLink(){
            list.forEach((item)=>
                item.classList.remove('active-li'));
            this.classList.add('active-li');
        }
        list.forEach((item)=>
            item.addEventListener('click', activeLink));
    },
    methods: {
        logout(){
            api.get('/api/logout').then(r => {
                window.localStorage.removeItem('token');
                this.$router.push({
                    name: 'login'
                })
            })
        },
        getUser(){
            api.get('/api/me').then(r => {
                this.$store.state.user = r.data;
            })
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
/* Aside-left section open */

aside{
    width: 360px;
}
.mini-profile {
    position: fixed;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 360px;
    height: 442px;
    background-color: var(--second-bg-color);
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    border-radius: 6px;
}
.cover-mini-profile {
    width: 100%;
    height: 109px;
    background-image: url("/img/cover-profile.png");
    background-size: cover;
    border-radius: 8px 8px 0 0;
}
.nav-mobile{
    display: none;
}
.mini-profile img {
    position: relative;
    width: 135px;
    height: 150px;
    top: 15px;
    margin-top: -79px;
    z-index: 2;
    border-radius: 100px;
    object-fit: cover;
}
.mini-profile h1 {
    font-style: normal;
    font-weight: 400;
    font-size: 22px;
    line-height: 25px;
    color: var(--second-txt-color);
    margin-top: 30px;
}
.mini-profile h2 {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--another-txt-color);
    margin-top: 18px;
}
.friends-posts {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 35px;
}
.friends-posts div {
    width: 50%;
}
.friends-posts div:first-child {
    border-right: 1px solid var(--main-txt-color);
}
.friends-posts div h3 {
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 22px;
    color: var(--second-txt-color);
    text-align: center;
}
.friends-posts div p {
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 20px;
    color: var(--another-txt-color);
    text-align: center;
    margin-top: 20px;
}
.mini-profile a {
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 17px;
    color: var(--main-txt-color);
    margin-top: 36px;
    position: relative;
    z-index: 8;
    cursor: pointer;
}

nav {
    position: fixed;
    width: 360px;
    background: var(--second-bg-color);
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    border-radius: 7px;
    margin-top: 40px;
    top: 460px;
    /* top: 47.5%;

    top: 78.5%;*/
}
nav ul {
    display: flex;
    flex-direction: column;
}
nav ul a li {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 20px;
}
nav ul a li p {
    margin-top: 3px;
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 17px;
    margin-left: 14px;
}
nav ul a li:not(.first-li) {
    border-top: 1px solid #585858;
    color: var(--main-txt-color);
}
.first-li {
    color: var(--second-txt-color);
}

.possible-friends {
    position: fixed;
    width: 360px;
    margin-top: 40px;
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.25);
    border-radius: 7px;
    background-color: var(--second-bg-color);
    padding: 20px;
    top: 760px;
}
.possible-friends h1 {
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 22px;
    color: var(--second-txt-color);
    padding-bottom: 20px;
    border-bottom: 1px solid #585858;
    margin-bottom: 15px;
}
.possible-friends > div {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}
.possible-friends > div div:first-child {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.possible-friends > div img {
    width: 40px;
}
.possible-friends > div p {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--second-txt-color);
    margin-left: 15px;
}
.border-svg-possible {
    border: 1px solid var(--main-txt-color);
    border-radius: 4px;
    padding: 7px 7px 6px 7px;
}
@media screen and (max-width: 420px) {
    aside {
        display: none;
    }
    .nav-mobile{
        position: fixed;
        display: block;
        width: 100vw;
        top: 94vh;
        left: 0;
        z-index: 100;
        background-color: var(--main-bg-color);
    }
    .nav-mobile ul {
        position: relative;
        display: flex;
        width: 95%;
        height: 60px;
    }

    .nav-mobile ul li {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 25%;
        height: 100%;
        z-index: 1000;
    }

    .nav-mobile ul li .icon img {
        position: relative;
        display: block;
        width: 30px;
    }

    .active-li .icon img {
        transform: translateY(-32px);
        transition: 500ms;
        left: 10px;
    }
    .nav-mobile ul li.active-li:first-child .text {
        transform: translateY(-15px);
    }
    .nav-mobile ul li .text {
        position: absolute;
        font-family: "Comfortaa";
        font-size: 13px;
        color: var(--second-txt-color);
        transition: 500ms;
        transform: translateY(-15px);
        opacity: 0;
    }

    .nav-mobile ul li.active-li .text {
        width: 120px;
        transform: translateY(-15px);
        opacity: 1;
        left: 0;
    }

    .indicator {
        position: absolute;
        top: -35px;
        width: 70px;
        height: 70px;
        background-color: var(--main-bg-color);
        border-radius: 50%;
        left: 22px;
        z-index: 100;
        transition: 500ms;
    }

    .indicator::before {
        content: '';
        position: absolute;
        width: 30px;
        height: 30px;
        background: transparent;
        border-radius: 50%;
        top: 5px;
        left: -28px;
        box-shadow: 15px 18px var(--main-bg-color);
    }

    .indicator::after {
        content: '';
        position: absolute;
        width: 30px;
        height: 30px;
        background: transparent;
        border-radius: 50%;
        top: 5px;
        right: -28px;
        box-shadow: -15px 18px var(--main-bg-color);
    }

    .list:hover {
        cursor: pointer;
    }

    .nav-mobile ul li:nth-child(1).active-li~.indicator {
        transform: translateX(calc(102px * 0));
    }

    .nav-mobile ul li:nth-child(2).active-li~.indicator {
        transform: translateX(calc(100px * 1));
    }

    .nav-mobile ul li:nth-child(3).active-li~.indicator {
        transform: translateX(calc(99px * 2));
    }

    .nav-mobile ul li:nth-child(4).active-li~.indicator {
        transform: translateX(calc(99px * 3));
    }

}

/* Aside-left section close */
</style>
