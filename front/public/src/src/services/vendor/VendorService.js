import axios from 'axios';

class VendorService {
    async getVendorPerId(id) {
        try {
            const response = await axios.get(`http://localhost/api/vendors/${id}`);
            return response.data.data.vendor;
        } catch (error) {
            console.error('Error fetching vendor by ID:', error);
            return null;
        }
    }

    async getVendors(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/vendors?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            console.error('Error fetching vendors:', error);
            return null;
        }
    }

    async getProductsVendor(id, pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/vendor/products/${id}?page=${pageNumber}`);
            return response.data.data.products;
        } catch (error) {
            console.error('Error fetching vendor products:', error);
            return null;
        }
    }
}

export default new VendorService();
