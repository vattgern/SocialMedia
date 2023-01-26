import { createStore } from 'vuex';

export default createStore({
   state(){
       return {
            user: {},
            tabFriends: 'friend',
            posts: [],
            myPosts: [],
            newsPosts: [],
            friendsCount: 0,
            myPostsCount: 0,
            myCategories: [],
       }
   }
});
