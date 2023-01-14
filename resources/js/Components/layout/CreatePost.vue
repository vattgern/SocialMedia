<template>
    <div class="new-post" >
        <div @click="openCreatePost">
            <img src="/img/profile-img.png" alt="No Ethernet">
            <textarea name="" id="" cols="30" rows="10" placeholder="Добавить новый пост"></textarea>
            <img src="/img/photo-icon.png" alt="No Ethernet">
        </div>
        <div>
            <form>
              <div class="__select" data-state="">
                <div class="__select__title" data-default="Option 0">Тематика</div>
                <div class="__select__content">
                  <input id="singleSelect0" class="__select__input" type="radio" name="singleSelect" checked />
                  <label for="singleSelect0" class="__select__label">Option 0</label>
                  <input id="singleSelect1" class="__select__input" type="radio" name="singleSelect" />
                  <label for="singleSelect1" class="__select__label">Option 1</label>
                  <input id="singleSelect3" class="__select__input" type="radio" name="singleSelect" />
                  <label for="singleSelect3" class="__select__label">Option 3</label>
                  <input id="singleSelect4" class="__select__input" type="radio" name="singleSelect" />
                  <label for="singleSelect4" class="__select__label">Option 4</label>
                </div>
              </div>
            </form>
            <button class="publish">Опубликовать</button>
            <button class="close-btn" @click="closeCreatePost">Закрыть</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted(){
            const selectSingle = document.querySelector('.__select');
            const selectSingle_title = selectSingle.querySelector('.__select__title');
            const selectSingle_labels = selectSingle.querySelectorAll('.__select__label');

            // Toggle menu
            selectSingle_title.addEventListener('click', () => {
              if ('active' === selectSingle.getAttribute('data-state')) {
                selectSingle.setAttribute('data-state', '');
              } else {
                selectSingle.setAttribute('data-state', 'active');
              }
            });

            // Close when click to option
            for (let i = 0; i < selectSingle_labels.length; i++) {
              selectSingle_labels[i].addEventListener('click', (evt) => {
                selectSingle_title.textContent = evt.target.textContent;
                selectSingle.setAttribute('data-state', '');
              });
            }
        },
        methods: {
            openCreatePost(){
                document.querySelector('.new-post').classList.add('active-post');
            },
            closeCreatePost(){
                console.log('asdgasdhj')
                document.querySelector('.new-post').classList.remove('active-post');
            }
        }
    }
</script>

<style lang="css" scoped>
    /* Open create post section */
    
    .new-post{
        width: 720px;
        height: 70px;
        background: var(--main-bg-color);
        border-radius: 8px;
        gap: 10px;
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 10px;
        padding-top: 5px;
    }
    .new-post > div:first-child{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between; 
        height: 100%;
    }
    .new-post img:first-child{
        width: 45px;
        height: 45px;
    }
    .new-post textarea{
        width: 85%;
        height: 60%;
        background: transparent;
        border: none;
        outline: none;
        resize: none;
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 18px;
        padding-top: 12px;
        padding-left: 8px;
        color: var(--second-txt-color);
    }
    .new-post > div:last-child{
        display: none;
    }
    .active-post{
        height: 182px;
        padding-top: 20px;
    }
    .active-post > div:first-child{
        align-items: unset;
        height: 70%;
    }
    .active-post textarea{
        height: 90%;
        font-size: 18px;
    }
    .active-post > div:last-child{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        border-top: 1px solid #BCBCBC;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .new-post .publish, .new-post .close-btn{
        display: none;
    }
    .active-post .publish{
        display: block;
        width: 166px;
        height: 33px;
        border-radius: 6px;
        background: var(--second-color);
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 16px;
        color: var(--second-txt-color);
    }
    .active-post .close-btn{
        display: block;
        width: 166px;
        height: 33px;
        border-radius: 6px;
        background: #dc2d2d;
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 16px;
        color: var(--second-txt-color);
        position: relative;
        z-index: 10;
    }
    .new-post img:last-child{
        width: 34px;
        height: 40px;
    }
    
    /* Close create post section */
      .__select {
        position: relative;
        width: 230px;
        height: 40px;
        margin: 0 0;
        z-index: 10;
      }
      .__select[data-state=active] .__select__title::before {
        transform: translate(-3px, -50%) rotate(-45deg);
      }
      .__select[data-state=active] .__select__title::after {
        transform: translate(3px, -50%) rotate(45deg);
      }
      .__select[data-state=active] .__select__content {
        opacity: 1;
      }
      .__select[data-state=active] .__select__label + .__select__input + .__select__label {
        max-height: 40px;
        border-top-width: 1px;
      }
      
      .__select__title {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        padding: 8px 16px;
        border-radius: 5px;
        border:none;
        cursor: pointer;
        color: var(--second-txt-color);
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 18px;
      }
      .__select__title::before, .__select__title::after {
        content: "";
        position: absolute;
        top: 50%;
        right: 16px;
        display: block;
        width: 10px;
        height: 2px;
        transition: all 0.3s ease-out;
        background-color: var(--main-txt-color);
        transform: translate(-3px, -50%) rotate(45deg);
      }
      .__select__title::after {
        transform: translate(3px, -50%) rotate(-45deg);
        z-index: 5;
      }
      .__select__title:hover {
        border-color: #D8093A;
      }
      .__select__title:hover::before, .__select__title:hover::after {
        background-color: var(--main-txt-color);
      }
      
      .__select__content {
        position: absolute;
        top: 40px;
        left: 3px;
        display: flex;
        flex-direction: column;
        width: calc(100% - 6px);
        background-color: var(--second-bg-color);
        border: 2px solid var(--main-bg-color);
        transition: all 0.3s ease-out;
        opacity: 0;
        z-index: 8;
        border-radius: 6px;
      }
      .__select__content .__select__label{
        position: relative;
        z-index: 10;
      }
      
      .__select__input {
        display: none;
      }
      .__select__input:checked + label {
        color: var(--second-color);
      }
      .__select__input:disabled + label {
        opacity: 0.6;
        pointer-events: none;
      }
      
      .__select__label {
        display: flex;
        align-items: center;
        width: 100%;
        height: 40px;
        max-height: 0;
        padding: 0 16px;
        transition: all 0.2s ease-out;
        cursor: pointer;
        overflow: hidden;
        color: var(--main-txt-color);
        font-family: 'Comfortaa';
        font-style: normal;
        font-weight: 400;
        font-size: 15px;
        line-height: 18px;
      }

      .__select__label:hover {
        background-color: #D8093A !important;
        color: #ffffff;
      }
</style>