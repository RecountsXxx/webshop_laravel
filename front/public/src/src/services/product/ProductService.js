import { useNotification } from "@kyvg/vue3-notification";
import axios from 'axios';

class ProductService {
    constructor() {
        this.notification = useNotification();
    }

    addToBookmark(id, title, price, img) {
        localStorage.setItem(`bookmark_${id}`, JSON.stringify({ id, title, price, img }));
        this.notification.notify({
            title: "Added to bookmark 🎉",
            type: 'warn'
        });
    }

    getAllBookmark() {
        const products = [];
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key.startsWith('bookmark_')) {
                const product = JSON.parse(localStorage.getItem(key));
                products.push(product);
            }
        }
        console.log(products);
        return products;
    }

    deleteFromBookmark(id) {
        this.notification.notify({
            title: "Deleted from bookmark 🎉",
            type: 'warn'
        });
        localStorage.removeItem(`bookmark_${id}`);
    }

    addToCart(id, title, price, img, vendor_id, countInCart = 1) {
        if (!localStorage.getItem(`product_${id}`)) {
            localStorage.setItem(`product_${id}`, JSON.stringify({
                id,
                title,
                price,
                img,
                vendor_id,
                count: countInCart
            }));
            this.notification.notify({
                title: "Added to cart 🎉",
                type: 'warn'
            });
        } else {
            this.notification.notify({
                title: "This product already in cart 🎉",
                type: 'error'
            });
        }
    }

    getAllCart() {
        const products = [];
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key.startsWith('product_')) {
                const product = JSON.parse(localStorage.getItem(key));
                products.push(product);
            }
        }
        console.log(products);
        return products;
    }

    deleteFromCart(id) {
        this.notification.notify({
            title: "Deleted from cart 🎉",
            type: 'warn'
        });
        localStorage.removeItem(`product_${id}`);
    }

    async submitOrder(data) {
        try {
            await axios.post('http://localhost/api/make-order', data);
            this.notification.notify({
                title: "Order confirmed! 🎉",
                type: 'warn'
            });
        } catch (error) {
            console.error(error);
            this.notification.notify({
                title: error.response.data.message,
                type: 'error'
            });
        }
    }

    async addComment(data) {
        try {
            await axios.post('http://localhost/api/comments', data);
            this.notification.notify({
                title: "Comment added! 🎉",
                type: 'warn'
            });
        } catch (error) {
            console.error(error);
        }
    }

    async getProducts(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/products?page=${pageNumber}`);
            return response.data.data.products;
        } catch (error) {
            console.error(error);
            return [];
        }
    }

    async getFilteredProducts(data, pageNumber = 1) {
        try {
            const response = await axios.post(`http://localhost/api/filter/products?page=${pageNumber}`, data);
            return response.data.data.products;
        } catch (error) {
            console.error(error);
            return [];
        }
    }

    async getProduct(id) {
        try {
            const response = await axios.get(`http://localhost/api/products/${id}`);
            return response.data.data.product;
        } catch (error) {
            console.error(error);
            return null;
        }
    }
    getCartProductStatus(id){
        return localStorage.getItem('product_' + id);
    }
    getBookmarkProductStatus(id){
        return localStorage.getItem('bookmark_' + id);
    }
}

export default new ProductService();
