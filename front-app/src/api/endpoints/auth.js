import axios from "axios";

const login = async (email, password) => {
  const { data } = await axios.post("/api/token/login", {
    email: email,
    password: password,
  });

  console.log(data);

  return data;
};

const register = (email, password) => {
  axios.post("/api/register", {
    email: email,
    password: password,
  });
};

export default { login, register };
