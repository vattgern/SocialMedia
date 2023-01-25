<template>

 <SearchPeople v-show="this.$store.state.tabFriends === 'possible' || this.$store.state.tabFriends === 'request'"></SearchPeople>
 <SearchOurFriends v-show="this.$store.state.tabFriends === 'friend'"></SearchOurFriends>
 <OurFriends v-show="this.$store.state.tabFriends === 'friend'" :friends="friends"></OurFriends>
 <PossibleFriends v-show="this.$store.state.tabFriends === 'possible'" :users="possibleFriends" />
 <MyFriends v-show="this.$store.state.tabFriends === 'request'" :requests="friendRequest"></MyFriends>
</template>

<script>
import SearchOurFriends from './Friends/SearchOurFriends.vue';
import OurFriends from './Friends/OurFriends.vue';
import PossibleFriends from './Friends/PossibleFriends.vue';
import MyFriends from './Friends/MyFriends.vue';
import SearchPeople from './Friends/SearchPeople.vue';
import api from "../api";

export default {
    data() {
        return {
            tab: 'friend',
            possibleFriends: [],
            friendRequest: [],
            friends: [],
        }
    },
    components: {
        SearchOurFriends,
        OurFriends,
        PossibleFriends,
        MyFriends,
        SearchPeople,
    },
    mounted() {
        this.getMe();
        this.getFriends();
        this.getUsers();
        this.getFriendRequest();
    },
    methods: {
        getMe(){
            api.get('/api/me').then(r => {
                this.$store.state.user = r.data;
            })
        },
        getFriends(){
            api.get('/api/friends').then(response => {
                console.log(response.data);
                this.friends = response.data.data;
                this.$store.state.friendsCount = this.friends.length;
            })
        },
        getUsers(){
            api.get('/api/users').then(response => {
                let arr = response.data.data;
                arr.forEach((user, index) => {
                    if(user.id === this.$store.state.user.id){
                        arr.splice(index, 1);
                    }
                })
                this.possibleFriends = arr;
                //console.log(this.possibleFriends);
            });
        },
        getFriendRequest(){
            api.get('/api/friends/requests').then(response => {
                this.friendRequest = response.data.data;
            });
        }
    }

}
</script>

<style>

</style>
