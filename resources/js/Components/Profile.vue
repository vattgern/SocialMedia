<template>
    <div>
        <h2>User Info</h2>
        <ul>
            <li> {{ this.$store.state.userInfo.name }} </li>
            <li> {{ this.$store.state.userInfo.email }} </li>
        </ul>
    </div>
</template>

<script>

import api from "../api";

export default {
    name: "Profile",

}
</script>

<style scoped>

</style>
