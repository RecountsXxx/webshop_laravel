import axios from "axios";
import {useToast} from "vue-toastification";


class JoinToVendorsService{
    toast = useToast();
    async fetchRequests(pageNumber = 1){
        try {
            const response = await axios.get('http://localhost/api/admin/join-to-vendors/?page=' + pageNumber);
            return response.data.data;
        } catch (error) {
            console.error('Error fetching requests:', error);
        }
    }
    async deleteRequest(id){
        try {
             await axios.delete('http://localhost/api/admin/join-to-vendors/' + id);
            this.toast.info('Request succesfully deleted!');
        } catch (error) {
            this.toast.error(error.request.data);
            console.error('Error deleting request:', error);
        }
    }

    async addToVendors(id){
        try {
            await axios.get('http://localhost/api/admin/add-to-vendors/' + id);
            this.toast.info('Requests succesfully approved!');
        } catch (error) {
            this.toast.error(error.request.data);
            console.error('Error deleting order:', error);
        }
    }
}

export default new JoinToVendorsService();