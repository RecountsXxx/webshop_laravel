import axios from 'axios';


class BrandService {

    async getBrandPerId(id){
        const params={
            id:id
        }
        let response = await axios.get('http://localhost/api/brands/' + id,{params})
        console.log(response);
        return response.data.data.brand;
    }
    async getBrands(){
        let response = await axios.get('http://localhost/api/brands')

        return response.data.data.brands;
    }
    async getProductsBrands(id){
        const params={
            id:id
        }
        let response = await axios.get('http://localhost/api/brand/products',{params})

        console.log(response);
        return response.data.data.products;
    }
}

export default new BrandService();