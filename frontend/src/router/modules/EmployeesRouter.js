const EmployeesRouter = {
  path: '/employees/',
  component: () => import(/* webpackPrefetch: true */ '@/views/Shared/RouterRender.vue'),
  children: [
    {
      path: '/',
      name: 'EmployeeIndex',
      component: () => import(/* webpackChunkName: "employees", webpackPrefetch: true */ '@/views/Employees/Employees.vue')
    }
  ]
}

export default EmployeesRouter
