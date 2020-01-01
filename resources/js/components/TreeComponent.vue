<template>
    <div class="container-flouid row">
        <div class="col-md-5 ml-2 p-2 bg-light">
            <ul>
                <li v-for="(item, index) in datas" :key="index" class="treeMain"> 
                    <a @click="select_item(item.id)" >{{ item.fullname }} ({{item.id}})</a>     
                    <ul v-show="isOpen">
                        <li class="" v-for="(child, ind) in item.children" :key="ind" @click="select_item(child.id)" >
                            <a @click="select_item(child.id)">{{child.fullname}}({{child.id}})</a>  
                            <ul>
                                <li class="" v-for="(litle, indexs) in child.children" :key="indexs" style="background-color: #777; ">
                                    <a  @click="select_item(litle.id)">{{litle.fullname}}({{litle.id}})</a>
                                    <ul></ul>
                                </li>
                                <input type="button" value="+" class="btn btn-sm createupr" @click="createOtdel(1, child.id, ind)">
                            </ul>
                        </li>                        
                    </ul>
                    <input type="button" value="+" class="btn btn-sm createupr" @click="createUpr(0, item.id, index)">
                </li>
            </ul>
        </div>
        <div class="col-md-6 bg-light ml-2">
            {{t_ext}}
        </div>
        <ModalView :otdel="otdel" :parent_id="parent_id_" :gu_id="gu_for_otdel_id" :add_id="add_id"></ModalView>
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
                t_ext: "",
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
            toggle: function (i) {
                
                 if (this.isFolder) {
                    this.isOpen = !this.isOpen
                }
            },
            makeFolder: function () {
                if (!this.isFolder) {
                    this.$emit('make-folder', this.datas)
                    this.isOpen = true
                }
            },
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
            select_item: function(i){
                this.t_ext = i
                console.log("selected:" + i)
            }
        }
    }
</script>
