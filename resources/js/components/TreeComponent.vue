<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-md-5 bg-light border-right p-2">
            <ul>
                <li v-for="(item, index) in datas" :key="index" class="treeMain"> 
                    <a @click="select_item(0, item.id)" >{{ item.fullname }} ({{item.id}})</a>     
                    <ul v-show="isOpen">
                        <ol v-for="(dol) in item.doljnost" :key="dol.id">
                            <button @click="select_item(1, dol.id)"> {{dol.doljnost.doljnost}}| ({{dol.id}}) </button>
                        </ol>
                        <li class="" v-for="(child, ind) in item.children" :key="ind">
                            <button @click="select_item(2, child.id)">{{child.fullname}}|({{child.id}})1</button>
                            <ul>
                                <ol v-for="doljn in child.doljnost" :key="doljn.id">
                                   - <button class="btn btn-link" @click="select_item(1, doljn.id)"> {{doljn.doljnost.doljnost}}| ({{doljn.id}}) </button>
                                </ol>
                                <li class="" v-for="(litle, indexs) in child.children" :key="indexs">      
                                    
                                    <Button  @click="select_item(3, litle.id)" class="">{{litle.fullname}}({{litle.id}})</button>                                    
                                </li>
                                <input type="button" value="+" class="btn btn-sm createupr" @click="createOtdel(1, child.id, ind)">
                            </ul>
                        </li>                        
                    </ul>
                    <input type="button" value="+" class="btn btn-sm createupr" @click="createUpr(0, item.id, index)">
                </li>
            </ul>
        </div>
        <div class="col-md-7  p-0 border-left border-dark pl-1">
            <div class="card rounded-0  border-1">
                <div class="card-header">
                    {{selected.fullname}}
                </div>
                <div class="card-body">
                    <div class="persona-list" v-if="select_id == 1">
                        <ul>
                            <li v-for="(item, index) in t_ext" :key="index">
                                {{item.persona.fn + " " + item.persona.mn + " " + item.persona.ln}}
                            </li>
                        </ul>
                        <button class="btn btn-success w-100 rounded-0" @click="personAdd()">Добавить</button>                    
                        <div v-if="select_id == 0">
                            <ul> 
                                <p v-for="(dol) in selected.doljnost" :key="dol.id">
                                - <button @click="select_item(1, dol.id)"> {{dol.doljnost.doljnost}}| ({{dol.id}}) </button>
                                </p>
                                <p class="" v-for="(child, ind) in selected.children" :key="ind">
                                    - <button @click="select_item(2, child.id)">{{child.fullname}}|({{child.id}})</button>  
                                    <ul>
                                        <p class="" v-for="(litle, indexs) in child.children" :key="indexs">                                    
                                        - <Button  @click="select_item(3, litle.id)" class="">{{litle.fullname}}({{litle.id}})</button>                                    
                                        </p>
                                        <input type="button" value="+" class="btn btn-sm createupr" @click="createOtdel(1, child.id, ind)">
                                    </ul>
                                </p> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ModalView :otdel="otdel" :parent_id="parent_id_" :gu_id="gu_for_otdel_id" :add_id="add_id"></ModalView>
        
        </div>
    </div>
</template>

<script>
    export default {
        template: '#item-template',
        props: {
            datas:Array
        },
        data: function () {
            return {
                isOpen: true,
                otdel: "",
                gu_for_otdel_id: null,
                parent_id_: null,
                add_id: 0,
                t_ext: null,
                select_id: 0,
                selected: [],
            }
        },
        mounted(){
            $('#modals').modal('hide')
        },
        computed: {
            
            // isFolder: function (i) {
            //     return (datas.children.length > 0 ? true : false)
            // }
        },
        methods: {
            createUpr: function(add_id, id,i){                
                this.otdel = "Управление"
                this.gu_for_otdel_id = id;
                this.parent_id_ = null
                this.add_id = add_id
                $('#modals').modal('show')
            },
            createOtdel: function(add_id, parent_id, i){
                this.otdel = "Отдел"
                this.parent_id_ = parent_id;
                this.gu_for_otdel_id = null;
                this.add_id = add_id;
                $('#modals').modal('show')                             
            },
            select_item: function(click_id, i, index = 0){
                this.select_id = click_id
                this.selected = this.datas[index]
                axios.get('/api/getone?id='+i+'&trigger='+click_id).then((response)=>{
                    this.t_ext = response.data
                    console.log(this.selected)
                }).catch(function(error){
                    console.log("!!!!! ERROR !!!! function getGu STATUS CODE=" + error.response.status +';  message: ' + error.response.data.message)
                })
            },

            
        }
    }
</script>
