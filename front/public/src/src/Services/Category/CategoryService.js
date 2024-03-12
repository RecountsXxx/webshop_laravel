import axios from 'axios';


class CategoryService {

    async getCategoryPerId(id){
        const params={
            id:id
        }
        let response = await axios.get('http://localhost/api/categories/' + id,{params})
        console.log(response);
        return response.data.data.category;
    }
    async getCategories(){
        let response = await axios.get('http://localhost/api/categories')

        return response.data.data.categories;
    }
    async getProductsCategory(id){
        const params={
            id:id
        }
        let response = await axios.get('http://localhost/api/category/products',{params})

        console.log(response);
        return response.data.data.products;
    }
}

export default new CategoryService();