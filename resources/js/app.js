require('./bootstrap');
require('./filters');

Vue.component('index-transactions-component', require('./components/transactions/IndexComponent').default);
Vue.component('index-areas-component', require('./components/areas/IndexComponent').default);
Vue.component('login-component', require('./components/auth/LoginComponent').default);
Vue.component('register-component', require('./components/auth/RegisterComponent').default);

const app = new Vue({
    el: '#app'
});