import axios from "axios";
import {
  getRefreshToken,
  getAccessToken,
  saveRefreshToken,
  saveAccessToken,
  clearTokens,
} from "../utils/auth-storage.util";
const Http = axios.create();

const refreshAccessToken = async (refreshToken) => {
  const { token, newRefreshToken } = await axios.post("/api/token/refresh", {
    refreshToken: refreshToken,
  });

  saveAccessToken(token);
  saveRefreshToken(newRefreshToken);

  return token;
};

Http.interceptors.request.use(
  async (config) => {
    const accessToken = getAccessToken();
    config.headers = {
      Authorization: `Bearer ${accessToken}`,
      Accept: "application/json",
      "Content-Type": "application/x-www-form-urlencoded",
    };
    return config;
  },
  (error) => {
    Promise.reject(error);
  }
);

Http.interceptors.response.use(
  (response) => {
    return response;
  },
  async function (error) {
    const originalRequest = error.config;
    const refreshToken = getRefreshToken();
    if (
      error.response.status === 401 &&
      !originalRequest._retry &&
      !!refreshToken
    ) {
      const accessToken = await refreshAccessToken(refreshToken);
      originalRequest._retry = true;
      axios.defaults.headers.common["Authorization"] = "Bearer " + accessToken;
      return Http(originalRequest);
    }

    clearTokens();
    //todo: fix using vuex and router
    window.location = "/login";
    return Promise.reject(error);
  }
);

export default Http;
