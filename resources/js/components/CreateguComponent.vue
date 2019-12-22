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
                                <td>
                                    {{item.fullname +' ('+item.shortname+')'}}
                                    <ul>
                                        <li v-for="it in item.otdel" :key="it.id">{{it.fullname}}</li>
                                    </ul>
                                </td>
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
                        <h5 class="modal-title">Добавить</h5>
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
                        </div>
                        <div class="" v-if="modal_add_id == 4">
                            <div class="form-group col s5">
                                <label for="autocomplete-input">Выберите отдел, упарвление, главное управление {{podvedomstvo_id}}</label>
                                <select name="" id="" class="form-control" v-model="podvedomstvo_id" @change="getUprOtdel(podvedomstvo_id)">
                                    <option  v-for="(item, index) in allGu.gu" :key="index" :value="item.id">
                                        {{item.fullname}}
                                    </option>
                                </select>
                                <select name="otdupr" id=""></select>
                                <br>
                                <label for="autocomplete-input">Выберите должность</label>
                                <select name="" id="" class="form-control" v-model="doljnosti_id">
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
                                <select  style="display: block;" class="form-control form-control-sm" v-model="doljnost_id">
                                    <option v-for="item in allGu.doljnost" :key="item.id" :value="item.id" >{{item.doljnost}}</option>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <label for="doljnost">Звание</label>
                                <select  style="display: block;" class="form-control form-control-sm" v-model="zvanie_id">
                                    <option v-for="(item, index) in allGu.rank" :key="index" :value="item.id" >{{item.rank}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" v-if="modal_add_id != 0">
                            <a href="#" class="btn btn-sm btn-primary text-white"  @click="store()">Сохранить</a>
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
                ln: null,
                zvanie_id: null,
                doljnost_id: null,
                podvedomstvo_id: 1,
                doljnosti_id: null
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
                    console.log(this.allGu)
                }).catch(function(error){
                    console.log("get all error " + error.data)
                })
            },

            store: function () {
                if(this.modal_add_id == 1){
                    var url = 'state_id='+this.modal_add_id+'&fullname='+this.fullname + "&shortname=" + this.shortname+'&guid='+this.gu_id;
                }else if(this.modal_add_id == 2){
                    var url = 'state_id='+this.modal_add_id+'&fullname='+this.fullname + "&shortname=" + this.shortname+'&guid='+this.gu_id;
                }else if(this.modal_add_id == 3){
                    var url = 'state_id='+this.modal_add_id+'&fn='+this.fullname + "&mn=" + this.ln+'&zvanie_id='+this.zvanie_id+'&doljnost_id='+this.doljnost_id+'&guid='+this.gu_id;
                }else if(this.modal_add_id == 4){
                    var url = 'state_id='+this.modal_add_id+'&podgu_id='+this.podvedomstvo_id + "&doljnosti_id=" + this.doljnosti_id;
                }
                console.log(url)
                axios.get('/store/new?'+url
                ).then((response)=>{
                    this.fullname = null;
                    this.shortname = null;
                    this.slujba = null;
                    this.id = null
                    this.switchs(this.gu_id)
                    $('#modals_admin').modal('hide')
                }).catch((error)=>{
                    console.log('store gu error '+error.errors)
                })
                this.getGu();
            },
            getUprOtdel: function(gu_id){
                axios.get('/api/uprotd?gu_id='+gu_id).then((response)=>{
                    console.log(response.data)
                }).catch(function(error){
                    console.log("get all error " + error.data)
                })
            }
        }

    }
</script>