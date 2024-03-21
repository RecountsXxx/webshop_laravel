import axios from 'axios';


class BrandService {
    async getBrandPerId(id){
        let response = await axios.get('http://localhost/api/brands/' + id)
        return response.data.data.brand;
    }
    async getBrands(pageNumber = 1){
        let response = await axios.get('http://localhost/api/brands?page='+ pageNumber)
        return response.data.data;
    }
    async getProductsBrands(id, pageNumber = 1){
        let response = await axios.get('http://localhost/api/brand/products/'+id + '?page='+pageNumber)
        return response.data.data.products;
    }
}

export default new BrandService();