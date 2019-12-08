<template>
    <div class="card">
        <div class="card-content">
            <div class="card">
                <div class="card-content">
                    <a class="waves-effect waves-light btn-small" @click="switchs('gu')">Добавить ГУ</a>
                </div>
            </div>

            <div class="card" v-if="switchTbl">
                <div class="card-content">
                    <span class="card-title">
                        Список главных управлений
                    </span>
                    <table>
                        <thead>
                            <tr>
                            <th>ГУ</th>
                            <th>Управление</th>
                            <th>Item Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in allGu" :key="index">
                            <td>{{item.fullname +' ('+item.shortname+')'}}</td>
                            <td>
                                <span class="col" v-for="(items, index) in item.upr" :key="index">
                                    {{items.fullname +' ('+items.shortname+')'}}
                                </span>                                
                            </td>
                            <td><a class="btn-floating btn-large waves-effect waves-light red btn-small" @click="switchs('upr', item.id)"><i class="fas fa-plus"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div id="modals_admin" class="modals" v-if="modal">
            <div class="modals-content">
                
                <div class="card" >                
                <div class="card-content">
                    <span class="card-title">
                        Добавить главное управление
                        <span class="close"  @click="switchs()">&times;</span>
                    </span>
                    <div class="row valign-wrapper">
                        <div class="input-field col s5">
                            <input type="text" id="autocomplete-input" class="autocomplete" v-model="fullname">
                            <label for="autocomplete-input">Полное название</label>
                        </div>
                        <div class="input-field col s5">
                            <input type="text" id="autocomplete-input" class="autocomplete" v-model="shortname">
                            <label for="autocomplete-input">Абривиатура</label>
                        </div>
                        <div class="col s2 ">
                            <a class="waves-effect waves-light btn-small " @click="store()">Добавить</a>
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
            }
        },
        mounted() {
            this.getGu();
        },
        methods: {
            switchs: function(sluj, id){                
                
                if(this.modal){
                    this.modal = false
                }else{
                    this.modal = true
                    this.slujba = sluj
                    if(this.slujba != 'gu'){
                        this.id  = id
                    }else{
                        this.id = null
                    }
                }
                this.getGu();
            },
            getGu: function () {
                axios.get('/api/gu').then((response)=>{
                    this.allGu = response.data
                    console.log(this.allGu)
                }).catch(function(error){
                    console.log('get all gu error ')
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
a**************v@b*.ru
adiletamanbekov@bk.ru