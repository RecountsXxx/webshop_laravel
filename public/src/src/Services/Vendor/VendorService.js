import axios from 'axios';


class VendorService {
    async getVendorPerId(id){
        let response = await axios.get('http://localhost/api/vendors/' + id)
        return response.data.data.vendor;
    }
    async getVendors(pageNumber = 1){
        let response = await axios.get('http://localhost/api/vendors?page='+ pageNumber)
        return response.data.data;
    }
    async getProductsVendor(id,pageNumber = 1){
        let response = await axios.get('http://localhost/api/vendor/products/'+id + '?page=' + pageNumber)
        return response.data.data.products;
    }
}

export default new VendorService();