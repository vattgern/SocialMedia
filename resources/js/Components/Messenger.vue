<template>
    <MessengerTop></MessengerTop>
    <div class="main-messager">
        <div class="top-content-main-messager">
            <h1>Сообщения</h1>
        </div>
        <div class="bottom-content-main-messager">
            <div> <!-- Это один мессенджер-->
                <img src="/img/profile-img.png" alt="No Ethernet">
                <div>
                    <div class="name-time">
                        <h2>Юрий Тишков</h2>
                        <p>14:02</p>
                    </div>
                    <p>В Ульяновской области нашли самого одинокого мужчину. 64-летний Геннадий Никифоров с 2008</p>
                </div>
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
            focusRoom: {},
            messages: [],
            textMessage: ''
        }
    },
    mounted() {
        this.getUser();
        this.getRooms();

        console.log(this.rooms);
    },
    methods: {
        getUser(){
            api.get('/api/me').then(r => {
                this.$store.state.userInfo = r.data;
            })
        },
        getRooms(){
            api('/api/rooms').then(response => {
                let rooms = response.data.data;
                for (let i = 0; i < rooms.length;i++){
                    for (let index = 0; index < rooms[i].participants.length; index++){
                        if(this.$store.state.userInfo.id === rooms[i].participants[index]['user_id']){
                            this.rooms.push(rooms[i]);
                        }
                    }
                }
                //this.rooms = response.data.data;
            })
        },
        setFocusRoom(room){
            this.focusRoom = room;

            // this.fetchMessages(room.id);
            // window.Echo.channel('chat')
            //     .listen('MessageSent', (e) => {
            //         this.messages.push({
            //             message: e.message.message,
            //             'user_id': e.user.id,
            //         });
            //         console.log(e);
            //     });
        },
        fetchMessages(id){
          api.get(`/api/room/${id}/messages`).then(response => {
              this.messages = [];
              this.messages = response.data.data.messages;
              console.log(this.messages);
          });
        },
        sendMessage(id){
            api.post('/api/message/create', {
                message: this.textMessage,
                'room_id': id,
            })
                .then(response => {
                    console.log(response.data);
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
.bottom-content-main-messager > div{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.bottom-content-main-messager > div:not(:last-child){
    margin-bottom: 40px;
}
.bottom-content-main-messager > div img{
    width: 50px;
    height: 50px;
    object-fit: cover;
}
.bottom-content-main-messager > div > div{
    display: flex;
    flex-direction: column;
    margin-left: 20px;
    gap: 10px;
}
.name-time{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.name-time h2{
    font-weight: 400;
    font-size: 15px;
    line-height: 17px;
    color: var(--second-txt-color);
}
.name-time  p{
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 13px;
    color: #9C9C9C;
}
.bottom-content-main-messager > div > div > p{
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 13px;
    line-height: 151.69%;
    color: var(--second-txt-color);
}
</style>

