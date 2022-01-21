<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogLinkSent" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title grey--text text--darken-4">{{$t('reset.title')}}</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        {{$t('reset.line1')}}
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                        {{$t('reset.line2')}}
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                        {{$t('reset.line3')}}
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="toLogin">{{$t('btn.login')}}</v-btn>
                    <v-btn text @click="toHome">{{$t('btn.top_page')}}</v-btn>
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
        dialogLinkSent: Boolean,
        // guest: Object,
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
        toLogin(){
            this.$router.push({name: 'login'});
            // this.$store.commit('setDialogThankYouGuest', false);
            // this.$store.commit('updateDisableContinue1', true);
            // this.$store.commit('setDisabled', false);
        },
        // backHome(){
        //     this.$router.push({name: 'home'})
        //      this.$store.commit('setDialogThankYouGuest', false);
        //      this.$store.commit('updateDisableContinue1', true);
        //     this.$store.commit('setDisabled', false);
        // }
        toHome(){
            window.location = "/"
        }
        
    }


}
</script>

<style>
.dialog-title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  margin-bottom: 24px;
}


</style>