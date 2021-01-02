require('./bootstrap');

Vue.component('index-component', require('./components/transactions/IndexComponent').default);

const app = new Vue({
    el: '#app'
});