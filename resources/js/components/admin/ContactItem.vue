<template>
<ul>
    <b-media tag="li" class="shadow-sm mb-2" v-for="(item, index) in data" :key="index">
      <template v-slot:aside>
       <b-img blank blank-color="#cba" width="64" alt="placeholder"></b-img>
      </template>
      <h5 class="mt-0 mb-1">List-based media object</h5>
      <p class="mb-0">
        
      </p>
    </b-media>
  </ul>
</template>

<script>
    export default {
        props:['id'],
        data() {
            return {
                data: []
            }
        },
        mounted() {
            
        },
        computed: {
            
        },
        methods: {
            get(id){
                axios.get().then(d=>{
                    this.data = d.data
                }).catch(e=>{
                    console.log(e)
                })
            }
        },
    }
</script>
