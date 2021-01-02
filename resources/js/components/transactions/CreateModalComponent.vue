<template>
  <div class="modal-custom">
      
      <div class="modal-box">
          <div class="close d-flex justify-content-end">
            <span @click.prevent="closeModal" aria-hidden="true">&times;</span>
          </div>
          <p class="text-center my-4">Record the information about your transaction to keep your money organized 📈</p>
          <form @submit.prevent="storeTransaction">
              <div class="mb-3">
                  <label class="form-label" for="#">Description:</label>
                  <input type="text" placeholder="E.g. 'This is an entry of my job in January...'" v-model="transaction.description">
              </div>
              <div class="mb-3">
                  <label class="form-label" for="#">Ammount</label>
                  <input type="number" placeholder="E.g. '50.00'" v-model="transaction.ammount">
              </div>
              <div class="mb-3">
                  <label class="form-label" for="#">Area</label>
                  <select v-model="transaction.area">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                </select>
              </div>
              <div class="mb-4">
                  <label class="form-label" for="#">Date</label>
                  <input type="text" placeholder="E.g. '01/01/2021'" v-model="transaction.date" disabled>
              </div>
              <div>
                  <button type="submit" class="btn button">Create transaction 💰</button>
              </div>
          </form>
      </div>
  </div>
</template>

<script>
export default {
    name: 'create-modal-component',
    data(){
        return {
            transaction: {
                description: '',
                ammount: 0,
                area : '',
                date: ''
            }
        }
    },
    methods: {
        closeModal(){
            this.$emit('close-create-modal');
        },
        storeTransaction(){
            alert('c')
        }
    }
}
</script>

<style lang="scss" scoped>
    .modal-custom {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        min-height: 100vh;
        z-index: 999;
        background-color: rgba(0, 0, 0, 0.59);
        display: flex;
        justify-content: center;
        align-items: center;
        .modal-box{
            background: linear-gradient(to left, #005c97, #363795);
            width: 30%;
            padding: 2rem 2rem 5rem 2rem;
            border-radius: 10px;
            .close{
                color: #Fff;
                cursor: pointer;
            }
            p{
                color :#fff
            }
            input, select {
                width: 100%;
            }
            .button {
                width: 100%;
            }
            @media(max-width: 770px){
                width: 90%;
                padding: 2rem 1rem 4rem 1rem;
            }
        }
    }
</style>