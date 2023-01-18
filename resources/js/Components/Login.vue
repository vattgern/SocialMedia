<template>]
    <svg width="1227" height="1080" viewBox="0 0 1227 1080" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1164 416.58C1248.95 474.918 1246.91 601.007 1160.12 656.567L677.5 965.5L221.54 1244.89C129.341 1301.39 10.0902 1239.9 2.64535 1132.02L-75.6683 -2.7246C-77.83 -34.0476 -69.6951 -65.2187 -52.5024 -91.4907L17.5925 -198.602C62.1265 -266.654 154.142 -284.348 220.739 -237.667L677.5 82.5L1164 416.58Z" fill="#332f2f"/>
    </svg>
        
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
        }
    }
}
</script>

<style scoped>
    svg{
        position: absolute;
        height: 100vh;
        top: 0;
        left: -70px;
    }
</style>
