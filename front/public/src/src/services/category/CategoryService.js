import axios from 'axios';


class CategoryService {
    async getCategoryPerId(id){
        let response = await axios.get('http://localhost/api/categories/' + id)
        return response.data.data.category;
    }
    async getCategories(pageNumber = 1){
        let response = await axios.get('http://localhost/api/categories?page='+ pageNumber)
        return response.data.data;
    }
    async getProductsCategory(id,pageNumber = 1){
        let response = await axios.get('http://localhost/api/category/products/'+id + '?page=' + pageNumber);
        return response.data.data.products;
    }
}

export default new CategoryService();