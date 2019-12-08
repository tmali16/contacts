<template>
      <div class="card">
        <div class="card-body">
          <div class="row">              
              <div class="form-group mr-2">
                  <label for="autocomplete-input" class=""> Фамилия</label>
                  <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="fn">
              </div>

              <div class="form-group mr-2">
                <label for="autocomplete-input">Имя</label>
                <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="mn">
              </div>

              <div class="form-group mr-2">
                <label for="autocomplete-input">Отчество</label>
                <input type="text" id="autocomplete-input" class="form-control form-control-sm" v-model="ln">
              </div>

              <div class="form-group mr-2">
                <label for="doljnost">Должность</label>
                <select  style="display: block;" class="form-control form-control-sm">
                  <option value="" >Должность</option>
                </select>
              </div>
          </div>
          

    <!--------------------- phones ------------------------------------>
      <div class="col-md-8">
        <div class="card" style="padding: 10px;">
          <div class="card-title">
            Телефоны
          </div>
          <div class="card-body">
            <div class="row">
              <div class="" v-for="(item, index) in ret" :key="index">
                  <div class="col row ">
                    <label for="icon_telephone">Телефон {{item}}</label>       
                    <div class="col-sm-6">
                      <input :id="'telephone'+item" type="tel" class="form-control form-control-sm" v-model="phoneNum">
                    </div>     
                    <div class="col-sm-2 d-inline-block" style="padding: 0px;">                
                      <select  style="display: block;" :id="'type'+item" v-model="phoneType" class="form-control form-control-sm">
                        <option  v-for="(item, index) in phoneTypeArr" :value="index" :key="index">{{item}}</option>
                      </select>
                    </div>
                    <div class="col-sm-1">
                      <a class="btn btn-sm btn-primary" href="#" id="NewPhoneCity" @click="Counts()" v-if="(item == ret) && (item <= 4)">+</a>  
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    <!----------------------- end phones ---------------------------------->
        </div>
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
