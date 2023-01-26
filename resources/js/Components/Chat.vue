<template>
<!--    <MessengerTop></MessengerTop>-->
    <div class="chat">
        <div class="top-chat">
            <div class="back-to-messager">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M8.35861 5.39131C8.60269 5.63539 8.60269 6.03112 8.35861 6.27519L5.25888 9.37492L12.0833 9.37492C12.8778 9.37492 14.0556 9.60812 15.0527 10.326C16.0817 11.0669 16.875 12.2962 16.875 14.1666C16.875 14.5118 16.5952 14.7916 16.25 14.7916C15.9048 14.7916 15.625 14.5118 15.625 14.1666C15.625 12.7036 15.0294 11.8496 14.3223 11.3405C13.5833 10.8084 12.6778 10.6249 12.0833 10.6249L5.25888 10.6249L8.35861 13.7246C8.60269 13.9687 8.60269 14.3645 8.35861 14.6085C8.11453 14.8526 7.7188 14.8526 7.47472 14.6085L3.30806 10.4419C3.06398 10.1978 3.06398 9.80205 3.30806 9.55798L7.47472 5.39131C7.7188 5.14723 8.11453 5.14723 8.35861 5.39131Z"
                          fill="#E5E5E5" />
                </svg>
                <router-link :to="{ name: 'messenger' }">Вернуться назад</router-link>
            </div>
            <router-link :to="{ name: 'anotherUser', params: {id: friend.id} }">
                <h1>{{ this.friend.name }} - {{this.friend.status}}</h1>
            </router-link>
            <img :src="this.friend.avatar" alt="No Ethernet">
        </div>
        <div class="field">
            <div v-for="message in messages" :key="message">
                <div class="my-message" v-if="message.user_id === this.$store.state.user.id">
                    <p>{{ message.message }}</p>
                    <p>{{ getHumanDate(message.created_at) }}</p>
                </div>
                <div class="message" v-else>
                    <p>{{ message.message }}</p>
                    <p>{{ getHumanDate(message.created_at) }}</p>
                </div>
            </div>
        </div>
        <div class="input-message">
            <input type="text"
                   placeholder="Введите текст"
                   v-model="textMessage"
                   @keyup.enter="sendMessage(idRoom)"
                   required>
            <button type="submit" @click="sendMessage(idRoom)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4.49746 20.835L21.0072 13.4725C22.3309 12.8822 22.3309 11.1178 21.0072 10.5275L4.49746 3.16496C3.00163 2.49789 1.45006 3.97914 2.19099 5.36689L5.34302 11.2706C5.58817 11.7298 5.58818 12.2702 5.34302 12.7294L2.19099 18.6331C1.45007 20.0209 3.00163 21.5021 4.49746 20.835Z"
                        fill="#E5E5E5" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import api from "../api";
import moment from 'moment';
import MessengerTop from "./layout/MessengerTop.vue";

export default {
    name: "Chat",
    components: {MessengerTop},
    data() {
        return {
            idRoom: this.$route.params['id'],
            messages: [],
            textMessage: '',
            friend: {}
        }
    },
    mounted() {
        this.getRoom();
        this.getUser();
        this.fetchMessages(this.idRoom);
        this.listenStatus();
        // Слушать отправку сообщения
        window.Echo.channel('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    'user_id': e.user.id,
                });
                console.log(e);
            });
        console.log(this.friend);
    },
    methods: {
        getRoom(){
            api.get(`/api/rooms/${this.idRoom}`).then(r => {
                let users = r.data.data.participants[0];
                if(users.user.id === this.$store.state.user.id){
                    this.friend = users.userSecond;
                } else {
                    this.friend = users.user;
                }
            });
        },
        getUser(){
            api.get('/api/me').then(r => {
                this.$store.state.user = r.data;
            })
        },
        getHumanDate(date) {
            return moment(date).format('LT');
        },
        listenStatus(){
            window.Echo.join('chat')
                .joining((user) => {
                    api.put(`/api/user/${user}/online`,{});
                })
                .leaving((user) => {
                    api.put(`/api/user/${user}/offline`,{});
                })
                .listen('UserOnline', (e) => {
                    this.friend = e.user;
                })
                .listen('UserOffline', (e) => {
                    this.friend = e.user;
                })
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

<style lang="css" scoped>
.chat{
    width: 760px;
    background-color: var(--second-bg-color);
    margin-top: 10px;
    border-radius: 14px;
}
.top-chat{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #585858;
    padding: 15px 20px;
}
.back-to-messager{
    display: flex;
    flex-direction: row;
    align-items: center;
    height: 40px;
}
.back-to-messager a{
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    margin-top: 4px;
    margin-left: 10px;
    color: var(--second-txt-color);
    text-decoration: none;
}
.top-chat h1{
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--second-txt-color);
    margin-right: 50px;
}
.top-chat img{
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 100px;
}
.field{
    overflow-y:scroll;
    width: 100%;
    height: 680px;
    padding: 20px 23px;
}
.field::-webkit-scrollbar {
    width: 12px;
    /* width of the entire scrollbar */
}

.field::-webkit-scrollbar-track {
    background: transparent;
    /* color of the tracking area */
}

.field::-webkit-scrollbar-thumb {
    background-color: #494747;
    /* color of the scroll thumb */
    border-radius: 20px;
    /* roundness of the scroll thumb */
    border: none;
    /* creates padding around scroll thumb */
}
.message{
    position: relative;
    background-color: var(--main-bg-color);
    width: 45%;
    padding: 10px 20px;
    border-radius: 10px;
    margin-bottom: 10px;
}
.message p:first-child{
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}
.message p:last-child {
    position: absolute;
    right: 6px;
    bottom: 6px;
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 12px;
    color: #9C9C9C
}
.my-message {
    position: relative;
    background-color: var(--main-bg-color);
    width: 45%;
    padding: 10px 20px;
    border-radius: 10px;
    margin-bottom: 10px;
    margin-left: 55%;
}

.my-message p:first-child {
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}

.my-message p:last-child {
    position: absolute;
    right: 6px;
    bottom: 6px;
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 10px;
    line-height: 12px;
    color: #9C9C9C
}
.input-message{
    position: relative;
    width: 100%;
    background-color: var(--second-bg-color);
    padding: 20px;
    border-radius: 0 0 14px 14px;
}
.input-message input{
    border-radius: 9px;
    width: 720px;
    height: 43px;
    background: #272525;
    padding-left: 20px;
    border: none;
    outline: none;
    color: white;
    font-family: "Roboto", sans-serif;
}
.input-message input::placeholder{
    font-family: 'Comfortaa', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: #9C9C9C;
}
.input-message button{
    position: absolute;
    background: transparent;
    border: none;
    right: 40px;
    bottom: 25px;
    cursor: pointer;
}
</style>
