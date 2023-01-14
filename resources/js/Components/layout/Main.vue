<template>
    <Header></Header>
    <main>
        <router-view></router-view>
    </main>
</template>

<script>
import api from "../../api";
import Header from "./Header.vue";

export default {
    name: "Main",
    data(){
        return {

        }
    },
    components: {
        Header,
    }
}
</script>

<style scoped>
</style>
