import Http from "@/api/http";

const getAll = async () => {
  const { data } = await Http.get("/api/notes");

  return data;
};

const getOne = async (id) => {
  const { data } = await Http.get(`/api/notes/${id}`);

  return data;
};

const create = async (note) => {
  await Http.post("/api/notes", {
    note: note,
  });
};

const update = async (note, id) => {
  await Http.patch(`/api/notes/${id}`, {
    note: note,
  });
};

const deleteOne = async (id) => {
  const { data } = await Http.delete(`/api/notes/${id}`);

  return data;
};

export default { getAll, getOne, create, update, deleteOne };
