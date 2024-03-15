import axios from 'axios';
import { useToast } from "vue-toastification";

class BrandService {
    toast = useToast();

    async fetchBrands(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/admin/brands/?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            this.handleError(error, 'Error fetching categories');
        }
    }

    async addBrand(formData) {
        try {
            const response = await axios.post('http://localhost/api/admin/brands', formData);
            this.toast.info('Brand successfully added!');
            return response.data.data.brand;
        } catch (error) {
            this.handleError(error, 'Error adding brand');
        }
    }

    async getBrand(id) {
        try {
            const response = await axios.get(`http://localhost/api/admin/brands/${id}`);
            return response.data.data.brand;
        } catch (error) {
            this.handleError(error, 'Error getting brand');
        }
    }

    async editBrand(formData, id) {
        try {
            await axios.post(`http://localhost/api/admin/brands/${id}`, formData);
            this.toast.info('Brand successfully edited!');
        } catch (error) {
            this.handleError(error, 'Error editing brand');
        }
    }

    async deleteBrand(categoryId) {
        try {
            await axios.delete(`http://localhost/api/admin/brands/${categoryId}`);
            this.toast.info('Brand successfully deleted!');
        } catch (error) {
            this.handleError(error, 'Error deleting brand');
        }
    }

    handleError(error, message) {
        console.error(`${message}:`, error);
        const errorMessage = error.response ? error.response.data.message : 'Internal server error';
        this.toast.error(errorMessage);
    }
}

export default new BrandService();
