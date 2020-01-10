import Vue from 'vue'
import Router from 'vue-router'

/* Layout */
import Layout from '@/views/Shared/SiteLayout'

/* Rotas para os domínios */
import ProjectsRouter from './modules/ProjectsRouter'
import EmployeesRouter from './modules/EmployeesRouter'

Vue.use(Router)

export const constantRouterMap = [
  {
    path: '/',
    redirect: 'home',
    component: Layout,
    children: [
      {
        path: 'home',
        name: 'Home',
        component: () => import(/* webpackChunkName: "home", webpackPrefetch: true */ '@/views/Home.vue'),
        hidden: true
      },
      ProjectsRouter,
      EmployeesRouter
    ]
  }
]

export default new Router({
  mode: 'history', // require service support
  base: process.env.BASE_URL,
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRouterMap
})
