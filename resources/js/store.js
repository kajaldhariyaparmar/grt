let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');
let adminCost = window.localStorage.getItem('adminCost');
import Vue from 'vue'
import Vuex from 'vuex'
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';

Vue.use(VueTelInput);
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        // cart: cart ? JSON.parse(cart) : '',
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
        adminCost: adminCost ? (adminCost === 'true') : false,
    },
    mutations: {
        adminCost(admincoststate, admincost) {
            admincoststate.adminCost = admincost;
            this.commit('saveAdminCost');
        },
        addToCart(state, item) {
            const insert = JSON.parse(JSON.stringify(item));
            state.cart.push(insert);
            Vue.set(insert, 'quantity', 1);
            Vue.set(insert, 'totalPrice', insert.amount);
            state.cartCount++;
            this.commit('saveCart');
        },
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);
            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;
                state.cart.splice(index, 1);
            }
            this.commit('saveCart');
        },
        //HTML5 localstorage
        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },
        saveAdminCost(admincoststate) {
            window.localStorage.setItem('adminCost', admincoststate.adminCost);
        }

    }
})