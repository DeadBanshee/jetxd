import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/homepage.vue'
import Login from '../views/login.vue'
import Profile from '../views/profile.vue'
import Membership from '../views/membership.vue'
import MembershipSucces from '../views/membershipSuccess.vue'

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/login', name: 'Login', component: Login },
  { path: '/profile', name: 'Profile', component: Profile },
  { path: '/membership', name: 'Membership', component: Membership },
  { path: '/membershipSuccess', name: 'MembershipSuccess', component: MembershipSucces },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
