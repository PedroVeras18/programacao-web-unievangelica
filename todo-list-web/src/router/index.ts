import { createRouter, createWebHistory } from 'vue-router'

import TodoList from '../pages/to-do-list.vue'
import Form from '../pages/form.vue'
import Home from '../pages/home.vue'

const routes = [
  { path: '/todo-list', component: TodoList },
  { path: '/pratica-01', component: Form },
  { path: '/', name: 'home', component: Home }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
