<template>
    <div class="modal-custom">
        <div class="modal-box">
            <div class="close d-flex justify-content-end">
                <span @click.prevent="closeModal" aria-hidden="true">&times;</span>
            </div>
            <p class="text-center my-4">Record the most important areas 📈</p>
            <form @submit.prevent="storeArea" autocomplete="off">
                <div class="mb-2">
                    <label class="form-label" for="name">Name *</label>
                    <input type="text" id="name" placeholder="E.g. 'Necesities, Education, etc...'" v-model="area.name">
                    <span class="error">{{ areaErrors.name | checkIfErrorExists }}</span>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="porcent">Porcent *</label>
                    <input type="number" id="porcent" placeholder="E.g. '50 or 20 porcent' " v-model="area.porcent">
                    <span class="error">{{ areaErrors.porcent | checkIfErrorExists }}</span>
                </div>
                <div>
                  <button type="submit" class="btn button">Create area 💰</button>
                </div>
            </form>
        </div> 
    </div>
</template>

<script>
import * as Validator from 'validatorjs'
export default {
    name: 'create-modal-component',
    data(){
        return {
            area:{
                name: '',
                porcent: null,
            },
            areaErrors:{},
            rules: {
                name: 'required',
                porcent: 'required'
            }
        }
    },
    components: {
        
    },
    methods: {
        closeModal(){
            this.$emit('close-create-modal');
        },
        async storeArea(){
            let validation = new Validator(this.area, this.rules)
            let validationStatus = validation.passes()
            if(validationStatus){
                try {
                    let { data } = await axios.post('/areas', this.area);
                    if(data.data){
                        this.$emit('store-area')
                    }
                } catch (error) {
                    console.log(error)
                }
            }
            else{
                this.areaErrors = validation.errors.all();
            }
        }
    }
}
</script>

<style>

</style>