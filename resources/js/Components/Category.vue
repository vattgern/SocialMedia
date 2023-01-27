<template>
    <div class="category">
        <div class="category-header">
            Выберите категори
        </div>
        <div class="category-body">
            <ul class="categories">
                <li v-for="category in categories">
                    <input type="checkbox"
                           :value="category.id"
                           v-model="selected"
                           :id="`category${category.id}`">
                    <label :for="`category${category.id}`">
                        {{ category.name }}
                    </label>
                </li>
            </ul>
        </div>
        <div class="category-footer">
            <button @click="send">Принять</button>
        </div>
    </div>
</template>

<script>
import api from "../api";

export default {
    name: "Category",
    data(){
        return {
            categories: [],
            selected: [],
        }
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories(){
            api.get('/api/categories').then(r => {
                this.categories = r.data.data;
            })
        },
        send(){
            console.log(this.selected);
            api.post('/api/categories/add',{
                categories: this.selected,
            }).then(r => {
                this.$router.push({
                    name: 'profile'
                });
            })
        }
    }
}
</script>

<style scoped>
    .category{
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .category-header{
        width: 50%;
        font-size: 4vw;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }
    .category-body{
        width: 50%;
    }
    .category-footer{
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .category-footer button{
        cursor: pointer;
        margin-top: 2vw;
        padding: 15px 30px;
        font-size: 2vw;
        border-radius: 10px;
        background-color: #686FFD;
        color: white;
    }
    .category-body ul{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 3vw;
        list-style: none;
        padding: 20px;
    }
    .category-body ul li{
        display: flex;
    }
    .category-body ul li label{
        display: flex;
        flex-direction: row;

        font-family: 'Comfortaa', sans-serif;

        background-color: #2B3241;
        border: 2px solid #B1B2CF;
        color: #B1B2CF;
        border-radius: 25px;
        white-space: nowrap;
        margin: 3px 0;
        user-select: none;
        transition: all .2s;

        padding: 12px 18px;
        cursor: pointer;
        font-size: 2vw;
    }
    .category-body ul li label:hover{
        border: 2px solid #686FFD;
    }
    .category-body li input[type='checkbox']:checked ~ label{
        border: 2px solid #686FFD;
        background-color: #686FFD;
        color: white;
        transition: all .2s;
    }
    .category-body li input[type='checkbox']{
        display: none;
    }
</style>
