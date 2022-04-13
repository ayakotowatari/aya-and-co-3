<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogDeleteUser" persistent max-width="320">
                <v-card>
                    <v-card-title >
                        <div class="dialog-title primary--text">{{ $t('edit.account') }}</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        <p>
                            {{ $t('edit.delete.line1') }}
                        </p>
                        <p>
                            {{ $t('edit.delete.line2') }}
                        </p>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="toDelete">{{ $t('edit.delete.btn') }}</v-btn>
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
        dialogDeleteUser: Boolean,
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
            'deleteUser',
        ]),
        toDelete(){
            
            this.deleteUser({
                id: this.user.id
            })
            
        },
        back(){
            this.$store.commit('setDialogDeleteUser', false);
        }
        
    }


}
</script>

<style>
.dialog-title{
  margin-bottom: 24px;
}


</style>