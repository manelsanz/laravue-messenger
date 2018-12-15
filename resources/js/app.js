require('./bootstrap');
// window.Vue = require('vue');
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import store from './store';

Vue.use(BootstrapVue);

Vue.component('contact-form-component', require('./components/ContactFormComponent.vue'));
Vue.component('messenger-component', require('./components/MessengerComponent.vue'));
Vue.component('profile-form-component', require('./components/ProfileFormComponent.vue'));
Vue.component('contact-component', require('./components/ContactComponent.vue'));
Vue.component('contact-list-component', require('./components/ContactListComponent.vue'));
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue'));
Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue'));


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

const app = new Vue({
    el: '#app',
    store,
    methods: {
        logout() {
            // event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    }
});
