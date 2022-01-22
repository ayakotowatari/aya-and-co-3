<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogThankYou" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div v-if="$i18n.locale == 'ja'" class="dialog-title grey--text text--darken-4">{{user.name}}様</div>
                        <div v-else class="dialog-title grey--text text--darken-4">Dear {{user.name}},</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        {{$t('checkout.guest_signup')}}
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="toOrderSummary">{{$t('btn.summary')}}</v-btn>
                    <v-btn color="primary" text @click="backHome">{{$t('top_page')}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
    </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialogThankYou: Boolean,
        user: Object,
    },
    data: function(){
        return {
            
        }
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
        ...mapState([
          
        ])
    },
    methods: {
        toOrderSummary(){
            //ストライプを２度目にうまく読み込まないため変更
            // window.location.href='/member/summary';
            this.$router.push({name: 'order-summary'});
            this.$store.commit('setDialogThankYou', false);
            this.$store.commit('updateDisableContinue1', true);
            // this.$store.commit('setDisabled', false);
        },
        backHome(){
             //ストライプを２度目にうまく読み込まないため変更
            // window.location.href='/';
            this.$router.push({name: 'home'})
            this.$store.commit('setDialogThankYou', false);
            this.$store.commit('updateDisableContinue1', true);
            // this.$store.commit('setDisabled', false);
        }
        
    }


}
</script>

<style>

</style>