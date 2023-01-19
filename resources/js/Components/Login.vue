<template>
    <form action="" class="login">
        <h1>Авторизация</h1>
        <label for="">Введите почту</label>
        <input type="email" required placeholder="Введите e-mail">
        <label for="">Введите пароль</label>
        <input type="password" name="" id="" placeholder="Введите пароль" required>
        <button type="submit">Войти</button>
    </form>
    <svg class="refresh" @click.prevent="setFocusForm" width="77" height="77" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M38.7534 7.21875C23.3743 7.21875 10.7315 18.9709 9.49877 33.9549H6.41706C5.44211 33.9549 4.56351 34.5432 4.19218 35.4446C3.82084 36.3461 4.03018 37.3826 4.72229 38.0693L10.1117 43.4165C11.0498 44.3473 12.5631 44.3473 13.5012 43.4165L18.8906 38.0693C19.5827 37.3826 19.7921 36.3461 19.4207 35.4446C19.0494 34.5432 18.1708 33.9549 17.1959 33.9549H14.3313C15.5496 21.6616 26.0032 12.0312 38.7534 12.0312C47.639 12.0312 55.4169 16.7104 59.7253 23.7185C60.4213 24.8506 61.9033 25.2042 63.0354 24.5082C64.1675 23.8122 64.521 22.3302 63.825 21.1981C58.6713 12.815 49.368 7.21875 38.7534 7.21875Z" fill="#E5E5E5"/>
        <path d="M66.8657 33.5803C65.9283 32.6538 64.42 32.6538 63.4826 33.5803L58.0726 38.9275C57.3786 39.6135 57.1676 40.6506 57.5384 41.5532C57.9092 42.4558 58.7884 43.0451 59.7642 43.0451H62.6488C61.4256 55.3315 50.9355 64.9688 38.1242 64.9688C29.197 64.9688 21.3866 60.2855 17.0621 53.278C16.3642 52.1471 14.8816 51.796 13.7507 52.494C12.6198 53.1919 12.2688 54.6744 12.9667 55.8054C18.1405 64.1891 27.4767 69.7812 38.1242 69.7812C53.5494 69.7812 66.2443 58.0363 67.4815 43.0451H70.5842C71.5599 43.0451 72.4391 42.4558 72.8099 41.5532C73.1807 40.6506 72.9697 39.6135 72.2757 38.9275L66.8657 33.5803Z" fill="#E5E5E5"/>
        </svg>   
    <form action="" class="registration">
        <h1>Регистрация</h1>
        <label for="">Введите имя </label>
        <input type="text" name="" id="">
        <label for="">Введите фамилию </label>
        <input type="text" name="" id="">
        <label for="">Введите почту</label>
        <input type="email" name="" id="">
        <label for="">Введите пароль</label>
        <input type="password" name="" id="">
        <label for="">Повторите пароль</label>
        <input type="password" name="" id="">
        <div class="check">
            <input type="checkbox" name="" id="">
            <label for="">Принимаю условия на обработку персональных данных</label>
        </div>
        <button type="submit">Зарегистрирваться</button>
    </form>     
    <svg :class="focusForm === 'login' ? 'back-svg' : 'back-svg back-svg-opacity'" width="1227" height="1080" viewBox="0 0 1227 1080" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1164 416.58C1248.95 474.918 1246.91 601.007 1160.12 656.567L677.5 965.5L221.54 1244.89C129.341 1301.39 10.0902 1239.9 2.64535 1132.02L-75.6683 -2.7246C-77.83 -34.0476 -69.6951 -65.2187 -52.5024 -91.4907L17.5925 -198.602C62.1265 -266.654 154.142 -284.348 220.739 -237.667L677.5 82.5L1164 416.58Z" fill="#332f2f"/>
    </svg>
    <div :class="focusForm === 'login' ? 'back-block' : 'back-block-opacity' "></div>

</template>


<script>
import axios from "axios";
import api from '../api';
export default {
    name: "Login",
    data(){
        return {
            email: '',
            password: '',
            focusForm: 'login',
        }
    },
    mounted(){
    },
    methods:{
        login(){
            axios.get('/sanctum/csrf-cookie').then(r => {
                if(localStorage.getItem('token')){
                    this.$router.push({
                        name: 'profile'
                    })
                }
                api.post('http://127.0.0.1:8000/api/signIn', {
                    'email' : this.email,
                    'password': this.password
                }).then(response => {
                    this.email = '';
                    this.password = '';

                    window.localStorage.setItem('token', response.data['access_token']);
                    api.get('/api/me').then(r => {
                        this.$store.state.userInfo = r.data;
                    })
                    this.$router.push({
                        name: 'profile',
                    })
                });
            });
        },
        setFocusForm() {
            if (this.focusForm === 'login') {
                this.focusForm = 'register';
            } else {
                this.focusForm = 'login';
            }
            this.setForm();
        },
        setForm() {
            if (this.focusForm === 'login') {
        
            }
        }
    }
}
</script>

<style scoped>
    .back-svg{
        width: 64vw;
        position: absolute;
        height: 100vh;
        top: 0;
        left: -70px;
        fill-opacity: 1;
        z-index: 2;

        transition: all 0.4s ease-in;
    }
    .back-svg-opacity{
        fill-opacity: 0.5;
        z-index: 4;
    }
    .login{
        position: relative;
        display: flex;
        flex-direction: column;
        z-index: 3;
        transform: translate(20%, 90%);
    }
    .login h1{
        font-style: normal;
        font-weight: 400;
        font-size: 40px;
        line-height: 45px;
        color: var(--second-txt-color);
        margin-bottom: 40px;
    }
    .login label{
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 18px;
        color: var(--second-txt-color);
        margin-bottom: 15px;
    }
    .login input{
        background-color: var(--main-bg-color);
        border-radius: 10px;
        width: 400px;
        height: 40px;
        border: none; 
        outline: none;
        padding-left: 15px;
        margin-bottom: 20px;
        color: var(--main-txt-color);
    }
    .login input::placeholder{
        font-size: 14px;
        font-family: "Roboto";
    }
    .login button{
        width: 166px;
        height: 33px;
        background: var(--second-color);
        border-radius: 6px;
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 16px;
        color: var(--main-bg-color);
        border: none;
    }
    .refresh{
        position: relative;
        z-index: 15;
        right: -770px;
        bottom: -110px;
        cursor: pointer;
    }
    .back-block{
        position: absolute;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.4);
        transition: all 0.4s ease-in;
    }
    .back-block-opacity{
        opacity: 0;
        z-index: 0;
    }
    .registration{
        position: relative;
        display: flex;
        flex-direction: column;
        z-index: 1;
        right: -55vw;
        top: -13vw;
    }
    .registration h1{
        font-style: normal;
        font-weight: 400;
        font-size: 40px;
        line-height: 45px;
        color: var(--second-txt-color);
        margin-bottom: 40px;
    }
    .registration label{
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 18px;
        color: var(--second-txt-color);
        margin-bottom: 15px;
    }
    .registration input:not(input[type=checkbox]){
        background-color: var(--second-bg-color);
        border-radius: 10px;
        width: 400px;
        height: 40px;
        border: none; 
        outline: none;
        padding-left: 15px;
        margin-bottom: 20px;
        color: var(--main-txt-color);
    }
    .check{
        display: flex;
        flex-direction: row;
        align-items: stretch;
    }
    input[type=checkbox]{
        width: 20px;
        height: 20px;
        background: #332F2F;
        border-radius: 5px;
        margin-right: 10px;
    }
    .check label{
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 12px;
        line-height: 13px;
        margin: 0;
        margin-top: 5px;
    }
    .registration input::placeholder{
        font-size: 14px;
        font-family: "Roboto";
    }
    .registration button{
        width: 216px;
        height: 33px;
        background: var(--second-color);
        border-radius: 6px;
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 16px;
        color: var(--main-bg-color);
        border: none;
        margin-top: 30px;
        margin-left: 180px;
    }
    @media screen and (min-width: 1200px) and (max-width: 1600px) {
        .registration{
            position: relative;
            display: flex;
            flex-direction: column;
            z-index: 1;
            right: -65vw;
            top: -18vw;
        }
        .login{
            position: relative;
            display: flex;
            flex-direction: column;
            z-index: 3;
            transform: translate(40%, 85%);
        }
        .refresh{
            right: -770px;
            bottom: -80px;
        }
    }

</style>
