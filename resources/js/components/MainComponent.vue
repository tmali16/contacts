<template>
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow"  style="border-radius: 0;">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Поиск</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Поиск...." v-model="search_text" @keyup="search()" @focusout="get()">
                </div>
            </div>
        </div>
    </div>    
    <div class="col-md-12 mt-2">        
        <div class="card shadow border-0"  style="border-radius: 0;">
            <div class="card-header">Номера</div>
            <div class="card-body">
                <ul>
                    <li v-for="item in data" :key="item.id">
                        {{item.fullname}}
                        <ul v-if="item.otdel != null">
                            <li v-for="t in item.otdel" :key="t.id"> {{t.fullname}}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data: function(){
            return {
                data: [],
                search_text: ''
            }
        },
        mounted() {
            this.get()
        },
        methods: {
            get: function () {
                if(this.search_text.length == 0 || this.search_text == null){
                    axios.get('/api/phone').then((response)=>{
                        this.data = response.data
                    }).catch(function(error){
                    })
                }
            }, 
            search: function () {
                if(this.search_text != null && this.search_text.trim().length != 0){
                    axios.get('/api/search?q='+this.search_text).then((response)=>{
                        this.data = response.data
                    }).catch(function(error){
                        console.log(error.message)
                    })
                }
            }
        }
    }
</script>
