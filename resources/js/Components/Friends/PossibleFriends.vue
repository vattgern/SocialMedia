<template>
    <div class="field-our-friends">
        <div class="one-people" v-for="(user, index) in users" :key="index">
            <img src="/img/second-profile-img.png" alt="No Ethernet">
            <div>
                <h1>{{ user.name }}</h1>
                <p>Астрахань</p>
            </div>
            <div class="border-svg" @click="sendRequestFriend(user.id, index)">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9.16667" cy="5.50001" r="3.66667" fill="#E5E5E5" />
                    <path
                        d="M16.4999 16.0417C16.4999 18.3198 16.4999 20.1667 9.16659 20.1667C1.83325 20.1667 1.83325 18.3198 1.83325 16.0417C1.83325 13.7635 5.1165 11.9167 9.16659 11.9167C13.2167 11.9167 16.4999 13.7635 16.4999 16.0417Z"
                        fill="#E5E5E5" />
                    <path
                        d="M19.2499 9.16669H17.4166M17.4166 9.16669H15.5833M17.4166 9.16669L17.4166 7.33334M17.4166 9.16669L17.4166 11"
                        stroke="#E5E5E5" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../../api";

export default {
    props: {
        users: Array
    },
    methods: {
        sendRequestFriend(id, index){
            api.post('/api/friends/add',{
                friend_id: id,
            }).then(r => {
                console.log(r.data);
                this.users.splice(index,1);
            });
        }
    }
}
</script>

<style>
.field-our-friends {
    width: 760px;
    padding: 20px;
    margin-top: 20px;
    background-color: var(--second-bg-color);
    border-radius: 14px;
}

.one-people {
    position: relative;
    width: 100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 30px;
}

.one-people img {
    width: 50px;
}

.one-people div {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-left: 18px;
}

.one-people div h1 {
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 17px;
    color: var(--second-txt-color);
}

.one-people div p {
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    line-height: 13px;
    color: #CBCBCB;
}

.border-svg {
    position: absolute;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 36px;
    border: 1px solid var(--main-txt-color);
    border-radius: 4px;
    padding: 7px 7px 6px 7px;
    right: 20px;
    top: 7px;
    cursor: pointer;
}

.border-svg div:first-child {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.border-svg img {
    width: 40px;
}

.border-svg p {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--second-txt-color);
    margin-left: 15px;
}
</style>
