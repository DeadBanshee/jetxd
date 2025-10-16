import { defineStore } from 'pinia'
import axios from 'axios'
import  router  from '@/router'
import { useUserStore } from './userStore'

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
    async subscribe(price_id) {
      try {
        
        const userStore = useUserStore();
        const res = await axios.post('http://localhost:8000/api/membership/subscribe',
        { price_id: price_id }, 
        {
                headers: { Authorization: `Bearer ${userStore.userToken}` }
        });

        console.log(res.data)

        return res.data

      } catch (error) {
        console.error('Plan fetch error:', error.response?.data?.error || error.message)
        return false
      }
    },
  }
})
