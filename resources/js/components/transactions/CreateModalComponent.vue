<template>
  <div class="modal-custom">
      
      <div class="modal-box">
          <div class="close d-flex justify-content-end">
            <span @click.prevent="closeModal" aria-hidden="true">&times;</span>
          </div>
          <p class="text-center my-4">Record the information about your transaction to keep your money organized 📈</p>
          <form @submit.prevent="storeTransaction" autocomplete="off">
              <div class="mb-2">
                  <label class="form-label" for="description">Description *</label>
                  <input type="text" id="description" placeholder="E.g. 'This is an entry of my job in January...'" v-model="transaction.description">
                  <span class="error">{{ transactionErrors.description | checkIfErrorExists }}</span>
              </div>
              <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="#">Ammount *</label>
                            <input type="number" id="ammount" placeholder="E.g. '50.00'" v-model="transaction.ammount">
                            <span class="error">{{ transactionErrors.ammount | checkIfErrorExists }}</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label" for="type">Type *</label>
                            <select v-model="transaction.type" id="type" @change="enableArea">
                                <option value="EARNING" selected>EARNING</option>
                                <option value="OUTFLOW">OUTFLOW</option>
                            </select>
                            <span class="error">{{ transactionErrors.type | checkIfErrorExists }}</span>
                        </div>
                    </div>  
                    
              </div>
              <div class="row">
                  <div class="col-md-6" v-if="showAreaStatus">
                    <div class="mb-4">
                        <label class="form-label" for="area">Area *</label>
                        <select v-model="transaction.area" id="area">
                            <option v-for="(area, index) in areas" :key="index" :value="area.id">{{ area.name }}</option>
                        </select>
                        <span class="error">{{ transactionErrors.area | checkIfErrorExists }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label" for="date">Date *</label>
                        <datepicker :input-class="'w-100'"  :language="es" v-model="transaction.date"></datepicker>
                        <span class="error">{{ transactionErrors.date | checkIfErrorExists }}</span>
                    </div>
                  </div>
              </div>
              <div>
                  <button type="submit" class="btn button">Create transaction 💰</button>
              </div>
          </form>
      </div>
  </div>
</template>

<script>

import * as Validator from 'validatorjs';
import {es} from 'vuejs-datepicker/dist/locale';
import Datepicker from 'vuejs-datepicker';
export default {
    name: 'create-modal-component',
    props: ['areas'],
    data(){
        return {
            transaction: {
                description: '',
                ammount: null,
                area : null,
                date: '10/10/2021',
                type: ''
            },
            transactionErrors: {},
            rules :{
                description: 'required',
                ammount: 'required',
                date: 'required',
                type: 'required'
            },
            es,
            showAreaStatus: true
        }
    },
    components:{
        Datepicker
    },
    methods: {
        closeModal(){
            this.$emit('close-create-modal');
        },
        async storeTransaction(){
            let validation = new Validator(this.transaction, this.rules);
            let validationStatus = validation.passes();
            if(validationStatus){
                try {
                    let { data } = await axios.post('/transactions', this.transaction);
                    if(data.data){
                        this.$emit('store-transaction');
                    }
                } catch (error) {
                    console.log(error)
                }
            }
            else{
                this.transactionErrors = validation.errors.all();
            }
        },
        enableArea(){
            switch (this.transaction.type) {
                case 'EARNING':
                     this.showAreaStatus = !this.showAreaStatus
                     this.transaction.area = null
                    break;
                case 'OUTFLOW':
                    this.showAreaStatus = !this.showAreaStatus
                    break;
                default:
                    break;
            }
        }
    },
}
</script>

<style lang="scss" scoped>
   
</style>