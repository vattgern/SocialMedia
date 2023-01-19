<template>
    <Header v-show="this.$route.path !== '/'"></Header>
    <main>
        <router-view></router-view>
    </main>
    <RightAside v-show="this.$route.path !== '/'"></RightAside>
</template>

<script>
import api from "../../api";
import Header from "./Header.vue";
import RightAside from "./RightAside.vue";

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
