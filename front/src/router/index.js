import { createWebHistory, createRouter } from "vue-router";
const routes = [
    {
        path: "/",
        name: "index",
        component: () => import("@/views/IndexPage.vue"),
    },
    {
        path: "/movies",
        name: "movies",
        component: () => import("@/views/MoviesPage.vue"),
    },
    {
        path: "/movies/:id",
        name: "showMovieDetails",
        component: () => import("@/views/MovieDetailPage.vue"),
    },
    {
        path: "/:catchAll(.*)",
        name: "notFound",
        component: () => import("@/views/NotFoundPage.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// router.beforeEach((to, from, next) => {
//     const isAuthenticatedRoute = to.matched.some(
//         record => record.meta.requiresAuth
//     );
//     const isAuthSectionRoute = to.matched.some(record => record.meta.handleAuth);
//
//     if (isAuthenticatedRoute && !authService.hasToken()) {
//         next({ name: 'Auth' });
//         return;
//     }
//
//     if (isAuthSectionRoute && authService.hasToken()) {
//         next({ name: 'UserSelfProfile' });
//         return;
//     }
//
//     next({ path: to });
// });

export default router;