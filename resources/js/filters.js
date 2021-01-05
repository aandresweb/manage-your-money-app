Vue.filter('checkIfErrorExists', value =>  typeof(value) === 'undefined' ? '' : value[0] );
Vue.filter('pen', value => `S/${parseFloat(value).toFixed(2)}` );