<template>
    <b-container fluid class="admin_panel">
        <b-row class="h-100 ">            
            <b-card no-body class="col-12 bg-transparent rounded-0 border-0 h-100">
                <b-tabs pills vertical class="mt-5 justify-content-center" active-nav-item-class="sidebar_admin_active_class" nav-wrapper-class="col-sidebar mr-5" content-class="p-0 col-md-9 " nav-class="p-3 bg-white shadow-sm"> 
                    <b-tab title="Tab 1" @click="main_title='Список управлений'" >
                        <template v-slot:title>
                            <b-icon icon="journal-code"></b-icon> Список управлений
                        </template>
                        <b-card-text>
                            <b-card no-body class="rounded-0 border-0">
                                <b-card-header header-class="menu-them-header">
                                    <h5 class="m-0">{{main_title}}</h5> 
                                </b-card-header>
                                <b-card-body>

                                </b-card-body>
                            </b-card>
                        </b-card-text>
                    </b-tab>
                    <b-tab title="Tab 2"  @click="main_title='Службы'">
                        <template v-slot:title>
                            <b-icon icon="shield-shaded"></b-icon> Службы
                        </template>
                        <b-card-text>
                            <b-card no-body class="rounded-0 border-0">
                                <b-card-header header-class="menu-them-header">
                                    <h5 class="m-0">Службы </h5> 
                                </b-card-header>
                                <b-card-body body-class="row " >
                                    <b-col cols="12" class="mb-4">
                                        <b-button size="sm" class="text-white" variant="info" squared @click="FormAddUpr()">Добавить</b-button>
                                        <b-button size="sm" class="text-white" variant="info" squared @click="FormAddSlujba()">Добавить сотрудника</b-button>
                                    </b-col>
                                    <b-col cols="3" class="overflow-auto" style="height: 300px;">
                                        <b-tree-view 
                                            ref="tree"
                                            :nodesDraggable="false"
                                            :renameNodeOnDblClick="false"
                                            :data="treeData" 
                                            :contextMenu="false" 
                                            :contextMenuItems="contextMenuItems" :showicon="false" @nodeSelect="nodeSelect"
                                            nodeKeyProp="id" nodeLabelProp="shortname"></b-tree-view>
                                    </b-col>
                                    <b-col cols="9">
                                        {{selectedNode.fullname}} {{selectedNode.id}}
                                    </b-col>
                                </b-card-body>
                            </b-card>
                        </b-card-text>
                    </b-tab>
                    <b-tab title="Tab 3" @click="main_title='Настройки'">
                        <template v-slot:title>
                            <b-icon icon="gear-wide-connected"></b-icon> Настройки
                        </template>
                        <b-card-text>
                            <b-card no-body class="rounded-0 border-0">
                                <b-card-header header-class="menu-them-header">
                                    <h5 class="m-0">{{main_title}}</h5> 
                                </b-card-header>
                                <b-card-body>
                                    
                                </b-card-body>
                            </b-card>
                        </b-card-text>
                    </b-tab>
                </b-tabs>
            </b-card>
        </b-row>
        <b-modal id="modal-lg" size="lg" title="Добавить управление" centered  hide-footer v-model="upr_modal">
            <b-row>
                <b-col cols="3">
                    <label for="uprful_name" class="mb-2">Плное название: </label>
                    <label for="uprsh_name" class="mb-2">Короткое название: </label>
                    <label for="uprparrent_name" class="mb-2">Управление: </label>
                </b-col>
                <b-col cols="4">
                    <b-form-input id="uprful_name" type="text" size="sm" class="mb-2 rounded-0"></b-form-input>
                    <b-form-input id="uprsh_name" type="text" size="sm" class="mb-2  rounded-0"></b-form-input>
                    <b-form-select v-model="newData.parrent_id" :options="parrent_s" value-field="id" text-field="fullname" size="sm" class="mb-2 rounded-0"></b-form-select>
                </b-col>
            </b-row>
        </b-modal>
    </b-container>
</template>

<script>
    import { bTreeView } from 'bootstrap-vue-treeview'
    export default {
        props:[],
        components: {
            bTreeView
        },
        data() {
            return {
                main_title: "Список управлений",
                treeData: [],
                contextMenuItems: [],
                selectedNode: {
                    fullname: "",
                    shortname: "",
                    id: 0
                },
                upr_modal: false,
                newData:{
                    fullname: '',
                    shortname: '',
                    id: 0,
                    parrent_id: 0
                },
                parrent_s:[]
            }
        },
        mounted() {
            this.get()
        },
        computed: {            
        },
        methods: {
            get(){
                axios.get("/admin/contact/data/all").then(x=>{
                    this.treeData = x.data.slujba
                    this.parrent_s = x.data.parrent
                }).catch(e=>{
                    console.log(e)
                })
            },
            FormAddUpr(){
                this.upr_modal = true;
            },
            FormAddSlujba(){
                
            },
            nodeSelect(node, isSelected) {
                // console.log('Node ' + node.data + ' has been ' + (isSelected ? 'selected' : 'deselected'))
                if (isSelected) {
                    this.selectedNode = node.data
                } else if (node.data === this.selectedNode) {
                    this.selectedNode = null
                }
            },
        },
    }
</script>
