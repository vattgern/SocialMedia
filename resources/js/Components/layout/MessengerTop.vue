<template>
    <div class="navigation-friends">
        <ul>
<!--            <li class="active-li list">-->
<!--                <span class="icon">-->
<!--                    <img src="/img/profile-img.png" alt="No Ethernet">-->
<!--                </span>-->
<!--                <span class="text">Юрий Тишков</span>-->
<!--            </li>-->
            <li v-for="room in rooms" :key="room" :id="room.id" @click="activeLink(room)" :class="room.activeTab ? 'active-li list' : 'list'">
                <router-link :to="{ name: 'chat', params: { id:room.id } }">
                    <span class="icon">
                        <img src="/img/profile-img.png" alt="No Ethernet">
                    </span>
                    <span class="text" v-if="room.participants[0].user.id === this.$store.state.user.id">{{ room.participants[0].userSecond.name }}</span>
                    <span class="text" v-else>{{ room.participants[0].user.name }}</span>
                </router-link>
            </li>
            <div class="indicator"></div>
        </ul>
    </div>
</template>

<script>
import api from "../../api";

export default {
    name: "MessengerTop",
    data(){
        return {
            rooms: [],
            list: [],
        }
    },
    mounted(){
        this.getUser();
        this.getRooms();
        console.log(this.rooms);
        // list.forEach((item)=> item.classList.remove('active-li'));
        // elem.classList.add('active-li');
    },
    methods:{
        getUser(){
            api.get('/api/me').then(r => {
                this.$store.state.user = r.data;
            })
        },
        getRooms(){
            api('/api/rooms').then(response => {
                let rooms = response.data.data;
                rooms.forEach((room, index) => {
                    for(let i=0;i<room.participants.length; i++){
                        if(room.participants[i].user.id === this.$store.state.user.id || room.participants[i].userSecond.id === this.$store.state.user.id){
                            room.activeTab = false;
                            this.rooms.push(room);
                        }
                    }
                });
            })
        },
        activeLink(room){
            this.rooms.forEach(room => {
                room.activeTab = false;
            })
            room.activeTab = true;
        }
    }
}
</script>

<style scoped>
.navigation-friends{
    width: 760px;
    height: 60px;
    background-color: var(--second-bg-color);
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    border-radius: 11px;
    margin-top: 30px;
}
.navigation-friends ul{
    position: relative;
    display: flex;
    width: 95%;
    height: 100%;
}
.navigation-friends ul li{
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 15%;
    height: 100%;
    z-index: 2;
}
.navigation-friends ul a{
    text-decoration: none;
}
.navigation-friends ul li .icon img{
    position: relative;
    display: block;
    width: 40px;
}
.active-li .icon img{
    transform: translateY(-32px);
    transition: 500ms;
}
.navigation-friends ul li .text{
    position: absolute;
    font-family: "Comfortaa", sans-serif;
    font-size: 13px;
    color: var(--second-txt-color);
    transition: 500ms;
    transform: translateY(15px);
    opacity: 0;
}
.navigation-friends ul li.active-li .text{
    transform: translateY(7px);
    opacity: 1;
}
.indicator{
    position: absolute;
    top: -35px;
    width: 70px;
    height: 70px;
    background-color: var(--second-bg-color);
    border-radius: 50%;
    left: 16px;
    z-index: 1;
    transition: 500ms;
}
.indicator::before{
    content: '';
    position: absolute;
    width: 30px;
    height: 30px;
    background: transparent;
    border-radius: 50%;
    top: 5px;
    left: -28px;
    box-shadow: 15px 18px var(--second-bg-color);
}
.indicator::after{
    content: '';
    position: absolute;
    width: 30px;
    height: 30px;
    background: transparent;
    border-radius: 50%;
    top: 5px;
    right: -28px;
    box-shadow: -15px 18px var(--second-bg-color);
}
.list:hover{
    cursor: pointer;
}
.navigation-friends ul li:nth-child(1).active-li ~ .indicator{
    transform: translateX(calc(102px * 0));
}
.navigation-friends ul li:nth-child(2).active-li ~ .indicator{
    transform: translateX(calc(102px * 1));
}
.navigation-friends ul li:nth-child(3).active-li ~ .indicator{
    transform: translateX(calc(103px * 2));
}
.navigation-friends ul li:nth-child(4).active-li ~ .indicator{
    transform: translateX(calc(103px * 3));
}
.navigation-friends ul li:nth-child(5).active-li ~ .indicator{
    transform: translateX(calc(103px * 4));
}
.navigation-friends ul li:nth-child(6).active-li ~ .indicator{
    transform: translateX(calc(103px * 5));
}
.navigation-friends ul li:nth-child(7).active-li ~ .indicator{
    transform: translateX(calc(103px * 6));
}
</style>
