<template>
    <div class="card border-0 shadow">
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
                    <TreeView :datas="gu"></TreeView>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
    import VJstree from 'vue-jstree'
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
                doljnosti_id: null,
                gu: []
            }
        },
        mounted() {
            this.getGupr();

        },
        computed:{
            
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
                    console.log("!!!!! ERROR !!!! function getGu STATUS CODE=" + error.response.status +';  message: ' + error.response.data.message)
                })
            },
            getGupr: function(){
                axios.get('/api/getgu').then((response)=>{
                    this.gu = response.data
                    console.log(this.gu)
                }).catch(function(error){
                    console.error("!!!!! ERROR !!!! function getGupr error STATUS=" + error.response.status +';  message: ' + error.response.data.message)
                    
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
            },
        }

    }
</script>