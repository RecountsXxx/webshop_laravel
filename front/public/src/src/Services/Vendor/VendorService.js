import axios from 'axios';


class VendorService{

    async getVendorPerId(id){
        const params={
            id:id
        }
        let response = await axios.get('http://localhost/api/vendors/' + id,{params})
        console.log(response);
        return response.data.data.vendor;
    }
    async getVendors(){
        let response = await axios.get('http://localhost/api/vendors')

        return response.data.data.vendors;
    }
    async getProductsVendor(id){
        const params={
            id:id
        }
        let response = await axios.get('http://localhost/api/vendor/products',{params})

        console.log(response);
        return response.data.data.products;
    }
}

export default new VendorService();