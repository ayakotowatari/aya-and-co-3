<template>
    <v-container>
        <newaddressdialog-component
            v-bind:dialogNewAddress="dialogNewAddress"
        ></newaddressdialog-component>
        <removeaddressdialog-component
            v-bind:dialogRemoveAddress="dialogRemoveAddress"
            v-bind:address="address"
        ></removeaddressdialog-component>
        <div v-if="otherAddresses.length >= 1">
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <h4 :class="fontWeightClasses" class="grey--text text--darken-3 mb24">{{$t('otheraddress.lead')}}</h4>
                    <div class="grey--text text--darken-2 mb24">{{$t('otheraddress.note')}}</div>
                    <v-item-group v-model="addressGroup" mandatory>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-item v-slot="{active, toggle}" v-for="address in otherAddresses" :key="address.id" :value='address'>
                                    <v-card
                                        elevation = "2"
                                        :color = "active ? '#F9D9D9' : '#ffffff'"
                                        class="mx-auto mb-6"
                                        outlined
                                        @click="toggle"
                                        max-width=560
                                    >   
                                        <v-row align="center">
                                        <v-col cols="9" sm="9" md="9">
                                            <v-list-item three-line>
                                            <v-list-item-content>
                                                <div class="space">
                                                    {{address.prefecture}} {{address.city}} {{address.address_1}}
                                                </div>
                                                <div class="space" v-if="address.building !== null">
                                                    {{address.building}}
                                                </div>
                                                <div class="space">
                                                    {{address.name}}<span v-if="$i18n.locale == 'ja'">様</span>
                                                </div>
                                            </v-list-item-content>
                                            </v-list-item>
                                        </v-col>

                                        <v-col cols="12" sm="12" md="3">
                                        <v-card-actions>
                                            <v-btn
                                                rounded
                                                outlined
                                                color="grey darken-1"
                                                @click.stop="remove(address)"
                                            >
                                                {{$t('btn.remove')}}
                                            </v-btn>
                                        </v-card-actions>
                                        </v-col>
                                        </v-row>
                                    </v-card>
                                </v-item>
                            </v-col>
                        </v-row>
                    </v-item-group>
                    <v-btn
                        color="primary"
                        block
                        :disabled="disabled.confirmOtherAddress"
                        @click="confirmAddress"
                        class="mb24"
                    >
                        {{$t('btn.send')}}
                    </v-btn>
                    <!-- <v-form v-if="otherAddresses !== null">
                        <v-radio-group v-model="radioGroup">
                            <template v-slot:label>
                                <div>登録されたご自宅以外の住所</div>
                            </template>
                            <v-radio
                                v-for="address in otherAddresses" :key="address.id"
                                :label="`${address.prefecture} ${address.city} ${address.address_1} ${address.name}様`"
                                :value="address" 
                                class="jp-font grey--text text--darken-4 mb-3"
                            ></v-radio>
                        </v-radio-group>
                        <v-btn
                            block
                            @click="select"
                        >
                            この住所に送る   
                        </v-btn>
                    </v-form> -->
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="jp-font-400 grey--text text--darken-2 mb24">{{$t('otheraddress.ask')}}</div>
                    <v-btn
                        color="primary"
                        outlined
                        :disabled="disabled.addNewAddress"
                        @click="newAddress"
                    >
                        {{$t('btn.add_address')}}
                    </v-btn>
                </v-col>
            </v-row>
        </div>
        <div v-if="otherAddresses.length <= 0">
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <p>{{$t('otheraddress.no_data')}}</p>
                </v-col>
            </v-row>
            <v-row>
            <v-col cols="12" sm="12" md="12">
                <v-btn
                    color="primary"
                    outlined
    
                    @click="newAddress"
                >
                    {{$t('btn.add_address')}}
                </v-btn>
            </v-col>
            </v-row>
        </div>
    </v-container>
</template>

<script>
import { mapState, mapActions} from 'vuex';

export default {
    props: {
        
    },
    data: function(){
        return {
            addressGroup: null,
            address: {}
        }
    },
    watch: {
        
    },
    mounted(){
        this.$store.dispatch('fetchOtherAddresses');
    },
    created(){
        
    },
    computed: {
        ...mapState([
            'user',
            'allerror',
            'otherAddresses',
            'dialogNewAddress',
            'dialogRemoveAddress',
            'disabled',
            // 'selectCard',
        ]),
        fontWeightClasses(){
          if(this.$i18n.locale == 'en') return 'en-jp-font'
          return 'jp-font'
        },
    
    },
    methods: {
        ...mapActions([
            'confirmOtherAddress',
            'selectAddress',
        ]),
        // ...mapMutations({
        //     select: 'selectAddress',
        // }),
        // select(){
        //     this.selectAddress({
        //         address: this.radioGroup
        //     })
        // },
        remove(value){

            this.address = value;

            this.$store.dispatch('dialogRemoveAddress', true)

        },
        // select(){
        //     this.selectAddress({
        //         address: this.addressGroup,
        //         delivery_time: this.deliveryTime,
        //         delivery_cardmessage: this.deliveryCardMessage,
        //         delivery_cardname: this.deliveryCardName,
        //         delivery_carduse: this.deliveryCardUse
        //     })
        // },
        confirmAddress(){
            //console.log('address', this.addressGroup)
            this.confirmOtherAddress({
                address: this.addressGroup,
                home_address: false
            })
        },
        newAddress(){
            this.$store.dispatch('dialogNewAddress', true);
        },

        // reset(){
        //     this.$refs.form.reset();
        //     this.$store.commit('setDisabled', false);
        //     this.$store.commit('updateDisableContinue1', true);
        // }
        // select(value){
        //     console.log(value);

        //     this.selectAddress({
        //         id: value
        //     })
        // }
    }       
}
</script>

<style>

</style>