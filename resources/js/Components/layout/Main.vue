<template>
    <Header></Header>
    <main>
        <router-view></router-view>
    </main>
    <RightAside></RightAside> 
</template>

<script>
import api from "../../api";
import RightAside from "./RightAside.vue";
import Header from "./Header.vue";

export default {
    name: "Main",
    data(){
        return {

        }
    },
    components: {
        Header,
        RightAside,
    }
}
</script>

<style scoped>
</style>
