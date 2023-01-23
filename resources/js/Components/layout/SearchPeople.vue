<template>
    <div class="search">
        <input type="text" placeholder="Поиск людей" required>
        <button type="submit">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="11.5" cy="11.5" r="9.5" stroke="#E5E5E5" stroke-width="1.5" />
                <path d="M18.5 18.5L22 22" stroke="#E5E5E5" stroke-width="1.5" stroke-linecap="round" />
            </svg>
        </button>
    </div>
</template>

<script>

export default {
    
}
</script>

<style>
.search{
    position: relative;
    width: 760px;
    height: 40px;
}
.search input{
    width: 100%;
    height: 100%;
    padding-left: 20px;
    border-radius: 13px;
    border: none;
    outline: none;
    background-color: var(--second-bg-color);
    color: var(--main-txt-color);
    font-size: 16px;
    font-family: 'Roboto';
}
.search input::placeholder{
    color: #9C9C9C;
    font-family: 'Comfortaa';
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
}
.search button{
    position: absolute;
    right: 0;
    height: 100%;
    width: 40px;
    background: var(--second-bg-color);
    border: none;
    cursor: pointer;
    z-index: 2;
    border-radius: 12px;
}
</style>