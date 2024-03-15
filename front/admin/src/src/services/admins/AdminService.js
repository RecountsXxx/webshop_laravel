import axios from 'axios';
import { useToast } from "vue-toastification";

class AdminService {
    toast = useToast();

    async fetchAdmins(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/admin/admins/?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            this.handleError(error, 'Error fetching admin');
        }
    }

    async addAdmin(formData) {
        try {
            const response = await axios.post('http://localhost/api/admin/admins', formData);
            this.toast.info('Admin successfully added!');
            return response.data.data.user;
        } catch (error) {
            this.handleError(error, 'Error adding admin');
        }
    }

    async getAdmin(id) {
        try {
            const response = await axios.get(`http://localhost/api/admin/admins/${id}`);
            return response.data.data.admin;
        } catch (error) {
            this.handleError(error, 'Error getting admin');
        }
    }

    async editAdmin(formData, id) {
        try {
            await axios.put(`http://localhost/api/admin/admins/${id}`, formData);
            this.toast.info('Admin successfully edited!');
        } catch (error) {
            this.handleError(error, 'Error editing admin');
        }
    }

    async deleteAdmin(userId) {
        try {
            await axios.delete(`http://localhost/api/admin/admins/${userId}`);
            this.toast.info('Admin successfully deleted!');
        } catch (error) {
            this.handleError(error, 'Error deleting admin');
        }
    }

    handleError(error, message) {
        console.error(`${message}:`, error);
        const errorMessage = error.response ? error.response.data.message : 'Internal server error';
        this.toast.error(errorMessage);
    }
}

export default new AdminService();
