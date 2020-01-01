<template>
<div class="row">

    <div class="col-md-12">
        <div class="card border-0 shadow"  style="border-radius: 0;">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Поиск</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Поиск...." v-model="search_text" @keyup="search()" @focusout="get()">
                </div>
                <div class="alert alert-danger" role="alert" >
                  <ul v-for="(item, index) in errors" :key="index">
                      <li>{{item.message}}</li>
                  </ul>
                </div>
            </div>
        </div>
    </div>    

    <div class="col-md-5 mt-2">        
        <div class="card shadow border-0"  style="border-radius: 0;">
            <div class="card-header">Структура</div>
            <div class="card-body">
                <ul>
                    <li v-for="item in data" :key="item.id" class="mainTree-view">
                        <span class="tree-text">{{item.fullname}}</span>
                        <ul v-if="item.children != null">
                            <li v-for="t in item.children" :key="t.id"><span class="tree-text" >{{t.fullname}}</span></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-7 mt-2">
        <div class="card shadow border-0"  style="border-radius: 0;">
            <div class="card-header">Номера</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2">Каб.</th>
                            <th scope="col" rowspan="2">Должность</th>
                            <th scope="col" rowspan="2">ФИО</th>
                            <th scope="col" colspan="3" class="text-center">Телефон</th>                            
                        </tr>
                        <tr>
                            <td>Городской</td>
                            <td>Внутренний</td>
                            <td>Сотовый</td>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
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
                search_text: '',
                errors: []
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
                        console.log(error.response)
                        this.errors = error.response.data
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
