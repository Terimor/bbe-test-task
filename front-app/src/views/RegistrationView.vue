<template>
  <div>
    <h1>REGISTRATION</h1>
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
import { useRouter } from "vue-router";

export default {
  name: "RegistrationView",
  setup() {
    const router = useRouter();

    const email = ref(null);
    const password = ref(null);

    async function onSubmit() {
      try {
        await Api.auth.register(email.value, password.value);

        await router.push("/login");
      } catch (error) {
        alert(error);
      }
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
