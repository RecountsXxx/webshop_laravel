import axios from 'axios';
class ProductService{

    async fetchProducts(){
        let response = await axios.get('http://localhost/api/admin/products');

        console.log(response.data.data.products);
        return response.data.data.products;
    }

    //addProduct(title,description,image,price,vendor_id,brand_id,category_id){
    //}


    deleteProduct(productId){
        console.log(productId);
    }
}

export default new ProductService();