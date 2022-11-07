require('./bootstrap')
import store from './vuex/store.js'

import { createApp } from 'vue'
import axios from 'axios'
import NavComponent from './components/NavComponent'
import FooterComponent from './components/FooterComponent'
import NotfoundComponent from './components/NotfoundComponent'


import LoginComponent from './components/auth/LoginComponent.vue'

import RegisterComponent from './components/auth/RegisterComponent'



import HomeComponent from './components/web/HomeComponent'

import FriendsComponent from './components/web/FriendsComponent'

import FriendrequestsComponent from './components/web/FriendrequestsComponent'

import UsersComponent from './components/web/UsersComponent'

import ArchieveComponent from './components/web/ArchieveComponent.vue'



import { createWebHistory, createRouter } from 'vue-router'
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/'   ,redirect:'/login'},

    { path: '/login', component: LoginComponent },


    { path: '/register', component: RegisterComponent },


    { path: '/home/:id', component: HomeComponent },


    { path: '/friends', component: FriendsComponent },

    
    { path: '/users', component: UsersComponent },


    { path: '/archieve/:id', component: ArchieveComponent },


   
    { path: '/friendsRequests', component: FriendrequestsComponent },


    { path: '/:notfound(.*)', component: NotfoundComponent },


  ]
})

const app = createApp({}).use(router)
app.use(store)
app.component('NavComponent', NavComponent)
app.component('FooterComponent', FooterComponent)

window.axios.defaults.headers.common['Authorization'] =localStorage.getItem('token');


app.mount('#app')


