import axios from 'axios';

class BrandService {
    async getBrandPerId(id) {
        try {
            const response = await axios.get(`http://localhost/api/brands/${id}`);
            return response.data.data.brand;
        } catch (error) {
            console.error('Error fetching brand by ID:', error);
            throw error;
        }
    }

    async getBrands(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/brands?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            console.error('Error fetching brands:', error);
            throw error;
        }
    }

    async getProductsBrands(id, pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/brand/products/${id}?page=${pageNumber}`);
            return response.data.data.products;
        } catch (error) {
            console.error('Error fetching products by brand ID:', error);
            throw error;
        }
    }
}

export default new BrandService();
