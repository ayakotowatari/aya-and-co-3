<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogRemoveAddress" persistent max-width="320">
                <v-card>
                    <v-card-title>
                        {{$t('otheraddress.remove')}}
                    </v-card-title>
                    <v-card-text>
                        〒{{address.zipcode}} <br>
                        {{address.prefecture}} {{address.city}} {{address.address_1}} <br>
                        {{address.name}}<span v-if="$i18n.locale == 'ja'">様</span>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="remove(address)">{{$t('btn.remove2')}}</v-btn>
                    <v-btn color="grey darken-2" text @click="back">{{$t('btn.back')}}</v-btn>
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
        dialogRemoveAddress: Boolean,
        address: Object,
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

        ]),
        remove(value){
            //console.log('value', value);
            let removedAddress = value
            this.$store.dispatch('removeAddress', removedAddress)
        },
        back(){
            this.$store.dispatch('dialogRemoveAddress', false)
        }
        
    }


}
</script>

<style>
.dialog-title{
  margin-bottom: 24px;
}

.v-card__text, .v-card__title {
  word-break: normal; /* maybe !important  */
}


</style>