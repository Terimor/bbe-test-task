<template>
  <h5>Note:</h5>
  <div><textarea v-model="noteText" /></div>
  <div><button @click="onSubmitClick()">Submit</button></div>
</template>

<script>
import { useRoute, useRouter } from "vue-router";
import { onMounted, ref } from "vue";
import Api from "@/api";

export default {
  name: "NoteView",
  setup() {
    const route = useRoute();
    const router = useRouter();

    const { id } = route.params;
    const noteText = ref("");

    onMounted(async () => {
      if (id) {
        const { note } = await Api.notes.getOne(id);

        noteText.value = note.note;
      }
    });

    async function onSubmitClick() {
      if (id) {
        await Api.notes.update(noteText.value, id);
      } else {
        await Api.notes.create(noteText.value);
      }

      await router.push("/notes");
    }

    return {
      noteText,
      onSubmitClick,
    };
  },
};
</script>

<style scoped></style>
