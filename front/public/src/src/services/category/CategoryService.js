import axios from 'axios';

class CategoryService {
    async getCategoryPerId(id) {
        try {
            const response = await axios.get(`http://localhost/api/categories/${id}`);
            return response.data.data.category;
        } catch (error) {
            console.error('Error fetching category by ID:', error);
            throw error;
        }
    }

    async getCategories(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/categories?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            console.error('Error fetching categories:', error);
            throw error;
        }
    }

    async getProductsCategory(id, pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/category/products/${id}?page=${pageNumber}`);
            return response.data.data.products;
        } catch (error) {
            console.error('Error fetching products by category ID:', error);
            throw error;
        }
    }
}

export default new CategoryService();
