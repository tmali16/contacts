<template>
      <div class="card">
          <div class="card-content">
            <div class="row">              
              <div class="input-field col s5">
                  <input type="text" id="autocomplete-input" class="autocomplete" v-model="fn">
                  <label for="autocomplete-input">Фамилия</label>
              </div>              
              <div class="input-field col s5">
                <input type="text" id="autocomplete-input" class="autocomplete" v-model="mn">
                <label for="autocomplete-input">Имя</label>
              </div>
              <div class="input-field col s10">
                <input type="text" id="autocomplete-input" class="autocomplete" v-model="ln">
                <label for="autocomplete-input">Отчество</label>
              </div>
              <div class="input-field col s10" style="padding: 0px;">                
                <select  style="display: block;">
                  <option value="" >Должность</option>
                </select>
              </div>
            </div>

    <!--------------------- phones ------------------------------------>
              <div class="card " style="padding: 10px;">
                <div class="card-title">
                  Телефоны
                </div>
                <div class="card-content">
                  <div class="row">
                    <div class="phone-line" v-for="(item, index) in ret">
                        
                        <div class="input-field col s7">                
                          <input :id="'telephone'+item" type="tel" class="validate" v-model="phoneNum">
                          <label for="icon_telephone">Номер телефона</label>
                        </div>
                        <div class="input-field col s3" style="padding: 0px;">                
                          <select  style="display: block;" :id="'type'+item" v-model="phoneType">
                            <option  v-for="(item, index) in phoneTypeArr" :value="index" >{{item}}</option>
                          </select>
                        </div>
                        <div class="m1 col s2 center">
                          <a class="btn-floating waves-effect waves-light btn" id="NewPhoneCity" @click="Counts()" v-if="(item == ret) && (item <= 4)">+</a>  
                        </div>
                    </div>
                  </div>
                </div>
              </div>
    <!----------------------- end phones ---------------------------------->
            <a class="waves-effect waves-light btn-small">Button</a>
          </div>
        </div>
</template>

<script>
    export default {
        data: function(){
            return{
                ret: 1,
                phoneTypeArr: ['Городской','Внутренний','Сотовый'],
                phoneType: '',
                phoneNum: '',
                fn: '',
                mn: '',
                ln: '',
            }
        },
        mounted() {
            
        },
        methods:{
            Counts: function(){
                this.ret = this.ret+1;
            },
            add: function(){

            }
        }
    }
</script>
