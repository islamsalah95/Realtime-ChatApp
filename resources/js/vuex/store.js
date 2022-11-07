import { createApp } from "vue";
import { createStore } from "vuex";

// Create a new store instance.
const store = createStore({
    state: {
        name: "",
        token: "",
        id:localStorage.getItem('userId')
    },
    getters: {
      isAuthenticated(state) {
          return !!state.token;
        },
        username(state) {
            return state.name ;
        },
    },
    mutations: {
      setuser(state, payload) {
          state.token = payload.token;
          state.name = payload.name;
      },
  },
    actions: {
        register(context, payload) {
            const data = {
                name: payload.name,
                email: payload.email,
                password: payload.password,
                password_confirmation: payload.password_confirmation,
                image: payload.image,

            };

            axios
                .post("http://127.0.0.1:8000/api/register", data)
                .then((response) => {
                    console.log(response);
                    localStorage.setItem(
                        "token",
                        response.data.data.user.token
                    );
                    localStorage.setItem("name", response.data.data.user.name);
                    context.commit[
                        ("setuser",
                        {
                            token: response.data.data.user.token,
                            name: response.data.data.user.name,
                        })
                    ];
                })
                .catch((error) => console.log(error));
        },
        login(context, payload) {
            const data = {
                email: payload.email,
                password: payload.password,
            };

            axios
                .post("http://127.0.0.1:8000/api/login", data)
                .then((response) => {
                    console.log(response.data.data.user);
                    localStorage.setItem(
                        "token",
                        response.data.data.user.token
                    );
                    localStorage.setItem("name", response.data.data.user.name);
                    localStorage.setItem("userId", response.data.data.user.id);
                    localStorage.setItem("image", response.data.data.user.image);

                    context.commit[
                        ("setuser",
                        {
                            token: response.data.data.user.token,
                            name: response.data.data.user.name,
                        })
                    ];
                })
                .catch((error) => console.log(error));
        },

        logout(context) {
            axios
                .get("http://127.0.0.1:8000/api/logout")
                .then((response) => {
                    console.log(response.data);
                    localStorage.removeItem("token");
                    localStorage.removeItem("name");
                    localStorage.removeItem("userId");
                    
                    context.commit[
                        ("setuser",
                        {
                            token: "",
                            name: "",
                        })
                    ];
                  })
                .catch((error) => console.log(error));
        },
    },
});

export default store;
const app = createApp({
    /* your root component */
});

// Install the store instance as a plugin
app.use(store);
