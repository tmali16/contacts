<template>
    <div id="modals" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">   
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить {{otdel}}</h5>
                    <br>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" @click="switchs()">&times;</span>                    
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col">
                        <select class="form-control " v-model="upr_dolj">
                            <option value="3">Добавить управление</option>
                            <option value="4">Добавить должность</option>
                        </select>
                    </div>
                    <div class="" v-if="upr_dolj == 3">                        
                        <div class="form-group col s5">
                            <label for="autocomplete-input1">Полное название</label>
                            <input type="text" id="autocomplete-input1" class="form-control form-control-sm" v-model="fullname_">
                        </div>
                        <div class="form-group col s5">
                            <label for="autocomplete-input2">Абривиатура</label>
                            <input type="text" id="autocomplete-input2" class="form-control form-control-sm" v-model="shortname_">                                        
                        </div>
                        <input type="hidden" v-model="gu_id">
                        <input type="hidden" v-model="parent_id" v-if="gu_id == null">
                        {{parent_id}}
                    </div>
                    <div class="form-group col" v-if="upr_dolj == 4">
                        <label for="doljnosti">Должность </label>
                        <select class="form-control " id="doljnosti" v-model="doljnost">
                            <option v-for="(item, index) in dolj" :key="index" :value="item.id">{{item.doljnost}}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-sm btn-primary text-white"  @click="store()">Сохранить</a>
                </div>
            </div>        
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            otdel: null,
            parent_id: null,
            gu_id: null,
            add_id: 0,
        },
        data: function(){
            return {
                fullname_: '',
                shortname_: '',
                gu_id_: null,
                parent_id_: null,
                upr_dolj: 3,
                dolj: [],
                doljnost: null
            }
        },
        mounted() {
            this.getDolj()
        },
        methods:{
            getDolj: function(){
                axios.get('/api/dolj').then((response)=>{
                    this.dolj = response.data
                }).catch(function(error){
                    console.log("!!!!! ERROR !!!! function getGu STATUS CODE=" + error.response.status +';  message: ' + error.response.data.message)
                })
            },
            store: function() {
                this.parent_id_ = this.parent_id 
                this.gu_id_ = this.gu_id
                if(this.upr_dolj == 3){
                    if(this.add_id == 0){
                        var url = 'add_id='+this.add_id+'&fullname='+this.fullname_ + "&shortname=" + this.shortname_+'&guid='+this.gu_id_;
                    }else if(this.add_id == 1){
                        var url = 'add_id='+this.add_id+'&fullname='+this.fullname_ + "&shortname=" + this.shortname_+'&parent_id='+this.parent_id_;
                    }
                }else if(this.upr_dolj == 4){
                    if(this.add_id == 0){
                        var url = "add_id="+this.upr_dolj+"&dol_id="+this.doljnost+"&guid="+this.gu_id+'&uprid=';
                    }else if(this.add_id == 1){
                        var url = "add_id="+this.upr_dolj+"&dol_id="+this.doljnost+"&guid=&uprid="+this.parent_id;
                    }
                    
                }
                axios.get('/store/new?'+url).then((response)=>{
                    this.fullname_ = null;
                    this.shortname_ = null;
                    this.add_id = 0;
                    this.parent_id = null
                    this.gu_id_ = null;
                    this.parent_id_ = null
                    $('#modals').modal('hide')
                }).catch((error)=>{
                    console.log('store DOLJNOST error '+error.response.message)
                })
            }
        }
    }
</script>
