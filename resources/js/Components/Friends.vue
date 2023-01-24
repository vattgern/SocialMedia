<template>

 <SearchPeople v-show="this.$store.state.tabFriends === 'possible' || this.$store.state.tabFriends === 'request'"></SearchPeople>
 <SearchOurFriends v-show="this.$store.state.tabFriends === 'friend'"></SearchOurFriends>
 <OurFriends v-show="this.$store.state.tabFriends === 'friend'"></OurFriends>
 <PossibleFriends v-show="this.$store.state.tabFriends === 'possible'"></PossibleFriends>
 <MyFriends v-show="this.$store.state.tabFriends === 'request'"></MyFriends>
</template>

<script>
import SearchOurFriends from './Friends/SearchOurFriends.vue';
import OurFriends from './Friends/OurFriends.vue';
import PossibleFriends from './Friends/PossibleFriends.vue';
import MyFriends from './Friends/MyFriends.vue';
import SearchPeople from './Friends/SearchPeople.vue';

export default {
    data() {
        return {
            tab: 'friend'
        }
    },
    components: {
        SearchOurFriends,
        OurFriends,
        PossibleFriends,
        MyFriends,
        SearchPeople,
    }
}
</script>

<style>

</style>
