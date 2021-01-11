<template>
    <div class="container">
        <div class="login">
            <div class="text-center py-5" v-if="registerSpinnerStatus">
                <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="box" v-else>
                <p class="text-center mb-3">
                    Enter your information ✌
                </p>
                <form @submit.prevent="register" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label" for="name">Name *</label>
                        <input type="text" id="name" placeholder="Name" v-model="user.name">
                        <span class="error">{{ userErrors.name | checkIfErrorExists }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email *</label>
                        <input type="email" id="email" placeholder="Email" v-model="user.email">
                        <span class="error">{{ userErrors.email | checkIfErrorExists }}</span>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="password">Password *</label>
                        <input type="password" id="password" placeholder="Password" v-model="user.password">
                        <span class="error">{{ userErrors.password | checkIfErrorExists }}</span>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn button">REGISTER</button>
                    </div>
                    <p class="text-center">
                        <small>{{ registerResponse }}</small>
                    </p>
                </form>
                <p class="text-center">
                    <small>
                        <a :href="loginRoute">Are you already registered? 🙄</a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</template>

<script>

import * as Vailidator from 'validatorjs';

export default {
    props: ['login-route'],
    data() {
        return {
            user:{
                name:'',
                email: '',
                password: ''
            },
            userErrors: {},
            rules: {
                name: 'required',
                email : 'required|email',
                password: 'required'
            },
            registerSpinnerStatus: false,
            registerResponse: '',
        }
    },
    name: 'register-component',
    methods: {
        async register(){
            let validation          = new Vailidator(this.user, this.rules)
            let validationStatus    = validation.passes();
            if(validationStatus){
                this.userErrors = {}
                try {
                    this.loginSpinnerStatus = !this.loginSpinnerStatus
                    let { data } = await axios.post('/register', this.user)
                    this.loginSpinnerStatus = !this.loginSpinnerStatus
                    this.registerResponse = data.message
                    
                } catch (error) {
                    console.log(error)
                }
            }
            else{
                this.userErrors = validation.errors.all();
            }
        }
    }
}
</script>

<style scoped>

</style>