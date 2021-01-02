<template>
  
  <div class="container">
    <TopBarComponent />
    <div class="hero-custom">
      <h1 class="text-center">Transactions</h1>
    </div>
    <p class="text-center text">
      Keep registered all the entries and exits in your financial system, to keep your money organized 💰
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
              <a class="btn button">New transaction 💰</a>
            </div>
          </div>
      </div>
      <div class="text-center py-5" v-if="tableSpinnerStatus">
        <div class="spinner-border text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div class="table-responsive" v-else>
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
        <paginate-links for="transactions" :simple="{ prev: 'Back', next: 'Next' }" :classes="{'ul': ['justify-content-center', 'pagination'], 'li': 'page-item', 'a': 'page-link'}"/>

      </div>
    </div>
      
    <create-modal-component v-if="createModalShow" />

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
      createModalShow: true,
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
        background: transparent;
        border: 1px solid #fff;
        border-radius: 10px;
        padding: .4rem 1rem;
        color: #fff;
        font-size: .8rem;
        width: 40%;
        @media(max-width: 770px){
          margin-bottom:.5rem;
          width: 100%;
        }
      }
      
      input::placeholder {
        color: #fff;
        font-size: .8rem;
      }
      select{
        option {
          background: #000;
        }
      }
      input:focus,
      select:focus {
        outline: none
      }
      .button {
        color: #075696;
        background: #fff;
        font-size: .8rem;
        border-radius: 10px;
        font-weight: bold;
        @media(max-width: 770px){
          width: 100%;
          margin-bottom:.5rem;
        }
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