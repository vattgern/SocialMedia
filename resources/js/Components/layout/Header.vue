<template>
    <header>
        <ul>
            <li>
                <router-link :to="{ name: 'login' }">Войти</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'main' }">Главная</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'profile' }"> Профиль </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'messenger' }">Мессенджер</router-link>
            </li>
        </ul>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped>
    header{
        width: 100vw;
        height: 50px;
        background: #dcdcdc;
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    header ul{
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 3vw;
    }
    header ul a{
        text-decoration: none;
        color: black;
        font-family: sans-serif;
    }
</style>
