<template>
    <div class="category-mobile">
        <div class="mobile-it">IT</div>
        <div class="mobile-sport">Спорт</div>
        <div class="mobile-games">Игры</div>
        <div class="mobile-add-new">+</div>
    </div>
</template>

<script>
export default {
    data() {
        

        return {}
    }
}
</script>

<style lang="css" scoped>
.category-mobile{
    display: none;
}
@media screen and (max-width: 420px) {
    .category-mobile{
        width: 95%;
        display: flex;
        flex-direction: row;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 30px;
    }
    .mobile-it{
        background: #6750c6;
        padding: 5px 15px;
        border-radius: 15px;
        font-family: "Comfortaa";
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        color: var(--second-txt-color);
    }
    .mobile-sport{
        background: #4372cd;
        padding: 5px 15px;
        border-radius: 15px;
        font-family: "Comfortaa";
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        color: var(--second-txt-color);
    }
    .mobile-games{
        background: #9815a4;
        padding: 5px 15px;
        border-radius: 15px;
        font-family: "Comfortaa";
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        color: var(--second-txt-color);
    }
    .mobile-add-new{
        background: var(--main-bg-color);
        padding: 5px 15px;
        border-radius: 15px;
        font-family: "Comfortaa";
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        color: var(--second-txt-color);
    }
}

</style>