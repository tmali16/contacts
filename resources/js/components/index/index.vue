<template> 
    <b-container fluid >
        <b-row>
            <b-col cols="3"  >
                <b-card class="rounded-0 border-0 shadow-sm" no-body>
                    <b-card-header header-class="menu-them-header">
                        <h4 class="m-0"><b-icon icon="border-width"></b-icon> Меню</h4>
                    </b-card-header>
                    <b-card-body class="p-2">
                        <b-tabs vertical class="col border-0 bg-transparent m-0 p-0" nav-class="border-0 p-0 m-0" active-nav-item-class="text-info p-0 mb-2">
                            <b-tab active  title-link-class="border-0 p-0 mb-2 bg-transparent">
                                <template v-slot:title>
                                    <b-icon icon="person-bounding-box"></b-icon> Все контакты
                                </template>
                            </b-tab> 
                            <b-tab title-link-class="border-0 p-0 mb-2 bg-transparent" title-item-class="text-dark">
                                <template v-slot:title >
                                    <b-icon icon="folder2"></b-icon> Управление
                                </template>
                            </b-tab> 
                        </b-tabs>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col cols="9">
                <b-card class="rounded-0 border-0 shadow-sm" no-body>
                    <b-card-header header-class="menu-them-header">
                        <h4 class="m-0">Контакты</h4>
                    </b-card-header>
                    <b-card-body>
                        <b-media tag="li" class="my-4">
                            <template v-slot:aside>
                                <b-avatar variant="info" size="3rem"></b-avatar>
                            </template>
                            <h5 class="mt-0 mb-1">List-based media object</h5>
                            <p class="mb-0">
                                Cras
                            </p>
                        </b-media>
                    </b-card-body>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    props:[],
    data() {
        return {
            
        }
    },
    mounted() {
        
    },
    computed: {
        
    },
    methods: {
        
    },
}
</script>
