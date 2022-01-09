import router from "../../router"

export const language = {
    namespaced: true,

    state: {
        
        allerror: [],
        
    },
    mutations: {
        
    },

    getters: {

       

    },
    actions: {
       
        async setLang({commit}, payload){

            let allerror = {};
            let newLang='';

            // console.log('payload', payload);

            await axios
            .post('/lang', {
                lang: payload.lang,
            })
            .then(response => {
                // newLang = response.data.lang;
                // console.log('newLang', newLang);
                
            })
            .catch(error => {
                allerror = error.response.data.errors
                commit('setAllErrors', allerror)
                //console.log('error', allerror)
            })
        
        },
       
    }

}