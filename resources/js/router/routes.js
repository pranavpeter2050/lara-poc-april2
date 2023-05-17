export const routes = [
    {
        path: '/',
        redirect: '/login'
        // redirect: '/movie-vue'
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('./views/account/login.vue'),
        meta: {
            guest: true
        }
    },
    {
        path: '/logout',
        name: 'logout',
        component: () => import('./views/account/logout.vue'),
        meta: {
            guest: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('./views/account/register.vue'),
        meta: {
            guest: true
        }
    },
    {
        path: '/movies',
        name: 'index-movies',
        component: () => import('./views/movies/index.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/new-movie',
        name: 'new-movie',
        component: () => import('./views/movies/edit.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/edit-movie/:id',
        name: 'edit-movie',
        component: () => import('./views/movies/edit.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import('./views/404error.vue'),
        meta: {
            requiresAuth: true
        }
    }
]
