<template>
    <MessengerTop></MessengerTop>
    <div class="chat">
        <div class="top-chat">
            <div class="back-to-messager">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.35861 5.39131C8.60269 5.63539 8.60269 6.03112 8.35861 6.27519L5.25888 9.37492L12.0833 9.37492C12.8778 9.37492 14.0556 9.60812 15.0527 10.326C16.0817 11.0669 16.875 12.2962 16.875 14.1666C16.875 14.5118 16.5952 14.7916 16.25 14.7916C15.9048 14.7916 15.625 14.5118 15.625 14.1666C15.625 12.7036 15.0294 11.8496 14.3223 11.3405C13.5833 10.8084 12.6778 10.6249 12.0833 10.6249L5.25888 10.6249L8.35861 13.7246C8.60269 13.9687 8.60269 14.3645 8.35861 14.6085C8.11453 14.8526 7.7188 14.8526 7.47472 14.6085L3.30806 10.4419C3.06398 10.1978 3.06398 9.80205 3.30806 9.55798L7.47472 5.39131C7.7188 5.14723 8.11453 5.14723 8.35861 5.39131Z"
                        fill="#E5E5E5" />
                </svg>
                <p>Вернуться назад</p>
            </div>
            <h1>Юрий Тишков</h1>
            <img src="/img/profile-img.png" alt="No Ethernet">
        </div>
        <div class="field">
            <div class="message">
                <p>Привет! Чем занимаешься сегодня? Как дела?</p>
                <p>14:02</p>
            </div>
        </div>
    </div>
</template>

<script>
import MessengerTop from './layout/MessengerTop.vue';

export default {
    name: "Messenger",
    data() {
        return {

        }
    },
    components: {
        MessengerTop,
    }
}
</script>

<style lang="css" scoped>
.chat{
    width: 760px;
    background-color: var(--second-bg-color);
    margin-top: 10px;
    border-radius: 14px;
}
.top-chat{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #585858;
    padding: 15px 20px;
}
.back-to-messager{
    display: flex;
    flex-direction: row;
    align-items: center;
    height: 40px;
}
.back-to-messager p{
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    margin-top: 4px;
    margin-left: 10px;
    color: var(--second-txt-color);
}
.top-chat h1{
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--second-txt-color);
    margin-right: 50px;
}
.top-chat img{
    width: 40px;
}
.field{
    width: 100%;
    padding: 20px 23px;
}
.message{
    background-color: var(--main-bg-color);
    width: 40%;
    padding: 7px 20px;
}
.message p:first-child{
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}
.message p:last-child {
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}
</style>