require('./bootstrap');
// window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import store from './store';
import MessengerComponent from './components/MessengerComponent.vue';
import ProfileFormComponent from './components/ProfileFormComponent.vue';


Vue.use(VueRouter);
Vue.use(BootstrapVue);

Vue.component('contact-form-component', require('./components/ContactFormComponent.vue'));
// Vue.component('messenger-component', require('./components/MessengerComponent.vue'));
// Vue.component('profile-form-component', require('./components/ProfileFormComponent.vue'));
Vue.component('contact-component', require('./components/ContactComponent.vue'));
Vue.component('contact-list-component', require('./components/ContactListComponent.vue'));
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue'));
Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue'));


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

const routes = [
    // { path: '/profile', component: ProfileFormComponent },
    { path: '/chat', component: MessengerComponent },
    { path: '/chat/:conversationId', component: MessengerComponent },
];

const router = new VueRouter({ routes, mode: 'history' });

const app = new Vue({
    el: '#app',
    store,
    router,
    methods: {
        logout() {
            // event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    }
});
