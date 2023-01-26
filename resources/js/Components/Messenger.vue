<template>
<!--    <MessengerTop></MessengerTop>-->
    <div class="main-messager">
        <div class="top-content-main-messager">
            <h1>Сообщения</h1>
        </div>
        <div class="bottom-content-main-messager">
            <!-- Это один мессенджер-->
            <div v-for="room in rooms">
                <router-link :to="{ name: 'chat', params: { id: room.id } }">
                    <img :src="room.participants[0].user.id === this.$store.state.user.id ? room.participants[0].userSecond.avatar : room.participants[0].user.avatar" alt="No Ethernet">
                    <div>
                        <div class="name-time">
                            <h2 v-if="room.participants[0].user.id === this.$store.state.user.id">{{ room.participants[0].userSecond.name  }}</h2>
                            <h2 v-else>{{ room.participants[0].user.name }}</h2>
                            <p class="time">14:02</p>
                        </div>
                        <p>{{ room.messages[room.messages.length - 1].message }}</p>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../api';
import MessengerTop from './layout/MessengerTop.vue';

export default {
    name: "Messenger",
    components: {MessengerTop},
    data(){
        return {
            rooms: [],
            messages: [],
            textMessage: ''
        }
    },
    mounted() {
        this.getUser();
        this.getRooms();

    },
    methods: {
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
                            this.rooms.push(room);
                            console.log(room);
                        }
                    }
                });
            })
        },
        fetchMessages(id){
          api.get(`/api/room/${id}/messages`).then(response => {
              this.messages = [];
              this.messages = response.data.data.messages;
          });
        },
        sendMessage(id){
            api.post('/api/message/create', {
                message: this.textMessage,
                'room_id': id,
            })
                .then(response => {
                });
            this.textMessage = '';
        }
    }
}
</script>

<style scoped>

.main-messager{
    width: 760px;
    margin-top: 10px;
    border-radius: 14px;
    background-color: var(--second-bg-color);
    padding: 23px 0;
}
.top-content-main-messager{
    border-bottom: 1px solid #585858;
    padding-left: 48px;
    padding-bottom: 23px;
}
.top-content-main-messager h1{
    font-style: normal;
    font-weight: 200;
    font-size: 18px;
    line-height: 20px;
    color: var(--second-txt-color);
}
.bottom-content-main-messager {
    padding-top: 20px;
    padding-left: 47px;
    padding-right: 35px;
}
.bottom-content-main-messager a{
    display: flex;
    flex-direction: row;
    align-items: center;
    text-decoration: none;
}
.bottom-content-main-messager  a:not(:last-child){
    margin-bottom: 40px;
}
.bottom-content-main-messager a img{
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 100px;
}
.bottom-content-main-messager a > div{
    display: flex;
    flex-direction: column;
    margin-left: 20px;
    gap: 10px;
}
.name-time{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    position: relative;
}
.name-time h2{
    font-weight: 400;
    font-size: 15px;
    line-height: 17px;
    color: var(--second-txt-color);
}
.name-time  p{
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #9C9C9C;
}
.bottom-content-main-messager a > div > p{
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 13px;
    line-height: 151.69%;
    color: var(--second-txt-color);
}
</style>

