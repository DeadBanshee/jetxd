import { defineStore } from 'pinia'
import axios from 'axios'

export const useSelectedMediaStore = defineStore('selectedMedia', {
  state: () => ({
    selectedMedia: JSON.parse(localStorage.getItem('selectedMedia')) || null
  }),
  actions: {
    async selectMedia(id) {
      try {
        const res = await axios.get(`http://localhost:8000/api/media/${id}`)
        this.selectedMedia = res.data
        localStorage.setItem('selectedMedia', JSON.stringify(res.data))
        return res.data
      } catch (error) {
        console.error('Erro ao buscar mídia:', error.response?.data?.error || error.message)
        return false
      }
    },
    resetState(){
        this.selectedMedia = null;
        localStorage.removeItem('selectedMedia');
    }
  }
})
