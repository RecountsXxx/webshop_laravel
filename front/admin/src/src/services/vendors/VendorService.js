import axios from 'axios';
import { useToast } from "vue-toastification";

class VendorService {
    toast = useToast();

    async fetchVendors(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/admin/vendors/?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            this.handleError(error, 'Error fetching vendors');
        }
    }

    async addVendor(formData) {
        try {
            const response = await axios.post('http://localhost/api/admin/vendors', formData);
            this.toast.info('Vendor successfully added!');
            return response.data.data.vendor;
        } catch (error) {
            this.handleError(error, 'Error adding vendor');
        }
    }

    async getVendor(id) {
        try {
            const response = await axios.get(`http://localhost/api/admin/vendors/${id}`);
            return response.data.data.vendor;
        } catch (error) {
            this.handleError(error, 'Error getting vendor');
        }
    }

    async editVendor(formData, id) {
        try {
            await axios.post(`http://localhost/api/admin/vendors/${id}`, formData);
            this.toast.info('Vendor successfully edited!');
        } catch (error) {
            this.handleError(error, 'Error editing vendor');
        }
    }

    async deleteVendor(categoryId) {
        try {
            await axios.delete(`http://localhost/api/admin/vendors/${categoryId}`);
            this.toast.info('Vendor successfully deleted!');
        } catch (error) {
            this.handleError(error, 'Error deleting vendor');
        }
    }

    handleError(error, message) {
        console.error(`${message}:`, error);
        const errorMessage = error.response ? error.response.data.message : 'Internal server error';
        this.toast.error(errorMessage);
    }
}

export default new VendorService();
