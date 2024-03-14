import axios from 'axios';
import { useToast } from "vue-toastification";
class ProductService {
    toast = useToast();
    async fetchProducts(pageNumber = 1) {
        try {
            const response = await axios.get('http://localhost/api/admin/products/?page=' + pageNumber);
            console.log(pageNumber + '- page - ');
            console.log(response);
            return response.data.data;
        } catch (error) {
            this.toast.error(error.request.data);
            console.error('Error fetching products:', error);
        }
    }

    async addProduct(formData) {
        try {
            let response = await axios.post('http://localhost/api/admin/products', formData);
            console.log(response);
            this.toast.info('Product succesfully added!');
        } catch (error) {
            this.toast.error(JSON.stringify(error.response.data.message));
            console.error('Error adding product:', error);
        }
    }

    async getProduct(id) {
        try {
            let response = await axios.get('http://localhost/api/admin/products/' + id);
            console.log(response);
            return response.data.data.product;

        } catch (error) {
            this.toast.error('Error!');
            console.error('Error getting product:', error);
        }
    }

    async editProduct(formData, id) {
        try {
            console.log(formData);
            let response = await axios.put('http://localhost/api/admin/products/' + id, formData);
            console.log(response);
            this.toast.info('Product succesfully edited!');
        } catch (error) {
            console.log(error.response.data)
            this.toast.error(JSON.stringify(error.response.data.message));
            console.error('Error editing product:', error);
        }
    }

    async deleteProduct(productId) {
        try {
            await axios.delete('http://localhost/api/admin/products/' + productId);
            this.toast.info('Product succesfully deleted!');
        } catch (error) {
            this.toast.error('Error!');
            console.error('Error deleting product:', error);
        }
    }

    async deleteImage(productId){
        try {
            await axios.delete('http://localhost/api/admin/products/delete-image/' + productId);
            this.toast.info('Image succesfully deleted!');
        } catch (error) {
            this.toast.error('Error!');
            console.error('Error deleting product:', error);
        }
    }

}

export default new ProductService();
