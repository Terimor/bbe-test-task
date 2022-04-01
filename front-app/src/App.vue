<template>
  <div class="nav">
    <RouterLink to="/notes">Notes</RouterLink>
    <RouterLink to="/login">Login</RouterLink>
    <RouterLink to="/registration">Registration</RouterLink>
    <a @click="onLogoutClick()" href="#">Logout</a>
  </div>

  <RouterView />
</template>

<script>
import { clearTokens } from "./utils/auth-storage.util";
import { useRouter } from "vue-router";

export default {
  name: "App",
  setup() {
    const router = useRouter();

    function onLogoutClick() {
      clearTokens();

      router.push("/login");
    }

    return {
      onLogoutClick,
    };
  },
};
</script>

<style>
.nav > * {
  margin-right: 10px;
}
</style>
