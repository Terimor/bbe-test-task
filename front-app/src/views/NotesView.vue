<template>
  <div>
    <table>
      <tr>
        <th>ID</th>
        <th>Note</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
      </tr>
      <tr v-for="note in notes" :key="note.id">
        <td>{{ note.id }}</td>
        <td>{{ note.note }}</td>
        <td>{{ note.createdDateTime }}</td>
        <td>{{ note.updatedDateTime }}</td>
        <td>
          <button @click="onEditClick(note.id)">Edit</button>
          <button @click="onDeleteClick(note.id)">Delete</button>
        </td>
      </tr>
    </table>
    <div>
      <button @click="onAddClick()">Add new</button>
    </div>
  </div>
</template>

<script>
import Api from "@/api";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

export default {
  name: "NotesCabinet",
  setup() {
    const notes = ref([]);
    const router = useRouter();

    onMounted(() => {
      loadNotes();
    });

    async function loadNotes() {
      const response = await Api.notes.getAll();
      notes.value = response.notes;
    }

    async function onEditClick(id) {
      await router.push(`/note/${id}`);
    }
    async function onAddClick() {
      await router.push(`/note`);
    }
    async function onDeleteClick(id) {
      await Api.notes.deleteOne(id);

      await loadNotes();
    }

    return {
      notes,
      onEditClick,
      onAddClick,
      onDeleteClick,
    };
  },
};
</script>

<style scoped></style>
