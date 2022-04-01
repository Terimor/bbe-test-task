const TOKEN_STORAGE_KEY = "token";
const REFRESH_TOKEN_STORAGE_KEY = "refreshToken";

const saveAccessToken = (token) => {
  if (token) {
    localStorage.setItem(TOKEN_STORAGE_KEY, token);
  }
};

const getAccessToken = () => {
  return localStorage.getItem(TOKEN_STORAGE_KEY);
};

const saveRefreshToken = (token) => {
  if (token) {
    localStorage.setItem(REFRESH_TOKEN_STORAGE_KEY, token);
  }
};

const getRefreshToken = () => {
  return localStorage.getItem(REFRESH_TOKEN_STORAGE_KEY);
};

const clearTokens = () => {
  localStorage.removeItem(REFRESH_TOKEN_STORAGE_KEY);
  localStorage.removeItem(TOKEN_STORAGE_KEY);
};

export {
  saveAccessToken,
  getAccessToken,
  saveRefreshToken,
  getRefreshToken,
  clearTokens,
};
