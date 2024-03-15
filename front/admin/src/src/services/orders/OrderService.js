import axios from "axios";
import {useToast} from "vue-toastification";


class OrderService{
    toast = useToast();
    async fetchOrders(pageNumber = 1){
        try {
            const response = await axios.get('http://localhost/api/admin/orders/?page=' + pageNumber);
            return response.data.data;
        } catch (error) {
            this.toast.error(error.request.data);
            console.error('Error fetching orders:', error);
        }
    }
    async deleteOrder(id){
        try {
             await axios.delete('http://localhost/api/admin/orders/' + id);
            this.toast.info('Order succesfully deleted!');
        } catch (error) {
            this.toast.error(error.request.data);
            console.error('Error deleting order:', error);
        }
    }
}

export default new OrderService();