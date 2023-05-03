// Make sure name and path match, since they are being used to check route access.
export const routes = [
    {
        path: '/',
        redirect: '/login'
        // redirect: '/movie-vue'
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./views/account/login.vue')
    },
    {
        path: '/movies',
        name: 'index-movies',
        component: () => import('./views/movies/index.vue')
    },
    {
        path: '/new-movie',
        name: 'new-movie',
        component: () => import('./views/movies/edit.vue')
    },
    {
        path: '/edit-movie/:id',
        name: 'edit-movie',
        component: () => import('./views/movies/edit.vue')
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('./views/404error.vue')
    }
]
