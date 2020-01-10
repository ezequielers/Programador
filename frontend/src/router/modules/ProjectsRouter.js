const ProjectsRouter = {
  path: '/projects/',
  component: () => import(/* webpackPrefetch: true */ '@/views/Shared/RouterRender.vue'),
  children: [
    {
      path: '/',
      name: 'ProjectIndex',
      component: () => import(/* webpackChunkName: "projects", webpackPrefetch: true */ '@/views/Projects/Projects.vue')
    },
    {
      path: 'employees/:idProject',
      name: 'ProjectEmployee',
      component: () => import(/* webpackChunkName: "project-employee", webpackPrefetch: true */ '@/views/Projects/ProjectEmployee.vue')
    }
  ]
}

export default ProjectsRouter
