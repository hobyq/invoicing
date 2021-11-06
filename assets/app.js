import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import Vue from 'vue'
import VueRouter from 'vue-router'

import vuetify from './plugins/vuetify'

import Home from './components/Home'
import Clients from "./components/Clients";
import Countries from "./components/Countries";
import Items from "./components/Items";
import Invoices from "./components/Invoices";

const routes = [
    {
        path: '/',
        component: Home,
        name: 'home',
        children: [
            {
                path: '/clients',
                component: Clients,
                name: 'clients'
            },
            {
                path: '/countries',
                component: Countries,
                name: 'countries'
            },
            {
                path: '/items',
                component: Items,
                name: 'items'
            },
            {
                path: '/invoices',
                component: Invoices,
                name: 'invoices'
            },
        ]
    },
]

const router = new VueRouter({
    mode: 'hash',
    base: '/',
    routes
})

Vue.use(VueRouter)

new Vue({
    router,
    vuetify
}).$mount('#app')
