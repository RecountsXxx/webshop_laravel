import axios from 'axios';
import { useToast } from "vue-toastification";

class CategoryService {
    toast = useToast();

    async fetchCategories(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/admin/categories/?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            this.handleError(error, 'Error fetching categories');
        }
    }

    async addCategory(formData) {
        try {
            const response = await axios.post('http://localhost/api/admin/categories', formData);
            this.toast.info('Category successfully added!');
            return response.data.data.category;
        } catch (error) {
            this.handleError(error, 'Error adding category');
        }
    }

    async getCategory(id) {
        try {
            const response = await axios.get(`http://localhost/api/admin/categories/${id}`);
            return response.data.data.category;
        } catch (error) {
            this.handleError(error, 'Error getting category');
        }
    }

    async editCategory(formData, id) {
        try {
            await axios.post(`http://localhost/api/admin/categories/${id}`, formData);
            this.toast.info('Category successfully edited!');
        } catch (error) {
            this.handleError(error, 'Error editing category');
        }
    }

    async deleteCategory(categoryId) {
        try {
            await axios.delete(`http://localhost/api/admin/categories/${categoryId}`);
            this.toast.info('Category successfully deleted!');
        } catch (error) {
            this.handleError(error, 'Error deleting category');
        }
    }

    handleError(error, message) {
        console.error(`${message}:`, error);
        const errorMessage = error.response ? error.response.data.message : 'Internal server error';
        this.toast.error(errorMessage);
    }
}

export default new CategoryService();
