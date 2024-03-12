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



    addToCart(id,title,price,img){
        localStorage.setItem('product_' + id, JSON.stringify({ id: id, title: title, price: price, img: img }));
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

    async getProducts(){
       let response = await axios.get('http://localhost/api/products');

       console.log(response.data.data.products);
       return response.data.data.products;
    }

    async getProduct(id){
        const params={
            id:id
        }
        let response = await axios.get('http://localhost/api/products/' + id,{params});

        console.log(response.data.data.product);
        return response.data.data.product;
    }

}

export default new ProductService();