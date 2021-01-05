<template>
    <div class="container">
        <div class="login">
            <div class="text-center py-5" v-if="loginSpinnerStatus">
                <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="box" v-else>
                <p class="text-center mb-3">
                    Enter your credentials ✌
                </p>
                <form @submit.prevent="login" autocomplete="off">
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
                        <button type="submit" class="btn button">LOGIN</button>
                    </div>
                    <p class="text-center">
                        <small>{{ loginResponse }}</small>
                    </p>
                </form>
                <p class="text-center">
                    <small>
                        <a href="#">¿Forgot your password? 🤔</a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import * as Vailidator from 'validatorjs';
export default {
    name: 'login-component',
    data(){
        return {
            user: {
                email : '',
                password: ''
            },
            userErrors: {},
            rules: {
                email : 'required|email',
                password: 'required'
            },
            loginSpinnerStatus: false,
            loginResponse: '',
        }
    },
    methods: {
        async login(){
            let validation          = new Vailidator(this.user, this.rules)
            let validationStatus    = validation.passes();
            if(validationStatus){
                this.userErrors = {}
                try {
                    this.loginSpinnerStatus = !this.loginSpinnerStatus
                    let { data } = await axios.post('/login', this.user)
                    this.loginSpinnerStatus = !this.loginSpinnerStatus
                    this.loginResponse = data.message
                    if(data.success){
                        location.reload();
                    }
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

<style lang="scss" scoped>
    .login{
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        .box {
            border:1px solid rgba(255, 255, 255, 0.268);
            border-radius: 5px;
            width: 40%;
            padding: 3.5rem 1.5rem 4rem 1.5rem;
            font-family: 'Poppins';
            p{
                color: #fff
            }
            input {
                width: 100% 
            }
            .button{
                width: 100%;
            }
            a{
                color: #fff;
                font-size: .8rem;
            }
        }
    }
</style>