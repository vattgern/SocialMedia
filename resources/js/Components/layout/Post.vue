<template>
    <div class="my-post">
        <div class="top-post">
            <div>
                <img src="img/profile-img.png" alt="No Ethernet">
                <h1>Тишков Юрий</h1>
            </div>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" @click="activeMenu">
                <path d="M12 17C13.1046 17 14 17.8954 14 19C14 20.1046 13.1046 21 12 21C10.8954 21 10 20.1046 10 19C10 17.8954 10.8954 17 12 17Z" fill="#E5E5E5"/>
                <path d="M12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10Z" fill="#E5E5E5"/>
                <path d="M12 3C13.1046 3 14 3.89543 14 5C14 6.10457 13.1046 7 12 7C10.8954 7 10 6.10457 10 5C10 3.89543 10.8954 3 12 3Z" fill="#E5E5E5"/>
            </svg>   
            <div class="menu-drop">
                <button>Редактировать</button>
                <button>Удалить</button>
            </div>             
        </div>
        <p>В Ульяновской области нашли самого одинокого мужчину. 64-летний Геннадий Никифоров с 2008 года живет в полном одиночестве в опустевшей деревне Языковка. Пенсионер не хочет покидать мертвое село — у него есть котейка, и ему норм.</p>
        <div class="img-post">
            <img src="img\image-post.png" alt="No Ethernet">
            <img src="img\image-post.png" alt="No Ethernet">
            <img src="img\image-post.png" alt="No Ethernet">
        </div>
    </div>
</template>

<script>

let f = true;
export default {
    mounted(){
        this.CountImg();
        },
        methods:{
            
            activeMenu(){
                if(f == true){
                    document.querySelector('.menu-drop').style.right = 20 + 'px';
                    setTimeout(() => {  document.querySelector('.menu-drop').classList.add('menu-drop-animate'); }, 250);
                    f = false;
                }else if(f == false){
                    document.querySelector('.menu-drop').classList.remove('menu-drop-animate');
                    document.querySelector('.menu-drop').style.right = -220 + 'px';
                    f = true;
                }
                
            },
            CountImg() {
                let count = document.querySelector('.img-post').childNodes.length;
                if (count == 1) {
                    document.querySelector('.img-post img:first-child').classList.remove('no-one-picture');
                    document.querySelector('.img-post img:first-child').classList.add('one-picture');
                } else {
                    document.querySelector('.img-post img:first-child').classList.remove('one-picture');
                    document.querySelector('.img-post img:first-child').classList.add('no-one-picture');
                }
            }
    },
    data() {
        return {
        }
    }
    }
</script>

<style lang="css" scoped>
.my-post{
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: var(--main-bg-color);
    width: 720px;
    border-radius: 14px;
    padding: 20px;
    margin-top: 30px;
    z-index: 1;
    overflow: hidden;
}
.top-post{
    position: relative;
    z-index: 5;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 20px;
}
.top-post div:first-child{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.top-post div img{
    width: 60px;
}
.top-post div h1{
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: var(--second-txt-color);
    margin-left: 20px;
}
.menu-drop{
    position: absolute;
    display: flex;
    flex-direction: row;
    z-index: 5;
    right: -220px;
    top: 15px;
    transition: 400ms;
}
.menu-drop-animate{
    animation: animate ease-in-out 400ms;
}
@keyframes animate {
    from{
        right: 30px;
    }
    to{
        right: 20px;
    }
}
.menu-drop button{
    width: 100%;
    border: none;
    background: transparent;
    color: var(--main-txt-color);
    font-family: "Comfortaa", sans-serif;
    font-size: 12px;
    padding: 10px;
}
.menu-drop button:first-child:hover{
    cursor: pointer;
    color: var(--second-color);
}
.menu-drop button:last-child:hover{
    cursor: pointer;
    color: #e44747;
}

.my-post p{
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 151.69%;
    color: var(--main-txt-color);
    margin-bottom: 30px;    
    position: relative;
    z-index: 2;
}
.one-picture{
    display: flex;
    flex-direction: column;
    align-items: center;
    object-fit: cover;
    max-width: 610px;
    transition: 400ms;
}
/*
.my-post .img-post img:hover{
    position: relative;
    z-index: 5;
    transform: scale(1.2);
}
.img-post{
    display: flex;
    flex-wrap: wrap;
    max-width: 630px;
}
*/

.no-one-picture {
    object-fit: cover;
    max-width: 300px;
    margin-left: 10px;
    margin-bottom: 10px;
}
.img-post {
    display: flex;
    flex-wrap: wrap;
    max-width: 630px;
}
.my-post .img-post img:nth-child(2) {
    object-fit: cover;
    max-width: 300px;
    margin-left: 10px;
    margin-bottom: 10px;
}
.my-post .img-post img:nth-child(3) {
    object-fit: cover;
    max-width: 610px;
    margin-left: 10px;
    margin-bottom: 10px;
}
</style>