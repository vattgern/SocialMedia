<template>
    <div class="container">
        <div class="row">
            <section class="discussions">
                <div class="discussion search">
                    <div class="searchbar">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                </div>
                <div class="discussion message-active">
                    <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                        <div class="online"></div>
                    </div>
                    <div class="desc-contact">
                        <p class="name">Megan Leib</p>
                        <p class="message">9 pm at the bar if possible 😳</p>
                    </div>
                    <div class="timer">12 sec</div>
                </div>
                <div class="discussion" v-for="room in rooms" @click="setFocusRoom(room)">
                    <div class="photo" style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
                        <div class="online"></div>
                    </div>
                    <div class="desc-contact">
                        <p class="name">{{ room.name }}</p>
                        <p class="message">some text</p>
                    </div>
                    <div class="timer">Добавить время</div>
                </div>

            </section>
            <section class="chat" v-show="focusRoom !== undefined">
                <div class="header-chat">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i>
                    <p class="name">{{ focusRoom.name }}</p>
                    <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
                </div>
                <div class="messages-chat">
                    <div class="message text-only" v-for="message in focusRoom.messages">
                        <div class="response" v-if="message['user_id'] === this.$store.state.userInfo.id">
                            <p class="text"> {{ message['user_id'] }}</p>
                        </div>
                        <div v-else>
                            <p class="text"> {{ message['user_id'] }} </p>
                        </div>
                    </div>
                </div>
                <div class="footer-chat">
                    <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                    <input type="text" v-model="textMessage" class="write-message" placeholder="Type your message here">
                    <i class="icon send fa fa-paper-plane-o clickable" aria-hidden="true"></i>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import api from '../api';

export default {
    name: "Messenger",
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
        console.log(this.focusRoom.isEmpty);
    },
    methods: {
        getUser(){
            api.get('/api/me').then(r => {
                this.$store.state.userInfo = r.data;
            })
        },
        getRooms(){
            api('/api/rooms').then(response => {
                this.rooms = response.data.data;
            })
        },
        setFocusRoom(room){
            this.focusRoom = room;
            console.log(this.focusRoom);
            console.log(this.$store.state.userInfo);
        },
        sendMessage(){
            api.post('/')
        }
    }
}
</script>

<style scoped>
.container {
    padding:0;
    background-color: #FFF;
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    width: 100%;
    height: 95%;
}
.row{
    display: flex;
    flex-direction: row;
}
/* === CONVERSATIONS === */

.discussions {
    width: 35%;
    height: 700px;
    box-shadow: 0px 8px 10px rgba(0,0,0,0.20);
    overflow: hidden;
    background-color: #87a3ec;
    display: inline-block;
}

.discussions .discussion {
    width: 100%;
    height: 90px;
    background-color: #FAFAFA;
    border-bottom: solid 1px #E0E0E0;
    display:flex;
    align-items: center;
    cursor: pointer;
}

.discussions .search {
    display:flex;
    align-items: center;
    justify-content: center;
    color: #E0E0E0;
}

.discussions .search .searchbar {
    height: 40px;
    background-color: #FFF;
    width: 70%;
    padding: 0 20px;
    border-radius: 50px;
    border: 1px solid #EEEEEE;
    display:flex;
    align-items: center;
    cursor: pointer;
}

.discussions .search .searchbar input {
    margin-left: 15px;
    height:38px;
    width:100%;
    border:none;
    font-family: 'Montserrat', sans-serif;;
}

.discussions .search .searchbar *::-webkit-input-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *:-moz-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *::-moz-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *:-ms-input-placeholder {
    color: #E0E0E0;
}

.discussions .message-active {
    width: 98.5%;
    height: 90px;
    background-color: #FFF;
    border-bottom: solid 1px #E0E0E0;
}

.discussions .discussion .photo {
    margin-left:20px;
    display: block;
    width: 45px;
    height: 45px;
    background: #E6E7ED;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.online {
    position: relative;
    top: 30px;
    left: 35px;
    width: 13px;
    height: 13px;
    background-color: #8BC34A;
    border-radius: 13px;
    border: 3px solid #FAFAFA;
}

.desc-contact {
    height: 43px;
    width:50%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.discussions .discussion .name {
    margin: 0 0 0 20px;
    font-family:'Montserrat', sans-serif;
    font-size: 11pt;
    color:#515151;
}

.discussions .discussion .message {
    margin: 6px 0 0 20px;
    font-family:'Montserrat', sans-serif;
    font-size: 9pt;
    color:#515151;
}

.timer {
    margin-left: 15%;
    font-family:'Open Sans', sans-serif;
    font-size: 11px;
    padding: 3px 8px;
    color: #BBB;
    background-color: #FFF;
    border: 1px solid #E5E5E5;
    border-radius: 15px;
}

.chat {
    width: calc(65% - 85px);
}

.header-chat {
    background-color: #FFF;
    height: 90px;
    box-shadow: 0px 3px 2px rgba(0,0,0,0.100);
    display:flex;
    align-items: center;
}

.chat .header-chat .icon {
    margin-left: 30px;
    color:#515151;
    font-size: 14pt;
}

.chat .header-chat .name {
    margin: 0 0 0 20px;
    text-transform: uppercase;
    font-family:'Montserrat', sans-serif;
    font-size: 13pt;
    color:#515151;
}

.chat .header-chat .right {
    position: absolute;
    right: 40px;
}

.chat .messages-chat {
    padding: 25px 35px;
}

.chat .messages-chat .message {
    display:flex;
    align-items: center;
    margin-bottom: 8px;
}

.chat .messages-chat .message .photo {
    display: block;
    width: 45px;
    height: 45px;
    background: #E6E7ED;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.chat .messages-chat .text {
    margin: 0 35px;
    background-color: #f6f6f6;
    padding: 15px;
    border-radius: 12px;
}

.text-only {
    margin-left: 45px;
}

.time {
    font-size: 10px;
    color:lightgrey;
    margin-bottom:10px;
    margin-left: 85px;
}

.response-time {
    float: right;
    margin-right: 40px !important;
}

.response {
    float: right;
    margin-right: 0px !important;
    margin-left:auto; /* flexbox alignment rule */
}

.response .text {
    background-color: #e3effd !important;
}

.footer-chat {
    width: calc(65% - 66px);
    height: 80px;
    display:flex;
    align-items: center;
    position:absolute;
    bottom: 0;
    background-color: transparent;
    border-top: 2px solid #EEE;

}

.chat .footer-chat .icon {
    margin-left: 30px;
    color:#C0C0C0;
    font-size: 14pt;
}

.chat .footer-chat .send {
    color:#fff;
    background-color: #4f6ebd;
    position: absolute;
    right: 50px;
    padding: 12px 12px 12px 12px;
    border-radius: 50px;
    font-size: 14pt;
}

.chat .footer-chat .name {
    margin: 0 0 0 20px;
    text-transform: uppercase;
    font-family:'Montserrat', sans-serif;
    font-size: 13pt;
    color:#515151;
}

.chat .footer-chat .right {
    position: absolute;
    right: 40px;
}

.write-message {
    border:none !important;
    width:60%;
    height: 50px;
    margin-left: 20px;
    padding: 10px;
}

.footer-chat *::-webkit-input-placeholder {
    color: #C0C0C0;
    font-size: 13pt;
}
.footer-chat input *:-moz-placeholder {
    color: #C0C0C0;
    font-size: 13pt;
}
.footer-chat input *::-moz-placeholder {
    color: #C0C0C0;
    font-size: 13pt;
    margin-left:5px;
}
.footer-chat input *:-ms-input-placeholder {
    color: #C0C0C0;
    font-size: 13pt;
}

.clickable {
    cursor: pointer;
}
</style>
