<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogThankYouGuest" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div v-if="$i18n.locale == 'ja'" class="dialog-title grey--text text--darken-4">{{guest.name}}様</div>
                        <div v-else class="dialog-title grey--text text--darken-4">Dear {{guest.name}},</div>
                    </v-card-title>
                    <v-card-text v-html="$t('checkout.thank_guest')"></v-card-text>
                    <v-card-text>
                        {{$t('checkout.guest_signup')}}
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="toRegister">{{$t('btn.to_register')}}</v-btn>
                    <v-btn color="grey darken-2" text @click="backHome">{{$t('btn.top_page')}}</v-btn>
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
        dialogThankYouGuest: Boolean,
        guest: Object,
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
        toRegister(){
            // window.location.href="/guest-register"
            this.$router.push({name: 'guest-register'});
            this.$store.commit('setDialogThankYouGuest', false);
            this.$store.commit('updateDisableContinue1', true);
            // this.$store.commit('setDisabled', false);
        },
        backHome(){
            // window.location.href="/"
            this.$router.push({name: 'home'})
             this.$store.commit('setDialogThankYouGuest', false);
             this.$store.commit('updateDisableContinue1', true);
            // this.$store.commit('setDisabled', false);
        }
    }
}
</script>

<style>
.dialog-title{
  margin-bottom: 24px;
}


</style>