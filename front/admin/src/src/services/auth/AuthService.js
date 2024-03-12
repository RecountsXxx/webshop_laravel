import axios from "axios";
import {userStore} from "@/stores/store";
import {useNotification} from "@kyvg/vue3-notification";

class AuthService{
    notification = useNotification()
    async login(email,password) {
        try {
            const response = await axios.post('http://localhost/api/admin/auth/login', {
                email: email,
                password: password
            });
            axios.interceptors.request.use(config => {
                const token = response.data.data.authorisation.token;
                config.headers.Authorization = `Bearer ${token}`;
                return config;
            });
            const store = userStore();
            store.set({name:response.data.data.user.name, email: response.data.data.user.email, token: response.data.data.authorisation.token});

        } catch (error) {
            this.notification.notify({
                title: "Invalid login or password",
                type:'error'
            });
            console.error('Error:', error);
        }
    }
}

export default new AuthService();