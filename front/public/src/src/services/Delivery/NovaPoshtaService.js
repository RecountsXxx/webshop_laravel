import axios from 'axios';

const API_KEY = '3dfb257c40701bae50404047a37cf3a7';
const API_URL = 'https://api.novaposhta.ua/v2.0/json/';

class NovaPoshtaService{
    async getCities() {
        try {
            const response = await axios.post(API_URL, {
                apiKey: API_KEY,
                modelName: 'Address',
                calledMethod: 'getCities',
                methodProperties: {}
            });
            console.log(response.data);
            return response.data;
        } catch (error) {
            throw new Error('Failed to fetch cities from Nova Poshta API');
        }
    }

    async getWarehouses(cityRef) {
        try {
            const response = await axios.post(API_URL, {
                apiKey: API_KEY,
                modelName: 'AddressGeneral',
                calledMethod: 'getWarehouses',
                methodProperties: { CityRef: cityRef }
            });
            return response.data;
        } catch (error) {
            throw new Error('Failed to fetch warehouses from Nova Poshta API');
        }
    }
}

export default new NovaPoshtaService();
