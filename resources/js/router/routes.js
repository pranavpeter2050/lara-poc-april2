// Make sure name and path match, since they are being used to check route access.
export const routes = [
    {
        path: '/',
        // redirect: '/login'
        redirect: '/movie-vue'
    },
    {
        path: '/movie-vue',
        name: 'index-movies',
        component: () => import('./views/movies/index.vue')
    },
    {
        path: '/new-movie-vue',
        name: 'new-movie',
        component: () => import('./views/movies/edit.vue')
    },
    {
        path: '/edit-movie-vue/:id',
        name: 'edit-movie',
        component: () => import('./views/movies/edit.vue')
    },
]
