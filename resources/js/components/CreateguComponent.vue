<template>
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-sm btn-primary" @click="switchs('gu')" data-toggle="modal" data-target="#modals_admin">Добавить ГУ</a>
                </div>
            </div>
            <div class="card mt-2" >
                <div class="card-body">
                    <span class="card-title">
                        Список главных управлений
                    </span>
                    <table class="table ">
                        <thead>
                            <tr>
                            <th>ГУ</th>
                            <th>Управление</th>
                            <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in allGu.gu" :key="index">
                                <td>{{item.fullname +' ('+item.shortname+')'}}</td>
                                <td>
                                    <span class="col" v-for="(items, index) in item.upr" :key="index">
                                        {{items.fullname +' ('+items.shortname+')'}}
                                    </span>                                
                                </td>
                                <td>
                                    <a class="btn btn-light btn-small" data-toggle="modal" data-target="#modals_admin" @click="switchs(item.id)">
                                        Добавить
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modals_admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">   
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Добавить {{gu_id}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="switchs()">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="modal_add_id">
                                <option value="0" selected>--Выберите--</option>
                                <option value="1">Управление</option>
                                <option value="2">Отдел</option>
                                <option value="4">Должность</option>
                                <option value="3">Сотрудник</option>
                            </select>
                        </div>
                        <div class="" v-if="modal_add_id == 1 || modal_add_id == 2">
                            <div class="form-group col s5">
                                <label for="autocomplete-input">Полное название</label>
                                <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="fullname">
                                
                            </div>
                            <div class="form-group col s5">
                                <label for="autocomplete-input">Абривиатура</label>
                                <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="shortname">                                        
                            </div>
                            <div class="col align-right ">
                                <a class="btn btn-small btn-info text-white" @click="store()">Добавить</a>
                            </div>
                        </div>
                        <div class="" v-if="modal_add_id == 4">
                            <div class="form-group col s5">
                                <label for="autocomplete-input">Выберите</label>
                                <select name="" id="" class="form-control">
                                    <option  v-for="(item, index) in allGu.doljnost_name" :key="index" :value="item.id">{{item.doljnost}}</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="" v-if="modal_add_id == 3">
                            <div class="form-group mr-2">
                                <label for="autocomplete-input" class=""> Фамилия</label>
                                <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="fn">
                            </div>

                            <div class="form-group mr-2">
                                <label for="autocomplete-input">Имя</label>
                                <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="mn">
                            </div>

                            <div class="form-group mr-2">
                                <label for="autocomplete-input">Отчество</label>
                                <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="ln">
                            </div>

                            <div class="form-group mr-2">
                                <label for="doljnost">Должность</label>
                                <select  style="display: block;" class="form-control form-control-sm">
                                    <option v-for="item in allGu.doljnost" :key="item.id" :value="item.id" >{{item.doljnost}}</option>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label for="doljnost">Звание</label>
                                <select  style="display: block;" class="form-control form-control-sm">
                                    <option v-for="(item, index) in allGu.rank" :key="index" :value="item.id" >{{item.rank}}</option>
                                </select>
                            </div>
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
                switchGu : false,
                shortname: '',
                switchTbl : true,
                fullname: '',
                allGu: [],
                modal : false,
                slujba: '',
                id : null,
                gu_id: null,
                upr_add_chng: true,
                modal_add_id: 0,
                fn: null,
                mn: null,
                ln: null
            }
        },
        mounted() {
            this.getGu();
        },
        methods: {
            switchs: function(id){
                this.gu_id = id                
            },
            getGu: function () {
                axios.get('/api/gu').then((response)=>{
                    this.allGu = response.data
                }).catch(function(error){
                })
            },

            store: function () {
                if(this.slujba != 'gu'){
                    var url = ''+this.slujba+'?fullname='+this.fullname + "&shortname=" + this.shortname+'&id='+this.id;
                }else{
                    var url = ''+this.slujba+'?fullname='+this.fullname + "&shortname=" + this.shortname;
                }
                console.log(url)
                axios.get('/store/'+url
                ).then((response)=>{
                    this.fullname = null;
                    this.shortname = null;
                    this.slujba = null;
                    this.id = null
                    this.switchs()
                }).catch((error)=>{
                    console.log('store gu error '+error.errors)
                })
            }
        }

    }
</script>