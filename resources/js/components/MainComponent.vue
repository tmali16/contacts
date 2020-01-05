<template>
<div class="row">

    <div class="col-md-12">
        <div class="card border-0 shadow"  style="border-radius: 0;">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Поиск</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Поиск...." v-model="search_text" @keyup="search()" @focusout="get()">
                </div>
                <div class="alert alert-danger" role="alert" v-if="errors != undefined && errors.length > 0 ">
                  <ul v-for="(item, index) in errors" :key="index">
                      <li>{{item.message}}</li>
                  </ul>
                </div>
            </div>
        </div>
    </div>    

    <div class="col-md-12 mt-2">
        <div class="card shadow border-0"  style="border-radius: 0;">
            <div class="card-header">Номера</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="pb-1 pt-1 align-middle">Каб.</th>
                            <th scope="col" rowspan="2" colspan="2" class="pb-1 pt-1 text-center align-middle">
                                Должность ФИО
                            </th>
                            <th scope="col" colspan="3" class="text-center pb-1 pb-1 align-middle">Телефон</th>                            
                        </tr>
                        <tr>
                            <td class="pb-1 pt-1 align-middle text-center">Городской</td>
                            <td class="pb-1 pt-1 align-middle text-center">Внутренний</td>
                            <td class="pb-1 pt-1 align-middle text-center">Сотовый</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data" :key="index" >
                            <th scope="rowgroup">{{index+1}} {{item.doljnost.gu}}</th>
                            <td colspan="2" class="pb-1 pt-1">
                                <p class="m-0 p-0">{{item.doljnost.doljnost.doljnost + " "}}</p>
                                <p class="m-0 p-0">{{item.zvanie.zvanie}}</p>
                                
                                <span class="p-0 m-0" >
                                    {{item.fn + " " + item.mn + " " + item.ln}}
                                </span>
                            </td>
                            <td class="pb-1 pt-1 align-middle text-center">
                                <span v-if="item.phone != undefined && item.phone.length > 0">
                                    <span v-for="phone in item.phone" :key="phone.id">
                                        <p v-if="phone.type_id == 1" class="p-0 m-0">{{phone.number}}</p>
                                    </span>
                                </span>
                            </td>
                            <td class="pb-1 pt-1 align-middle text-center">
                                <span v-if="item.phone != undefined && item.phone.length > 0">
                                    <span v-for="phone in item.phone" :key="phone.id">
                                        <p v-if="phone.type_id == 2" class="p-0 m-0">{{phone.number}}</p>
                                    </span>
                                </span>
                            </td>
                            <td class="pb-1 pt-1 align-middle text-center">
                                <span v-if="item.phone != undefined && item.phone.length > 0">
                                    <span v-for="phone in item.phone" :key="phone.id">
                                        <p v-if="phone.type_id == 3" class="p-0 m-0">{{phone.number}}</p>
                                    </span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center" id="spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
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
                errors: [],
                spinner: '',
            }
        },
        mounted() {
            this.spinner = $("#spinner");
            this.get()
        },
        methods: {
            get: function () {
                this.spinner.show()
                if(this.search_text.length == 0 || this.search_text == null){
                    axios.get('/api/phone').then((response)=>{
                        this.data = response.data
                        console.log(this.data)
                    }).catch(function(error){
                        this.spinner.addClass("hidden")
                        this.errors = error.response.data
                    })
                }
                this.spinner.hide()
            },
            search: function () {
                if(this.search_text && this.search_text.trim().length != 0){
                    axios.get('/api/search?q='+this.search_text).then((response)=>{
                        this.data = response.data
                        console.log(this.data)
                    }).catch(function(error){
                        console.log(error.message)
                    })
                }
            }
        }
    }
</script>
