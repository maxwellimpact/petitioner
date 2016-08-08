window.Vue = require('vue');
import Sortable from 'vue-sortable'

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

require('./component/uploader');

Vue.use(Sortable)

var app = new Vue({
  el: '#app'
})
