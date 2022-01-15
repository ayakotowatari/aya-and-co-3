<template>
<v-app>
    <v-main :class="$i18n.locale">
        <navbar-component
            v-bind:user='user'
        ></navbar-component>
        <v-container>
            <router-view
                :key="$route.path"
                v-bind:user='user'
                v-bind:deliveryAddress='deliveryAddress'
                class="mb56"
            ></router-view>
        </v-container>
    </v-main>
    <footer-component></footer-component>
</v-app>
</template>

<script>
import { mapState } from 'vuex'

export default {
    data: function(){
        return {

            
        }
    },
    mounted(){
        this.$store.dispatch('fetchUser');
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'user',
            'deliveryAddress',
        ])
    
    },
    methods: {
      
        
    }

}
</script>

<style>
.en{
    line-height: 1.5;
    font-family: quasimoda, sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    letter-spacing: 0.03em;
    color: rgba(0, 0, 0, 0.6)
}
.ja{
    line-height: 1.5;
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    letter-spacing: 0.03em;
    color: rgba(0, 0, 0, 0.6)
}
.mb56{
    margin-bottom: 56px;
}

</style>