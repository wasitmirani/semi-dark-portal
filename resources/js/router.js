import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { path: '/', component: require('./components/dashboard/DashboardComponent.vue').default },
    { path: '/all/users', component: require('./components/user/UserComponent.vue').default },
     { path: '/all/roles', component: require('./components/role/RoleComponent.vue').default },
]


// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes // short for `routes: routes`
})


export default router;
