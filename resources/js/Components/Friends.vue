<template>
<!-- <SearchPeople></SearchPeople> -->
<SearchOurFriends></SearchOurFriends>
<!-- <OurFriends></OurFriends> -->
<!-- <PosibleFriends></PosibleFriends> -->
<MyFriends></MyFriends>
</template>

<script>
import SearchOurFriends from './layout/SearchOurFriends.vue';
import OurFriends from './layout/OurFriends.vue';
import PosibleFriends from './layout/PosibleFriends.vue';
import MyFriends from './layout/MyFriends.vue';
import SearchPeople from './layout/SearchPeople.vue';

export default {
    data() {
        return {

        }
    },
    components: {
        SearchOurFriends,
        OurFriends,
        PosibleFriends,
        MyFriends,
        SearchPeople,
    }
}
</script>

<style>

</style>