
<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogRemoveCartItem" persistent max-width="320">
                <v-card>
                    <v-card-title class="dialog-title-14">
                        {{cartItem.name}}<span v-if="cartItem.slug !=='marmalade-loaf'">({{cartItem.size}})</span>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        {{$t('product.remove')}}
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="remove(cartItem)">{{$t('btn.remove2')}}</v-btn>
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
        dialogRemoveCartItem: Boolean,
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
            'cartItem',
        ])
    },
    methods: {
        ...mapActions([

        ]),
        remove(value){
            //console.log('value', value);
            let cartItem = value
            this.$store.commit('removeCartItem', cartItem)
        },
        back(){
            this.$store.commit('setDialogRemoveCartItem', false)
        }
        
    }


}
</script>

<style scoped>
.v-dialog>.v-card>.v-card__title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  margin-bottom: 24px;
}


</style>