import axios from 'axios';
import { useNotification } from "@kyvg/vue3-notification";
class UserService {
    notification = useNotification()
    getUser() {
        const userString = localStorage.getItem('user');
        if (userString) {
            return JSON.parse(userString);
        } else {
            return null;
        }
    }
    saveUser(user) {
        localStorage.setItem('user', JSON.stringify(user));
    }

    async register(name,email,password){
        try{
            let response = await axios.post('/api/auth/register',{
                name:name,
                email:email,
                password:password,
            });
            this.notification.notify({
                title: "Register successfull 🎉",
                type:'warn'
            });
            console.log(response);
        }catch(error){
            this.notification.notify({
                title: error.request.response,
                type:'error'
            });
        }
    }
    async login(email,password){
        try{
            let response = await axios.post('/api/auth/login',{
                email:email,
                password:password,
            });
            this.notification.notify({
                title: "Login successfull 🎉",
                type:'warn'
            });
            this.saveUser(response.data.data.user);
        }catch(error){
            console.error(error);
            this.notification.notify({
                title: "Invalid login or password",
                type:'error'
            });
        }
    }
}

export default new UserService();
