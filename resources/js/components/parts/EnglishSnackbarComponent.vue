<template>
    <v-snackbar
        v-model="englishSnackbar"
        :vertical="vertical"
        :timeout = "timeout"
        >
        {{ message }}

        <template v-slot:action="{ attrs }">
            <v-btn
            text
            v-bind="attrs"
            @click="$store.commit('language/setEnglishSnackbar', false)"
            >
            {{$t('btn.close')}}
            </v-btn>
        </template>
    </v-snackbar>
</template>
<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {

    },
    data: function(){
        return {
            message: "Good news! You can now place an order in English on our website for delivery in Japan. We are in the process of translation and some pages and functions are still in Japanese only. Please bear with us for another few weeks before we complete the process! Thank you for your patience.",
            vertical: true,
            timeout: -1,
            // timeout: 5000,
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState('language', [
            'englishSnackbar'
        ])
    
    },
    methods: {
      

        
    }


}
</script>

<style>

</style>