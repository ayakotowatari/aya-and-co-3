<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogUnsubscribe" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title primary--text">{{ $t('edit.subscription.subscription') }}</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        <p>
                            {{ $t('edit.subscription.line3') }}
                        </p>
                        <p>
                            {{ $t('edit.subscription.line4') }}
                        </p>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="unsubscribe">{{ $t('edit.subscription.stop')}}</v-btn>
                    <v-btn color="grey darken-2" text @click="back">{{ $t('btn.back') }}</v-btn>
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
        dialogUnsubscribe: Boolean,
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
        ...mapActions([
            'unsubscribeEmails',
        ]),
        unsubscribe(){
            
            this.unsubscribeEmails()
            
        },
        back(){
            this.$store.commit('setDialogUnsubscribe', false);
        }
        
    }


}
</script>

<style>
.dialog-title{
  margin-bottom: 24px;
}


</style>