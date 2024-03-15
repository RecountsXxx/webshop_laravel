import axios from 'axios';
import { useToast } from "vue-toastification";

class UserService {
    toast = useToast();

    async fetchUsers(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/admin/users/?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            this.handleError(error, 'Error fetching users');
        }
    }

    async addUser(formData) {
        try {
            const response = await axios.post('http://localhost/api/admin/users', formData);
            this.toast.info('User successfully added!');
            return response.data.data.user;
        } catch (error) {
            this.handleError(error, 'Error adding user');
        }
    }

    async getUser(id) {
        try {
            const response = await axios.get(`http://localhost/api/admin/users/${id}`);
            return response.data.data.user;
        } catch (error) {
            this.handleError(error, 'Error getting user');
        }
    }

    async editUser(formData, id) {
        try {
            await axios.put(`http://localhost/api/admin/users/${id}`, formData);
            this.toast.info('User successfully edited!');
        } catch (error) {
            this.handleError(error, 'Error editing user');
        }
    }

    async deleteUser(userId) {
        try {
            await axios.delete(`http://localhost/api/admin/users/${userId}`);
            this.toast.info('User successfully deleted!');
        } catch (error) {
            this.handleError(error, 'Error deleting user');
        }
    }

    handleError(error, message) {
        console.error(`${message}:`, error);
        const errorMessage = error.response ? error.response.data.message : 'Internal server error';
        this.toast.error(errorMessage);
    }
}

export default new UserService();
