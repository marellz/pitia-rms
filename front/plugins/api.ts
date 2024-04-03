import axios from "axios";

export default defineNuxtPlugin(() => {
  const config = useRuntimeConfig();
  const baseURL = config.public.API_URL;

  const api = axios.create({
    baseURL,
    timeout: 60000,
    withCredentials: true,
    withXSRFToken: true,
    xsrfCookieName: "XSRF-TOKEN",
    xsrfHeaderName: "X-XSRF-TOKEN",
    headers: {
      common: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    },
  });


  api.interceptors.request.use(
    function (config) {
      // todo: get token from vue and use
      return config;
    },
    function (error) {
      // Do something with request error
      return Promise.reject(error);
    }
  );

  api.interceptors.response.use(
    function (response) {
      return response.data;
    },
    function (error) {
      // todo: handle errors, somwehow
      return Promise.reject(error);
    }
  );

  return {
    provide: {
      api: api,
    },
  };
});
