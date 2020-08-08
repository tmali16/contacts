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
                            <b-col cols="12" class="mb-2 bg-white p-2">
                                <b-button size="sm" class="text-white" variant="info" squared @click="FormAddUpr()">Добавить</b-button>
                                <b-button size="sm" class="text-white" variant="info" squared @click="FormAddSlujba()">Добавить сотрудника</b-button>
                            </b-col>
                            <b-card no-body class="rounded-0 border-0">
                                <b-card-header header-class="menu-them-header">
                                    <h5 class="m-0">Службы </h5> 
                                </b-card-header>
                                <b-card-body body-class="row ">                                    
                                    <b-col cols="3" class="overflow-auto" style="height: 300px;">
                                        <b-tree-view ref="tree" :nodesDraggable="false" :renameNodeOnDblClick="false" :data="treeData" 
                                            :contextMenu="false"  :contextMenuItems="contextMenuItems" :showicon="false" @nodeSelect="nodeSelect"
                                            nodeKeyProp="id" nodeLabelProp="shortname"></b-tree-view>
                                    </b-col>
                                    <b-col cols="9">
                                        <b-card class="mb-2 rounded-0 border-0" body-class="pl-5 pr-0" header-class="p-2">
                                            <template v-slot:header v-if="selectedNode.fullname.length > 2">
                                                <h5 class="m-0">{{selectedNode.fullname}}</h5>
                                            </template>
                                            <!-- ******************************************************************************************************************* -->
                                            <b-media tag="li" class="on_hover_item mb-2 p-3" v-for="(item, index) in selectedNode.doljnosti" :key="index+2*9">
                                                <template v-slot:aside>
                                                    <b-avatar variant="primary" text="BV"></b-avatar>
                                                </template>
                                                <h5 class="mt-0 mb-1">{{item.fn + " " + item.mn + " " +item.ln}}</h5>
                                                <p class="mb-0">{{item.doljnost}}</p>
                                            </b-media>

                                            <!-- ******************************************************************************************************************* -->
                                            <!-- <b-card class="mb-2 rounded-0 border-0" body-class="on_hover_item" header-class="p-2 mb-2"  v-for="(item, index) in selectedNode.doljnosti" :key="index+1*8">
                                                <template v-slot:header v-if="selectedNode.fullname.length > 2">
                                                    <h5 class="m-0">{{selectedNode.fullname}}</h5>
                                                </template>
                                                <b-media tag="li" class="mb-2">
                                                    <template v-slot:aside>
                                                        <b-img blank blank-color="#cba" width="64" alt="placeholder"></b-img>
                                                    </template>
                                                    <h5 class="mt-0 mb-1">{{item.fn + " " + item.mn + " " +item.ln}}</h5>
                                                    <p class="mb-0">{{item.doljnost}}</p>
                                                </b-media>
                                            </b-card> -->
                                            <div v-if="selectedNode.children != null">
                                                <b-card class="mb-2 rounded-0 border-0" header-class="p-2"  v-for="(iu, index) in selectedNode.children" :key="index+1*8">
                                                    <template v-slot:header v-if="iu.fullname.length > 2">
                                                        <h5 class="m-0">{{iu.fullname}}</h5>
                                                    </template>
                                                    <b-media tag="li" class="on_hover_item mb-2 p-3" v-for="(item, index) in iu.doljnosti" :key="index+2*9">
                                                        <template v-slot:aside>
                                                            <b-img blank blank-color="#cba" width="64" alt="placeholder"></b-img>
                                                        </template>
                                                        <h5 class="mt-0 mb-1">{{item.fn + " " + item.mn + " " +item.ln}}</h5>
                                                        <p class="mb-0">{{item.doljnost}}</p>
                                                    </b-media>
                                                </b-card>
                                            </div>
                                        </b-card>                                                  
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
                    id: 0,
                    doljnosti: [
                        {
                            doljnost: "",
                            fn:"",
                            mn:"",
                            ln:"",
                            zvanie: ""
                        }
                    ], 
                    children: [{
                        fullname: "",
                        shortname: "",
                        id: 0,
                        doljnosti: [
                            {
                                doljnost: "",
                                fn:"",
                                mn:"",
                                ln:"",
                                zvanie: ""
                            }
                        ],
                    }]
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
                if (isSelected) {
                    this.selectedNode = node.data
                } else if (node.data === this.selectedNode) {
                    this.selectedNode = null
                }
            },
        },
    }
</script>
