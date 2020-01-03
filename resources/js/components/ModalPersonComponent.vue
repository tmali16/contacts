<template>
    <!-- Modal -->
    <div class="modal fade" id="personmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Добавить сотрудника</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fname">Фамилия <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="fname" aria-describedby="fname" placeholder="Фамилия" required v-model="fname">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mname">Имя <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="mname" aria-describedby="mname" placeholder="Имя" required v-model="mname">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lname">Отчество </label>
                        <input type="text" class="form-control form-control-sm" id="lname" aria-describedby="lname" placeholder="Отчество " v-model="lname">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zvanie">Звание <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" id="zvanie" v-model="zvanie">
                            <option  v-for="(item, index) in getData.zvanie" :key="index" :value="item.id">{{item.zvanie}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="gupravlenie">Главное управление <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" id="gupravlenie" v-model="gu" @change="upr()">
                            <option v-for="(item, index) in getData.gu" :key="index" :value="item.id">{{item.fullname}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" v-if="(upr_dolj.doljnost != undefined && upr_dolj.doljnost.length > 0) ">
                        <label for="upravlenie">Должность<span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" :disabled="upr_ > 0" id="upravlenie" v-model="gu_doljnost" >
                            <option value="0">--Выберите--</option>
                            <option v-for="(item, index) in upr_dolj.doljnost" :key="index" :value="item.id">{{item.doljnost.doljnost}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" v-if="(upr_dolj.children != undefined && upr_dolj.children.length > 0)">
                        <label for="upravlenie">Управление </label>
                        <select class="form-control form-control-sm" :disabled="gu_doljnost > 0" id="upravlenie" v-model="upr_" @change="upr()">
                            <option value="0">--Выберите--</option>
                            <option v-for="(item, index) in upr_dolj.children" :key="index" :value="item.id">{{item.fullname}}</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6" v-if="upr_ > 0">
                        <label for="doljnost">Должность 2<span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" :disabled="gu_doljnost > 0" id="doljnost" v-model="doljnost">
                            <option v-for="(item, index) in getData.gu.find(x=>x.id == gu).children.find(r=>r.id == upr_).doljnost" :key="index" :value="item.id">{{item.doljnost.doljnost}}</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-row card rounded-0 p-0">
                        <div class="card-header rounded-0 pb-0 pt-0">
                            Телефон
                        </div>
                        <div class="card-body pt-1 pb-1">
                            <div class="col-md-12 form-row" v-for="i in tel" :key="i" id="tels">
                                <div class="form-group col-sm-6">
                                    <label :for="'tel_'+i">Телефон {{i}}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm rounded-0 " :id="'tel_'+i" @change="phoneAdd">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label :for="'tel_type_'+i">Тип</label>
                                    <select class="form-control form-control-sm rounded-0 " :id="'tel_type_'+i">
                                        <option value="1">Городской</option>
                                        <option value="2">Внутренний</option>
                                        <option value="3">Сотовый</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="storePhone()">Test</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="storePersona()">Save changes</button>
                
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                getData: [],
                upr_dolj: [],
                gu: '',
                fname: "",
                mname: "",
                lname: "",
                doljnost: 0,
                zvanie: 0,
                upr_: 0,
                gu_doljnost: 0,
                success: [],
                tel_city: '',
                tel_inner: '',
                tel_mob: '',
                tel: [1]
            }
        },
        mounted() {
            this.get()
            $("#toast_message").toast({
                delay: 5000,
                show: true,
                animation: true,
                autohide: true
            })
        },
        methods:{
            get:function(){
                axios.get('/api/gu').then((response)=>{
                    this.getData = response.data
                    console.log(this.getData)
                }).catch(function(error){
                    console.log("!!!!! ERROR !!!! function getGu STATUS CODE=" + error.response.status +';  message: ' + error.response.data.message)
                })
            },
            def: function(){
                this.doljnost = 0
                this.gu = 0
                this.upr_ = 0
            },
            upr: function(){
                this.upr_dolj = this.getData.gu.find(x=>x.id === this.gu)
            },
            storePersona: function() {
                let dolj_id = this.gu_doljnost;
                if(this.gu_doljnost == 0){
                    dolj_id = this.doljnost
                }

                if(this.fname.trim().length > 2 && this.mname.trim().length > 2 && this.zvanie > 0){
                    // var url = "fname="+this.fname.trim()+"&mname="+this.mname.trim()+"&lname="+this.lname.trim()+
                    //         "&zvanie="+this.zvanie+"&doljnost="+dolj_id;
                    axios({
                        url: "/api/put",
                        method: "POST",
                        data:{
                            fname: this.fname,
                            mname: this.mname,
                            lname: this.lname,
                            zvanie: this.zvanie,
                            doljnost: dolj_id,
                            phone: this.getPhone()
                        }
                    }).then((response)=>{
                        this.success = response.data;
                        if(this.success.state == true){
                            $("#toast_message .toast-body").text(this.success.message)
                            $("#toast_message").toast("show")
                            $("#personmodal").modal("hide")
                        }else{
                            $("#toast_message .toast-body").text(this.success)
                            $("#toast_message").toast("show")
                        }
                    }).catch(function(error){
                        let to = $("#toast_message");
                        to.text().replace("$message", "", "Ощибка записи данных "+ error.response.status)
                        to.toast("show")
                        console.log("!!!!! ERROR !!!! function store persona STATUS CODE=" + error.response.status +';  message: ' + error.response.data.message)
                    })
                }else{
                    let to = $("#toast_message");
                    $("#toast_message .toast-body").text("Не все поля заполнены!")
                    to.toast("show")
                }
            },
            phoneAdd: function () {
                if(this.tel <= 3){
                    this.tel++
                }
            },
            getPhone: function () {
                let telp = [];
                for(let s = 1; s <= this.tel; s++){
                    let tel = $("#tel_"+s).val();
                    let sel = $("#tel_type_"+s).children("option:selected").val()
                    let tr = {
                        'tel': tel,
                        'type': sel
                    }
                    telp.push(tr)
                }
                return telp;
            }
        }
    }
</script>
