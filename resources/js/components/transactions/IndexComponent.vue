<template>
  
  <div class="container">
    <TopBarComponent />
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
              <select>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
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
              <th scope="col">Ammount</th>
              <th scope="col">Area</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <paginate name="transactions" :list="transactionsFiltered" :per="10" tag="tbody">
            <tr v-for="(transaction, index) in paginated('transactions')" :key="index">
              <td>{{ transaction.id }}</td>
              <td>{{ transaction.description }}</td>
              <td>{{ transaction.ammount }}</td>
              <td>{{ transaction.area }}</td>
              <td>{{ transaction.date }}</td>
            </tr>
          </paginate>

          <tbody>
            
          </tbody>
        </table>

        </div>
        <paginate-links for="transactions" :simple="{ prev: 'Back', next: 'Next' }" :classes="{'ul': ['justify-content-center', 'pagination'], 'li': 'page-item', 'a': 'page-link'}"/>
      </template>
    </div>
      
    <create-modal-component  v-if="createModalShow" v-on:close-create-modal="toggleModal" />

  </div>

</template>

<script>

import TopBarComponent from '../TopBarComponent.vue';
import CreateModalComponent from './CreateModalComponent.vue';
import VuePaginate from 'vue-paginate'

export default {
  components:{
    TopBarComponent,
    VuePaginate,
    CreateModalComponent
  },
  data() {
    return {
      transactions: [],
      transactionFilter: '',
      tableSpinnerStatus: true,
      createModalShow: false,
      paginate: ['transactions'],
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
    toggleModal(){
      this.createModalShow = !this.createModalShow;
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
    }
  }
}
</script>

<style lang="scss" scoped>
  
  .hero-custom {
    padding-top: 4rem;
    padding-bottom: 3rem;
    h1 {
      margin-bottom: 0;
      font-size: 3rem;
      font-weight: normal;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      @media(max-width: 770px){
        font-size: 2rem;
      }
    }
  }
  .text{
    color: #fff;
    font-family: 'PT Serif', serif;
  }
  .data {
    margin: 4rem 0 4rem 0;
    .controls{
      font-family: 'Poppins', serif;
      input, select {
        width: 40%;
      }
    }
  }
  .table-responsive {
    margin-top: 1rem;
    font-family: 'PT Serif', serif;
    th, td {
      color: #fff;
      border-top-width: 1px;
      border-left-width: 1px;
      border-right-width: 1px;
    }
  }
  
</style>