<template>
    <Header v-if="this.$route.path !== '/' && this.$route.path !== '/category'"></Header>
    <main>
        <router-view></router-view>
    </main>
    <RightAside v-if="this.$route.path !== '/' && this.$route.path !== '/category'"></RightAside>
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
.dz-success-mark,
.dz-error-mark{
    display: none;
}
</style>
