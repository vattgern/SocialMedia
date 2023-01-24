import { createStore } from 'vuex';

export default createStore({
   state(){
       return {
            user: {},
           tabFriends: 'friend',
           posts: [],
       }
   }
});
