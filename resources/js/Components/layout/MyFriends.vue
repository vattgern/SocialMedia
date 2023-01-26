<template>
    <div class="field-our-friends">
        <div class="one-people" v-for="index in 5" :key="index">
            <img src="/img/second-profile-img.png" alt="No Ethernet">
            <div>
                <h1>Руслан Кормеев</h1>
                <p>Астрахань</p>
            </div>
            <div class="border-svg-add">
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
            <div class="border-svg">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.833 5.50016C12.833 7.52521 11.1914 9.16683 9.16634 9.16683C7.1413 9.16683 5.49967 7.52521 5.49967 5.50016C5.49967 3.47512 7.1413 1.8335 9.16634 1.8335C11.1914 1.8335 12.833 3.47512 12.833 5.50016Z"
                        fill="#E5E5E5" />
                    <path
                        d="M16.4997 16.0418C16.4997 18.32 16.4997 20.1668 9.16634 20.1668C1.83301 20.1668 1.83301 18.32 1.83301 16.0418C1.83301 13.7637 5.11625 11.9168 9.16634 11.9168C13.2164 11.9168 16.4997 13.7637 16.4997 16.0418Z"
                        fill="#E5E5E5" />
                    <path
                        d="M19.199 8.35674C19.4675 8.08826 19.4675 7.65296 19.199 7.38447C18.9305 7.11598 18.4952 7.11598 18.2267 7.38447L17.4165 8.19471L16.6063 7.38448C16.3378 7.11599 15.9025 7.11599 15.634 7.38448C15.3655 7.65297 15.3655 8.08827 15.634 8.35675L16.4442 9.16698L15.634 9.97719C15.3655 10.2457 15.3655 10.681 15.634 10.9495C15.9025 11.218 16.3378 11.218 16.6063 10.9495L17.4165 10.1392L18.2267 10.9495C18.4952 11.218 18.9305 11.218 19.199 10.9495C19.4675 10.681 19.4675 10.2457 19.199 9.97721L18.3888 9.16698L19.199 8.35674Z"
                        fill="#E5E5E5" />
                </svg>

            </div>
        </div>

    </div>
</template>

<script>

export default {
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
    right: 0;
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
.border-svg-add {
    position: absolute;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 36px;
    border: 1px solid var(--main-txt-color);
    border-radius: 4px;
    padding: 7px 7px 6px 7px;
    right: 50px;
    top: 7px;
    cursor: pointer;
}

.border-svg-add div:first-child {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.border-svg-add img {
    width: 40px;
}

.border-svg-add p {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--second-txt-color);
    margin-left: 15px;
}
@media screen and (max-width: 420px){
    .field-our-friends{
        width: 100vw;
        padding: 20px;
        margin-top: 20px;
        background-color: var(--second-bg-color);
        border-radius: 14px;
    }
}
</style>