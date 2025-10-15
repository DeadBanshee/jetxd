import { defineStore } from 'pinia'
import axios from 'axios'
import  router  from '@/router'

export const useMembershipStore = defineStore('membershipStore', {
  state: () => ({
    plans: null,
  }),
  actions: {
    async fetchPlans() {
      try {
        const res = await axios.get('http://localhost:8000/api/membership')

        this.plans = res.data.plans;
        console.log(this.plans);
        return true

      } catch (error) {
        console.error('Plan fetch error:', error.response?.data?.error || error.message)
        return false
      }
    },
  }
})
