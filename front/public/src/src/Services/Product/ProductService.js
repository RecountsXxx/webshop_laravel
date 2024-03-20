import {useNotification} from "@kyvg/vue3-notification";
import axios from 'axios';

class ProductService{
    notification = useNotification()
    addToBookmark(id,title,price,img){
        localStorage.setItem('bookmark_' + id, JSON.stringify({ id: id, title: title, price: price, img: img }));
        this.notification.notify({
            title: "Added to bookmark 🎉",
            type:'warn'
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

    deleteFromBookmark(id){
        this.notification.notify({
            title: "Deleted from bookmark 🎉",
            type:'warn'
        });
        localStorage.removeItem('bookmark_' + id);
    }

    getBookmarkProductStatus(id){
        return localStorage.getItem('bookmark_' + id);
    }



    addToCart(id,title,price,img,vendor_id){
        localStorage.setItem('product_' + id, JSON.stringify({ id: id, title: title, price: price, img: img, vendor_id:vendor_id }));
        this.notification.notify({
            title: "Added to cart 🎉",
            type:'warn'
        });
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

    deleteFromCart(id){
        this.notification.notify({
            title: "Deleted from cart 🎉",
            type:'warn'
        });
        localStorage.removeItem('product_' + id);
    }

    getCartProductStatus(id){
        return localStorage.getItem('product_' + id);
    }

    async sumbitOrder(data){
        try{
            await axios.post('http://localhost/api/make-order',data);
            this.notification.notify({
                title: "Order confirmed! 🎉",
                type:'warn'
            });
        }catch (e){
            console.error(e);
        }

    }

    async addComment(data){
        try{
            await axios.post('http://localhost/api/comments',data);
            this.notification.notify({
                title: "Comment added! 🎉",
                type:'warn'
            });
        }catch (e){
            console.error(e);
        }
    }

    async getProducts(pageNumber = 1){
       let response = await axios.get('http://localhost/api/products?page='+pageNumber);

       console.log(response.data.data.products);
       return response.data.data.products;
    }

    async getProduct(id){
        let response = await axios.get('http://localhost/api/products/' + id);

        console.log(response.data.data.product);
        return response.data.data.product;
    }

}

export default new ProductService();