<template>
    <div class="container">
        <top-bar-component :logout-route="logoutRoute" :areas-route="areasRoute" :transactions-route="transactionsRoute"  />
        <div class="hero-custom">
            <h1 class="text-center">Areas</h1>
        </div>
        <p class="text-center text">
            Separate the most important areas in which you should save 💰
        </p>
        <div class="data">
            <div class="controls">
                <div class="row justify-content-end">
                    <div class="col-6 d-flex justify-content-end">
                        <a class="btn button" @click.prevent="toggleModal">New area 💰</a>
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
                                <th scope="col">Name</th>
                                <th scope="col">Porcent</th>
                                <th scope="col" width="10%">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(area, index) in areas" :key="index">
                                <td>{{ area.name }}</td>
                                <td>{{ area.porcent }}%</td>
                                <td class="text-center">
                                    <button @click.prevent="deleteArea(area.id)" class="btn btn-sm button" >
                                        <span  aria-hidden="true">&times;</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>

        <footer-component />

        <create-modal-component v-on:store-area="storeArea" v-if="createModalShow" v-on:close-create-modal="toggleModal"/>
    </div>
    
    
</template>

<script>
import FooterComponent from '../FooterComponent.vue'
import TopBarComponent from '../TopBarComponent.vue'
import CreateModalComponent from './CreateModalComponent.vue'
export default {
    name: 'index-areas-component',
    props: ['logout-route', 'transactions-route', 'areas-route'],
    components: {
        TopBarComponent,
        CreateModalComponent,
        FooterComponent
    },
    data(){
        return {
            areas: [],
            createModalShow: false,
            tableSpinnerStatus: true
        }
    },
    created(){
        this.getAreas();
    },
    methods: {
        async getAreas(){
            let { data } = await axios.get('/areas/all');
            this.areas = data.data;
            this.tableSpinnerStatus = !this.tableSpinnerStatus;
        },
        storeArea(){
            this.toggleModal();
            this.getAreas();
            this.tableSpinnerStatus = !this.tableSpinnerStatus
        },
        async deleteArea(id){
            let confirmDelete = confirm('Are you sure do you want to delete this area and all the transactions about this area?')
            if(confirmDelete){
                try {
                    let { data } = axios.delete(`/areas/${id}`);
                    this.getAreas();
                    this.tableSpinnerStatus = !this.tableSpinnerStatus;
                } catch (error) {
                    console.log(error)  ;
                }
            }
        },
        toggleModal(){
            this.createModalShow = !this.createModalShow
        }
    }
}
</script>

<style>

</style>