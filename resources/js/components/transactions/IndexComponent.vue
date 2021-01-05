<template>
  
  <div class="container">
    <top-bar-component :logout-route="logoutRoute" :areas-route="areasRoute" :transactions-route="transactionsRoute"/>
    <div class="hero-custom">
      <h1 class="text-center">Transactions</h1>
    </div>
    <p class="text-center text">
      Keep registered all the earnings and outflows in your financial system, to keep your money organized 💰
    </p>
    <div class="data">
      <div class="controls">
          <div class="row justify-content-between">
            <div class="col-12 col-md-6">
              <input type="text" placeholder="Search... 🔍" v-model="transactionFilter">
              <select v-model="quantityRows">
                <option value="5">Show 5</option>
                <option value="10">Show 10</option>
                <option value="20">Show 20</option>
                <option value="50">Show 50</option>
              </select>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
              <a class="btn button" @click.prevent="toggleModal">New transaction 💰</a>
            </div>
          </div>
      </div>
      <div class="text-center py-5" v-if="tableSpinnerStatus">
        <div class="spinner-border text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <template v-else>
        <div class="table-responsive" >
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Description</th>
              <th scope="col">Type</th>
              <th scope="col">Ammount</th>
              <th scope="col">Area</th>
              <th scope="col">Date</th>
              <th scope="col">Options</th>
            </tr>
          </thead>
          <paginate name="transactions" :list="transactionsFiltered" :per="parseInt(quantityRows)" tag="tbody">
            <tr v-for="(transaction, index) in paginated('transactions')" :key="index" :class="typeClass(transaction.type)">
              <td>{{ transaction.id }}</td>
              <td>{{ transaction.description }}</td>
              <td>{{ transaction.type }}</td>
              <td>{{ transaction.ammount | pen }}</td>
              <td>{{ transaction.area }}</td>
              <td>{{ transaction.date }}</td>
              <td class="text-center">
                <button class="btn btn-sm button" @click.prevent="deleteTransaction(transaction.id)">
                  <span  aria-hidden="true">&times;</span>
                </button>
              </td>
            </tr>
          </paginate>
        </table>

        </div>
        <paginate-links for="transactions" :simple="{ prev: 'Back', next: 'Next' }" :classes="{'ul': ['justify-content-center', 'pagination'], 'li': 'page-item', 'a': 'page-link'}"/>
      </template>
    </div>

    <footer-component />
      
    <create-modal-component v-if="createModalShow" v-on:close-create-modal="toggleModal" v-on:store-transaction="storeTransaction" />

  </div>

</template>

<script>

import TopBarComponent from '../TopBarComponent.vue';
import FooterComponent from '../FooterComponent';
import CreateModalComponent from './CreateModalComponent.vue';
import VuePaginate from 'vue-paginate'

export default {
  name: 'index-transactions-component',
  components:{
    TopBarComponent,
    FooterComponent,
    VuePaginate,
    CreateModalComponent
  },
  props: ['logout-route', 'areas-route', 'transactions-route'],
  data() {
    return {
      transactions: [],
      transactionFilter: '',
      tableSpinnerStatus: true,
      createModalShow: false,
      paginate: ['transactions'],
      quantityRows: 5
    }
  },
  created(){
    this.getTransactions();
  },
  methods: {
    async getTransactions(){
      let { data } = await axios.get('/transactions/all');
      this.transactions = data.data;
      this.tableSpinnerStatus = !this.tableSpinnerStatus
    },
    storeTransaction(){
      this.toggleModal();
      this.getTransactions();
      this.tableSpinnerStatus = !this.tableSpinnerStatus;
    },
    async deleteTransaction(id){
      let confirmDelete = confirm('Are you sure do u want to delete this transaction?');
      if(confirmDelete){
        try {
          let { data } = await axios.delete(`transactions/${id}`);
          this.getTransactions();
          this.tableSpinnerStatus = !this.tableSpinnerStatus;
        } catch (error) {
          console.log(error);
        };
        
      }
    },
    toggleModal(){
      this.createModalShow = !this.createModalShow;
    },
    typeClass(type){
      if(type === 'EARNING'){
        return 'positive-row'
      }
      return 'negative-row'
      
      
    }
  },
  computed:{
    transactionsFiltered(){
      if(!this.transactionFilter){
        return this.transactions;
      }
      return this.transactions.filter( (transaction) => 
        transaction.description.toLowerCase().includes(this.transactionFilter.toLowerCase()) ||
        String(transaction.ammount).includes(this.transactionFilter) 
      );
    },
  }
}
</script>

<style lang="scss" scoped>
  


</style>