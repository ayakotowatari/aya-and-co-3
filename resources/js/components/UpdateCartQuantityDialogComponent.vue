<template>
    <v-container>
        <v-row justify="center">
            <v-dialog v-model="dialogUpdateCartQuantity" persistent max-width="320">
                <v-card>
                    <v-card-title class="dialog-title-14">
                        <div v-if="$i18n.locale == 'ja'">
                            {{cartItem.name}}({{cartItem.size}})の数量変更
                        </div>
                        <div v-else>
                            Change quantity of {{cartItem.name}}({{cartItem.size}})
                        </div>
                    </v-card-title>
                    <v-card-subtitle v-if="cartItem.inventory <= 5">
                        <v-card-text class="jp-font-400">
                            {{$t('product.inventory')}}：{{inventory}}
                        </v-card-text>
                    </v-card-subtitle>
                    <v-card-text class="jp-font-400">
                        <v-row>
                            <v-col cols="8" sm="8" md="8">
                                <v-select
                                    v-model="selectedQuantity"
                                    :items="selectableNumbers"
                                    :label="$t('product.select_qty')"
                                    required
                                >
                                </v-select>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="changeQuantity">{{$t('btn.update2')}}</v-btn>
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
        dialogUpdateCartQuantity: Boolean,
        selectableNumbers: Array
    },
    data: function(){
        return {
            selectedQuantity: null,
        }
    },
    mounted(){
      
    },
    created(){

    },
    computed: {
        ...mapState([
            'cartItem',
            'inventory',
        ])
    },
    methods: {
        ...mapActions([

        ]),
        changeQuantity(){
            let quantity = this.selectedQuantity
            let cartItem = this.cartItem
            this.$store.commit('changeCartQuantity', {quantity, cartItem})
        },
        back(){
            this.$store.commit('setDialogUpdateCartQuantity', false)
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