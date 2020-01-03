<template>
    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-sm btn-primary rounded-0" @click="switchs('gu')" data-toggle="modal" data-target="#modals_admin">Добавить ГУ</a>
                    <button class="btn btn-success btn-sm rounded-0" @click="personAdd()">Добавить</button>
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
        <ModalPerson></ModalPerson>
        <div class="toast" role="status" aria-live="assertive" aria-atomic="true" id="toast_message" style="position: absolute; top: 0; right: 0; z-index: 9999;">
            <div class="toast-header">
                <strong class="mr-auto">Message</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                
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
                    
                }).catch(function(error){
                    console.log("!!!!! ERROR !!!! function getGu STATUS CODE=" + error.response.status +';  message: ' + error.response.data.message)
                })
            },
            getGupr: function(){
                axios.get('/api/getgu').then((response)=>{
                    this.gu = response.data
                }).catch(function(error){
                    console.error("!!!!! ERROR !!!! function getGupr error STATUS=" + error.response.status +';  message: ' + error.response.data.message)
                    
                })
            },
            getUprOtdel: function(gu_id){
                axios.get('/api/uprotd?gu_id='+gu_id).then((response)=>{
                    console.log(response.data)
                }).catch(function(error){
                    console.log("get all error " + error.data)
                })
            },
            personAdd: function(){
                $("#personmodal").modal("show")
            }
        }

    }
</script>