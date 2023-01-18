<template>
    <Header v-show="this.$route.path != '/'"></Header>
    <main>
        <router-view></router-view>
    </main>
    <RightAside  v-show="this.$route.path != '/'"></RightAside> 
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
    mounted(){
        console.log(this.$route.path);
    },
    components: {
        Header,
        RightAside,
    }
}
</script>

<style scoped>
</style>
