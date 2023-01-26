<template>
    <div class="download-img-back" @click="OpenDownloadImg">
        <div class="download-img"> обложка</div>
    </div>
    <div class="download-img-back-2" @click="OpenDownloadImgAvatar">
        <div class="download-img-2"> аватарка</div>
    </div>
    <div class="profile-edit">
        <div class="cover-profile-edit" @mouseenter="hoverFunction"></div>
        <div class="cover-profile-edit-hover" @mouseleave="leaveFunction" @click="OpenDownloadImg">
            <p>Измениить обложку</p>
        </div>
        <div>
            <div class="flex-main">
                <img class="avatar-photo" src="/img/profile-img.png" alt="No Ethernet" @click="OpenDownloadImgAvatar">
                <div class="name-profile-edit">
                    <h1>Тишков Юрий</h1>
                    <p>Астрахань</p>
                </div>
            </div>
            <div class="field-edit">
                <h2>Редактирование</h2>
                <div class="surname">
                    <label for="">Фамилия:</label>
                    <input type="text" required placeholder="Введите фамилию">
                </div>
                <div class="name">
                    <label for="">Имя:</label>
                    <input type="text" required placeholder="Введите имя">
                </div>
                <div class="mail">
                    <label for="">Почта:</label>
                    <input type="email" required placeholder="Введите e-mail">
                </div>
                <div class="city">
                    <label for="">Город:</label>
                    <input type="text" required placeholder="Введите город">
                </div>
                <div class="btn-in-edit-profile">
                    <button class="save-change">Сохранить изменения</button>
                    <button class="cancel-change">Отменить изменения</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let j = true;
export default {
    methods: {
        hoverFunction() {
            document.querySelector('.cover-profile-edit-hover').style.display = "flex";
        },
        leaveFunction() {

            document.querySelector('.cover-profile-edit-hover').style.display = "none";
        },
        OpenDownloadImg() {
            if (j == true) {
                document.querySelector('.download-img-back').style.display = "flex";
                document.querySelector('html').style.overflowY = "hidden";
                j = false;
            } else {
                document.querySelector('.download-img-back').style.display = "none";
                document.querySelector('html').style.overflowY = "scroll";
                j = true;
            }
        },
        OpenDownloadImgAvatar() {
            if (j == true) {
                document.querySelector('.download-img-back-2').style.display = "flex";
                document.querySelector('html').style.overflowY = "hidden";
                j = false;
            } else {
                document.querySelector('.download-img-back-2').style.display = "none";
                document.querySelector('html').style.overflowY = "scroll";
                j = true;
            }
        }
    },
    data () {
        

        return {}
    }
}
</script>

<style lang="css" scoped>
.download-img-back {
    position: absolute;
    display: none;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);
    top: 0;
    left: 0;
    z-index: 9999;
}

.download-img {
    position: absolute;
    width: 760px;
    height: 600px;
    background-color: var(--second-bg-color);
    z-index: 10000;
    border-radius: 14px;
}
.download-img-back-2 {
    position: absolute;
    display: none;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);
    top: 0;
    left: 0;
    z-index: 9999;
}

.download-img-2 {
    position: absolute;
    width: 760px;
    height: 600px;
    background-color: var(--second-bg-color);
    z-index: 1000;
    border-radius: 14px;
}
.profile-edit{
    position: relative;
    width: 760px;
}
.cover-profile-edit{
    width: 100%;
    height: 170px;
    background-image: url('/img/cover-profile.png');
    background-size: cover;
    cursor: pointer;
}
.cover-profile-edit-hover{
    position: absolute;
    display: none;
    justify-content: center;
    align-items: center;
    width: 761px;
    height: 170px;
    border-radius: 8px 8px 0 0;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.6);
    cursor: pointer;
}
.cover-profile-edit-hover p{
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 22px;
    color: var(--main-txt-color);
}
.profile-edit > div:nth-child(3){
    width: 100%;
    background-color: var(--second-bg-color);
    border-radius: 6px;
}
.flex-main{
    display: flex;
    flex-direction: row;
    height: 80px;
}
.avatar-photo{
    position: relative;
    top: -100px;
    left: 62px;
    width: 175px;
    height: 175px;
    cursor: pointer;
}
.name-profile-edit{
    display: flex;
    flex-direction: column;
    gap: 10px;
    height: 80px;
    margin-left: 70px;
    margin-top: 15px;
}
.name-profile-edit h1{
    font-style: normal;
    font-weight: 400;
    font-size: 24px;
    line-height: 27px;
    color: var(--second-txt-color);
}
.name-profile-edit p{
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 18px;
    color: #cbcbcb;
}
.field-edit{
    margin-top: 20px;
    margin-left: 62px;
    padding-bottom: 20px;
}
.field-edit h2{
    font-style: normal;
    font-weight: 400;
    font-size: 18px;
    line-height: 20px;
    color: var(--second-txt-color);
    margin-bottom: 25px;
}
.field-edit div:not(.btn-in-edit-profile){
    display: flex;
    flex-direction: column;
    width: 90%;
    margin-bottom: 20px;
}
.field-edit div label{
    margin-bottom: 10px;
    font-family: 'Comfortaa';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}
.field-edit div input{
    border-radius: 6px;
    background-color: var(--main-bg-color);
    border: none;
    outline: none;
    height: 40px;
    padding-left: 10px;
    color: var(--main-txt-color);
}
.field-edit div input::placeholder{
    font-family: 'Comfortaa';
    font-style: normal;
    font-weight: 400;
    font-size: 11px;
    line-height: 12px;
    color: #878787;
}
.btn-in-edit-profile{
    display: flex;
    flex-direction: row;
    width: 90%;
    justify-content: end;
}
.save-change{
    background: #5EC7DE;
    border-radius: 6px;
    padding: 0 20px;
    height: 33px;
    border: none;
    cursor: pointer;
    font-family: 'Comfortaa';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--main-bg-color);
    margin-right: 20px;
}
.cancel-change {
    background: #dc2d2d;
    border-radius: 6px;
    padding: 0 20px;
    height: 33px;
    border: none;
    cursor: pointer;
    font-family: 'Comfortaa';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 16px;
    color: var(--second-txt-color);
}
@media screen and (max-width: 420px){
    .download-img-back{
        height: 110vh;
      }
      .download-img{
        width: 70vw;
        height: 50vh;
      }
      .download-img-back-2{
        height: 110vh;
      }
      .download-img-2{
        width: 70vw;
        height: 50vh;
      }
      .profile-edit{
        width: 100vw;
    }
    .avatar-photo{
        top: -60px;
        left: 30px;
        width: 120px;
        height: 120px;
    }
    .name-profile-edit{
        gap: 5px;
        height: 80px;
        margin-left: 50px;
        margin-top: 10px;
    }
    .name-profile-edit h1{
        font-size: 20px;
    }
    .name-profile-edit p{
        font-size: 14px;
    }
    .field-edit{
        margin-top: 10px;
        margin-left: 30px;
    }
    .btn-in-edit-profile{
        display: flex;
        flex-direction: column;
        width: 90%;
        gap: 15px;
    }
    .save-change{
        padding: 0 20px;
        height: 33px;
        margin-right: 0px;
    }
}
</style>