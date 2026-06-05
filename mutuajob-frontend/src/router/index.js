import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/LoginView.vue'
import AdminView from '../views/AdminView.vue'
import TrabajadorView from '../views/TrabajadorView.vue'
import EmpleadorView from '../views/EmpleadorView.vue'

const routes = [
    {
        path: '/',
        redirect: '/login'
    },
    {
        path: '/login',
        component: LoginView
    },
    {
        path: '/admin',
        component: AdminView,
        meta: { requiresAuth: true }
    },
    {
        path: '/trabajador',
        component: TrabajadorView,
        meta: { requiresAuth: true }
    },
    {
        path: '/empleador',
        component: EmpleadorView,
        meta: { requiresAuth: true }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')

    if (to.meta.requiresAuth && !token) {
        next('/login')
    } else {
        next()
    }
})

export default router