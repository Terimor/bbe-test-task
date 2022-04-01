<template>
  <div>
    <h1>LOGIN</h1>
    <div>
      <div>
        <input type="email" placeholder="Abc.." v-model="email" />
      </div>
      <div>
        <input type="password" v-model="password" />
      </div>
      <div>
        <button @click="onSubmit">Login</button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import Api from "@/api";
import { saveAccessToken, saveRefreshToken } from "@/utils/auth-storage.util";
import { useRouter } from "vue-router";

export default {
  name: "LoginView",
  setup() {
    const router = useRouter();

    const email = ref(null);
    const password = ref(null);

    async function onSubmit() {
      const { token, refreshToken } = await Api.auth.login(
        email.value,
        password.value
      );

      saveAccessToken(token);
      saveRefreshToken(refreshToken);

      await router.push("/notes");
    }

    return {
      email,
      password,
      onSubmit,
    };
  },
};
</script>

<style scoped></style>
