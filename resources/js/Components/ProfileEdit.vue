<template>
    <div class="download-img-back" @click="OpenDownloadImg">
        <div class="download-img" ref="background"> обложка</div>
    </div>
    <div class="download-img-back-2" @click="OpenDownloadImgAvatar">
        <div class="download-img-2" ref="avatar"> аватарка</div>
    </div>
    <div class="profile-edit">
        <div class="cover-profile-edit" :style="`background: url(${this.$store.state.user.background}); background-repeat: no-repeat; background-size: cover;`"  @mouseenter="hoverFunction"></div>
        <div class="cover-profile-edit-hover" @mouseleave="leaveFunction" @click="OpenDownloadImg">
            <p>Измениить обложку</p>
        </div>
        <div>
            <div class="flex-main">
                <img class="avatar-photo" :src="this.$store.state.user.avatar" alt="No Ethernet" @click="OpenDownloadImgAvatar">
                <div class="name-profile-edit">
                    <h1>{{ this.$store.state.user.name }}</h1>
                    <p>{{ this.$store.state.user.city }}</p>
                </div>
            </div>
            <div class="field-edit">
                <h2>Редактирование</h2>
                <div class="surname">
                    <label for="">Имя:</label>
                    <input v-model="lastName" type="text" required placeholder="Введите имя">
                </div>
                <div class="name">
                    <label for="">Фамилия:</label>
                    <input v-model="firstName" type="text" required placeholder="Введите фамилию">
                </div>
                <div class="mail">
                    <label for="">Почта:</label>
                    <input v-model="email" type="email" required placeholder="Введите e-mail">
                </div>
                <div class="city">
                    <label for="">Город:</label>
                    <input v-model="city" type="text" required placeholder="Введите город">
                </div>
                <div class="btn-in-edit-profile">
                    <button class="save-change" @click="send">Сохранить изменения</button>
                    <button class="cancel-change">Отменить изменения</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Dropzone from 'dropzone';
import api from "../api";

let j = true;
let i = true;
export default {
    name: "ProfileEdit",
    data(){
        return {
            lastName: '',
            firstName: '',
            email: '',
            city: '',
            avatar: null,
            background: null,
        }
    },
    mounted() {
        this.getUser();
        this.avatar = new Dropzone(this.$refs.avatar,{
            url: '/',
            autoProcessQueue: false,
        })
        this.background = new Dropzone(this.$refs.background,{
            url: '/',
            autoProcessQueue: false,
        });
    },
    methods: {
        getUser(){
            api.get('/api/me').then(r => {
                this.$store.state.user = r.data;
                console.log(this.$store.state.user);
                let name = this.$store.state.user.name;
                name = name.split(' ');
                this.firstName = name[0];
                this.lastName = name[1];
                this.email = this.$store.state.user.email;
                this.city = this.$store.state.user.city;
            })
        },
        hoverFunction() {
            document.querySelector('.cover-profile-edit-hover').style.display = "flex";
        },
        leaveFunction() {
            document.querySelector('.cover-profile-edit-hover').style.display = "none";
        },
        OpenDownloadImg() {
            if (j == true) {
                document.querySelector('.download-img-back').style.display = "flex";
                document.querySelector('html').style.overflowY = "hidden";
                j = false;
            } else {
                document.querySelector('.download-img-back').style.display = "none";
                document.querySelector('html').style.overflowY = "scroll";
                j = true;
            }
        },
        OpenDownloadImgAvatar() {
            if (i == true) {
                document.querySelector('.download-img-back-2').style.display = "flex";
                document.querySelector('html').style.overflowY = "hidden";
                i = false;
            } else {
                document.querySelector('.download-img-back-2').style.display = "none";
                document.querySelector('html').style.overflowY = "scroll";
                i = true;
            }
        },
        send(){
            let fd = new FormData();
            fd.append('name', this.firstName + ' ' + this.lastName);
            fd.append('email', this.email);
            fd.append('city', this.city);
            let files = this.background.getAcceptedFiles()
            files.forEach(file => {
                fd.append('background', file);
            })
            let avatar = this.avatar.getAcceptedFiles()
            avatar.forEach(file => {
                fd.append('avatar', file);
            })
            api.post('/api/user/update',fd).then(r=>{
               console.log(r.data);
               this.getUser();
            });
            // this.city = '';
            // this.firstName = '';
            // this.lastName = '';
            // this.email = '';
        }
    }
}
</script>

<style scoped>
.download-img-back {
    position: absolute;
    display: none;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);
    top: 0;
    left: 0;
    z-index: 9999;
}
.download-img {
    position: absolute;
    width: 760px;
    height: 600px;
    background-color: var(--second-bg-color);
    z-index: 1000;
    border-radius: 14px;
}
.download-img-back-2 {
    position: absolute;
    display: none;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);
    top: 0;
    left: 0;
    z-index: 9999;
}
.download-img-2 {
    position: absolute;
    width: 760px;
    height: 600px;
    background-color: var(--second-bg-color);
    z-index: 1000;
    border-radius: 14px;
}
.profile-edit{
    position: relative;
    width: 760px;
}
.cover-profile-edit{
    width: 100%;
    height: 170px;
    background-image: url('/img/cover-profile.png');
    background-size: cover;
    cursor: pointer;
}
.cover-profile-edit-hover{
    position: absolute;
    display: none;
    justify-content: center;
    align-items: center;
    width: 761px;
    height: 170px;
    border-radius: 8px 8px 0 0;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.6);
    cursor: pointer;
}
.cover-profile-edit-hover p{
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 22px;
    color: var(--main-txt-color);
}
.profile-edit > div:nth-child(3){
    width: 100%;
    background-color: var(--second-bg-color);
    border-radius: 6px;
}
.flex-main{
    display: flex;
    flex-direction: row;
    height: 80px;
}
.avatar-photo{
    position: relative;
    top: -100px;
    left: 62px;
    width: 175px;
    height: 175px;
    cursor: pointer;
    border-radius: 100px;
}
.name-profile-edit{
    display: flex;
    flex-direction: column;
    gap: 10px;
    height: 80px;
    margin-left: 70px;
    margin-top: 15px;
}
.name-profile-edit h1{
    font-style: normal;
    font-weight: 400;
    font-size: 24px;
    line-height: 27px;
    color: var(--second-txt-color);
}
.name-profile-edit p{
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: #cbcbcb;
}
.field-edit{
    margin-top: 20px;
    margin-left: 62px;
    padding-bottom: 20px;
}
.field-edit h2{
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 20px;
    color: var(--second-txt-color);
    margin-bottom: 25px;
}
.field-edit div:not(.btn-in-edit-profile){
    display: flex;
    flex-direction: column;
    width: 90%;
    margin-bottom: 20px;
}
.field-edit div label{
    margin-bottom: 10px;
    font-family: 'Comfortaa', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}
.field-edit div input{
    border-radius: 6px;
    background-color: var(--main-bg-color);
    border: none;
    outline: none;
    height: 40px;
    padding-left: 10px;
    color: var(--main-txt-color);
}
.field-edit div input::placeholder{
    font-family: 'Comfortaa', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 12px;
    color: #878787;
}
.btn-in-edit-profile{
    display: flex;
    flex-direction: row;
    width: 90%;
    justify-content: end;
}
.save-change{
    background: #5EC7DE;
    border-radius: 6px;
    padding: 0 20px;
    height: 33px;
    border: none;
    cursor: pointer;
    font-family: 'Comfortaa', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--main-bg-color);
    margin-right: 20px;
}
.cancel-change {
    background: #dc2d2d;
    border-radius: 6px;
    padding: 0 20px;
    height: 33px;
    border: none;
    cursor: pointer;
    font-family: 'Comfortaa', sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}
</style>
