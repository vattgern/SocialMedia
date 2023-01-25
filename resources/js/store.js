import { createStore } from 'vuex';

export default createStore({
   state(){
       return {
            user: {},
            tabFriends: 'friend',
            posts: [],
            myPosts: [],
            friendsCount: 0,
            myPostsCount: 0,
       }
   }
});
