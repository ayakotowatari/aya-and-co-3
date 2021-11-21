import router from "../../router"

export const giftcard = {
    namespaced: true,

    state: {
        giftcard:[],
        orderedCards: [],
        items: [
            {name:"Happy Christmas", number:1, amount:''},
            {name:"Happy New Year", number:2, amount:''},
            {name: "Season's Greetings", number:3, amount:''}
        ],
        dialogOrderCard: false,
        allerror: [],
        
    },
    mutations: {
        // setGiftCard(state, payload){
        //     console.log('payload', payload)
        //     state.card.id = payload.number
        //     state.card.name = payload.name
        //     state.card.amount = payload.amount
            
        // },
        setGiftCard(state,payload){

            // console.log(payload)

            let card = payload
            let newQuantity = payload.amount
    
            let cardIndex = state.giftcard.findIndex(item => item.name === card.name);
            if(cardIndex !== -1){
                // let originalQuantity = state.card[cardIndex].amount
                state.giftcard[cardIndex].amount = newQuantity
                // state.cart[productInCartIndex].quantity++;
                state.giftcard = JSON.parse(JSON.stringify(state.giftcard));
                //return;
            }else{
                card.amount = newQuantity;
                state.giftcard.push(card);
            }

        },
        clearGiftCard(state,payload){

            // console.log(payload)

            let card = payload
            // let newQuantity = payload.amount
    
            let cardIndex = state.giftcard.findIndex(item => item.name === card.name);
            state.giftcard.splice(cardIndex, 1);

            let itemIndex = state.items.findIndex(item => item.name === card.name);
            state.items[itemIndex].amount = '';

        },
        clearCardDetails(state, payload){
            state.giftcard = payload
        },
        clearItemAmount(state){
            
            for(let i = 0; i < state.items.length; i++){
                state.items[i].amount = ''
            }
            
        },
        setOrderedCards(state, payload){
            state.orderedCards = payload
        },
        setDialogOrderCard(state, payload){
            state.dialogOrderCard = payload
        },
        setAllErrors(state, payload){
            state.allerror = payload
        },
        
    },

    getters: {

       

    },
    actions: {
        async storeCardDetails({commit}, payload){

            let allerror = {};

            // console.log('payload', payload);

            if(payload.giftcard.length > 0 && payload.courier !== "ヤマト運輸 宅急便"){

                await axios
                .post('/member/giftcard', {
                    card: payload.giftcard,
                    order_id: payload.order.id
                })
                .then(response => {
                    // console.log(response);
                    commit('clearCardDetails', [])
                    commit('clearItemAmount')
                   
                })
                .catch(error => {
                    allerror = error.response.data.errors
                    commit('setAllErrors', allerror)
                    console.log('error', allerror)
                })

            }else{
                commit('clearCardDetails', [])
                commit('clearItemAmount')
            }
            
        },
        
        clearAllErrors({commit}) {
            commit('updateAllErrors', []);
        },
        clearCoupon({commit}){
            commit('emptyCoupon');
        },
       
        async fetchCoupon({commit}, payload){

            let coupon = {};

            await axios
                .get('/admin/fetch-coupon/' + payload.id)
                .then(response => {
                    coupon = response.data.coupon;
                    commit('setAdminCoupon', coupon);
                })
                .catch(error => {
                    allerror = error.response.data.errors,
                    commit('setallErrors', allerror)
                })
        },

       
    }

}