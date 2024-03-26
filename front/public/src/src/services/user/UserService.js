import axios from 'axios';
import { useNotification } from "@kyvg/vue3-notification";

class UserService {
    constructor() {
        this.notification = useNotification();
    }

    getUser() {
        const userString = localStorage.getItem('user');
        return userString ? JSON.parse(userString).user : null;
    }

    saveUser(user) {
        localStorage.setItem('user', JSON.stringify(user));
    }

    async loggout() {
        try {
            const token = JSON.parse(localStorage.getItem('user')).authorisation.token;
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.removeItem('user');
            await axios.get('/api/auth/logout');
            window.location.assign('/');
        } catch (error) {
            this.handleError(error, 'Error logging out');
        }
    }

    async register(name, email, password) {
        try {
            const response = await axios.post('/api/auth/register', {
                name,
                email,
                password,
            });
            this.notification.notify({
                title: "Registration successful 🎉",
                type: 'warn'
            });
            console.log(response);
        } catch (error) {
            this.handleError(error, 'Error registering');
        }
    }

    async login(email, password) {
        try {
            const response = await axios.post('/api/auth/login', {
                email,
                password,
            });
            this.notification.notify({
                title: "Login successful 🎉",
                type: 'warn'
            });
            this.saveUser(response.data.data);
            window.location.assign('/');
        } catch (error) {
            console.error(error);
            this.notification.notify({
                title: "Invalid login or password",
                type: 'error'
            });
        }
    }

    async joinToVendor(data) {
        try {
            await axios.post(`http://localhost/api/join-to-vendors`, data);
            this.notification.notify({
                title: 'Form has been sent!',
                type: 'info'
            });
        } catch (error) {
            this.handleError(error, 'Error sending form');
        }
    }

    handleError(error, message) {
        console.error(`${message}:`, error);
        const errorMessage = error.response ? error.response.data.message : 'Internal server error';
        this.notification.notify({
            title: errorMessage,
            type: 'error'
        });
    }
}

export default new UserService();
