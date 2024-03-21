// store/index.js
import { createPinia } from 'pinia';

const store = createPinia();

export const useCartStore = () => {
    return store;
};
