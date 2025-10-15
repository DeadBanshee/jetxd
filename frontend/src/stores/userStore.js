import { defineStore } from 'pinia'
import axios from 'axios'
import  router  from '@/router'

export const useUserStore = defineStore('userStore', {
  state: () => ({
    userToken: localStorage.getItem('userToken') || null,
    user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null
  }),
  actions: {
    async login(username, password) {
      try {
        const res = await axios.post('http://localhost:8000/api/user/login', {
          username,
          password
        })

        this.userToken = res.data.token
        this.user = res.data.user
        localStorage.setItem('userToken', this.userToken)
        localStorage.setItem('user', JSON.stringify(this.user)) 
        console.log(res.data)
        router.push('/')
        return true

      } catch (error) {
        console.error('Login error:', error.response?.data?.error || error.message)
        return false
      }
    },
    async signUp(username, email, password) {
      try {
        const res = await axios.post('http://localhost:8000/api/user/signUp', {
          username,
          email,
          password
        })

        this.userToken = res.data.token
        this.user = res.data.user
        localStorage.setItem('userToken', this.userToken)
        localStorage.setItem('user', JSON.stringify(this.user)) 
        router.push('/')
        return res.data

      } catch (error) {
        console.error('Sign Up error:', error.response?.data?.message || error.message)
        return false
      }
    },
    async ping() {
      try {
        const res = await axios.get('http://localhost:8000/api/ping', {
          headers: {
            Authorization: `Bearer ${this.userToken}`
          }
        })
        console.log('✅ Auth OK:', res.data)
      } catch (err) {
        console.error('❌ Auth failed:', err.response?.data || err.message)
      }
    },
    logout(){
        this.userToken = null;
        this.user = null;
        localStorage.removeItem('userToken');
        router.push('/')
    }
  }
})
