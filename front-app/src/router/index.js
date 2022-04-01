import { createRouter, createWebHistory } from "vue-router";
import { getAccessToken } from "../utils/auth-storage.util";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      redirect: "/notes",
    },
    {
      path: "/notes",
      name: "Notes",
      component: () => import("../views/NotesView.vue"),
    },
    {
      path: "/note/:id?",
      name: "Note",
      component: () => import("../views/NoteView.vue"),
    },
    {
      path: "/login",
      name: "Login",
      component: () => import("../views/LoginView.vue"),
    },
    {
      path: "/registration",
      name: "Registration",
      component: () => import("../views/RegistrationView.vue"),
    },
  ],
});

// router.beforeEach((to, from, next) => {
//   const isAuthorized = !!getAccessToken();
//   if (to.name !== "Login" && !isAuthorized) {
//     return next(`/login?redirect=${to.path}`);
//   } else if (isAuthorized) {
//     next(from.path);
//   }
//   next();
// });

export default router;
