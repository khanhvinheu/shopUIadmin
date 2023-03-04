const state = {
    cart: [],
    toast: {
        text: "",
        show: false
    }
};
const mutations = {
    setUpProducts: (state, productsPayload) => {
        //sets the state's  products property to the products array recieved as payload
        // state.products = productsPayload;
    },
    addToCart: (state, product) => {

        // find the product in the products list
        // let product = state.products.find((product) => product.id === productId);
        // //find the product in the cart list
        let cartProduct = state.cart.find((productel) => productel.id === product.id);
        //
        if (cartProduct) {
            //product already present in the cart. so increase the quantity
            cartProduct.quantity++;
        } else {
            state.cart.push({
                // product newly added to cart
                ...product,
                stock: product.quantity,
                quantity: 1,
            });
        }
        //reduce the quantity in products list by 1
        product.quantity--;
    },
    removeFromCart: (state, productId) => {
        // //find the product in the products list
        // let product = state.products.find((product) => product.id === productId);
        // //find the product in the cart list
        // let cartProduct = state.cart.find((product) => product.id === productId);
        //
        // cartProduct.quantity--;
        // //Add back the quantity in products list by 1
        // product.quantity++;
    },
    deleteFromCart: (state, productId) => {
        // //find the product in the products list
        // let product = state.products.find((product) => product.id === productId);
        // //find the product index in the cart list
        // let cartProductIndex = state.cart.findIndex((product) => product.id === productId);
        // //srt back the quantity of the product to intial quantity
        // product.quantity = state.cart[cartProductIndex].stock;
        // // remove the product from the cart
        // state.cart.splice(cartProductIndex, 1);
    },
    showToast: (state, toastText) => {
        state.toast.show = true;
        state.toast.text = toastText;
    },
    hideToast: (state) => {
        state.toast.show = false;
        state.toast.text = "";
    }
};

const actions = {
    addToCart: ({ commit }, productId) => {
        // myApi.products("add", productId).then((productId) => {
            commit("addToCart", productId);
            commit("showToast", "added to cart");
        // });
    },
    removeFromCart: ({ commit }, productId) => {
        // myApi.products("remove", productId).then((productId) => {
            commit("removeFromCart", productId);
            commit("showToast", "removed from cart");
        // });
    },
    deleteFromCart: ({ commit }, productId) => {
        // myApi.products("delete", productId).then((productId) => {
            commit("deleteFromCart", productId);
            commit("showToast", "deleted from cart");
        // });

    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
};
