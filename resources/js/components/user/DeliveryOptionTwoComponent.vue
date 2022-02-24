<template>
    <div class="pt-6">
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div :class="formTitleClasses" class="grey--text text--darken-4">{{$t('checkout.shipping_method')}}</div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                 <v-form 
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <div class="mb-8">
                        <div :class="fontWeightClasses" class="grey--text text--darken-3 mb24">Step 1: {{$t('checkout.select_shipping')}}</div>
                        <div class="grey--text text--darken-2 mb24">{{$t('checkout.shipping_note1')}}<router-link to="/postage">{{$t('checkout.shipping_note2')}}</router-link>{{$t('checkout.shipping_note3')}}</div>

                         <v-select
                            v-model="courier"
                            outlined
                            :items = "courierOptions"
                            :item-text="setItem()"
                            item-value="id"
                            :label="$t('checkout.shipping_label')"
                            required
                            :rules="courierRules" 
                            validate-on-blur
                            @blur="() => $refs.form.resetValidation()"
                            :error="allerror.couriers ? true : false"
                            :error-messages="allerror.couriers"
                        ></v-select>
                    </div>

                    <v-divider class="mt-4 mb-8"></v-divider>
                    <div class="mb-8">
                        <div :class="fontWeightClasses" class="grey--text text--darken-3 mb24">Step 2: {{$t('customcard.lead')}}</div>
                        <div v-if="this.courier === null">
                            <div class="grey--text text--darken-2">{{$t('customcard.line1')}}</div>
                        </div>
                        <div v-if="this.courier !== null">
                            <div v-if="this.courier === 3">
                                <div class="jp-font grey--text text--darken-2 mb24">{{$t('customcard.line2')}}</div>
                                <!-- <seasoncard-component></seasoncard-component> -->
                            </div>
                            <div v-if="this.courier !== 3">
                                <div class="grey--text text--darken-2 mb24">{{$t('customcard.line3')}}</div>
                                <div class="grey--text text--darken-2 mb24">{{$t('customcard.line4')}}</div>
                                <v-select
                                    v-model="deliveryCardUse"
                                    outlined
                                    :items="$t('customcard.use_option')"
                                    :label="$t('customcard.label')"
                                    required
                                    class="mb24"
                                    :rules="deliveryCardUseRules" 
                                    validate-on-blur
                                    @blur="() => $refs.form.resetValidation()"
                                    :error="allerror.delivery_carduse"
                                    :error-messages="allerror.delivery_carduse"
                                ></v-select>
                                <div v-if="this.deliveryCardUse == $t('customcard.use')">
                                    <div class="grey--text text--darken-3 mb24">{{$t('customcard.line5')}}</div>
                                    <v-select
                                        v-model="deliveryCardMessage"
                                        outlined
                                        :items = "cards"
                                        :label="$t('customcard.select_message')"
                                        required
                                        class="mb48"
                                        :rules="deliveryCardMessageRules" 
                                        validate-on-blur
                                        @blur="() => $refs.form.resetValidation()"
                                        :error="allerror.delivery_cardmessage"
                                        :error-messages="allerror.delivery_cardmessage"
                                    ></v-select>
                                </div>
                                <div v-if="$i18n.locale == 'ja' && this.deliveryCardUse == $t('customcard.use')">
                                    <div class="jp-font grey--text text--darken-3 mb24">カードの差出人として、どちらを記載しますか？</div>
                                    <v-select
                                        v-model= "sender"
                                        outlined
                                        :items = "senders"
                                        label="差出人の名前を指定する"
                                        required
                                        class="mb48"
                                        :rules="senderRules" 
                                    ></v-select>
                                    <div v-if="this.sender === 'ご自身のお名前'">
                                        <div class="jp-font grey--text text--darken-3 mb24">カードの差出人として、あなたのお名前をどのように表記しますか？</div>
                                        <v-select
                                            v-model="deliveryCardName"
                                            outlined
                                            :items = "displayName"
                                            label="表記を選択"
                                            required
                                            class="mb48"
                                            :rules="deliveryCardNameRules" 
                                        ></v-select>
                                        <div class="jp-font grey--text text--darken-3 mb24">ギフトカード作成にあたってのご留意事項</div>
                                        <div class="jp-font grey--text text--darken-2 mb24">
                                            <p>ギフトカードの差出人のお名前は、ご登録いただいているフリガナにもとづいて、英字で表記されます。</p>
                                            <p>例1：　Hanako Shirai（姓・名両方表記の場合）</p>
                                            <p>例2：　Hanako（下のお名前のみの場合）</p>
                                            <p>お客様のお名前のフリガナは下記で登録されています。</p>
                                            <p>{{user.kana}}　様</p>
                                            <p>万一、フリガナに誤りがある場合は、メニューの「アカウント情報の編集」にて、修正を行なってから、ギフトカードをご注文ください。</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <v-divider class="mt-4 mb-8"></v-divider>
                    <h4 class="jp-font grey--text text--darken-3 mb24">Step 3: {{$t('checkout.delivery_time')}}</h4>
                    <v-select
                        v-model="deliveryTime"
                        :items="$t('checkout.time_options')"
                        :label="$t('checkout.delivery_label')"
                        outlined
                        required
                        :rules="deliveryTimeRules" 
                        validate-on-blur
                        @blur="() => $refs.form.resetValidation()"
                        :error="allerror.delivery_time"
                        :error-messages="allerror.delivery_time"
                    ></v-select>
                    <v-divider class="mt-4 mb-8"></v-divider>
                    <h4 class="jp-font grey--text text--darken-3 mb24">Step 4: {{$t('checkout.note')}}</h4>
                    <v-textarea
                        v-model="deliveryNote"
                        :label="$t('checkout.note')"
                        outlined
                        rows="3"
                        :error="allerror.message? true : false"
                        :error-messages="allerror.message"
                    ></v-textarea>
                    <v-btn
                        color="primary"
                        block
                        @click="confirm"
                        :disabled="disabled.confirmDeliveryOption"
                        class="mb-6"
                    >
                    {{$t('btn.confirm')}}
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
               
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        deliveryAddress: Object
    },
    data: function(){
        
        return {
            valid: true,
            courier: null,
            deliveryTime: '',
            // items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
            cards: ["Thank You", "Happy Birthday", "Take Care", "Get Well Soon", "With Love", 'Sending You a Hug'],
            deliveryCardUse: '',
            deliveryCardMessage: '',
            sender: null,
            senders:["ご自身のお名前", "aya & co."],
            senderRules: [
                v => !!v || '差出人を選択してください。',
            ],
            deliveryCardName: '',
            displayName: ['姓・名両方', '名（ファーストネーム）のみ'],
            deliveryCardNameRules: [
                v => !!v || 'お名前の表記方法を選択してください。',
            ],
            deliveryNote: ''
        }
    },
    mounted(){
      
    },
    created(){
        this.$store.dispatch('fetchPostages'),
        this.$store.dispatch('fetchStates');
    },
    computed: {
        ...mapState([
            'allerror',
            'user',
            'disabled',
            'postages',
            'couriers', 
            'cart'
        ]),
        formTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-form-title'
          return 'form-title'
        },
        fontWeightClasses(){
          if(this.$i18n.locale == 'en') return 'en-jp-font'
          return 'jp-font'
        },
        courierRules(){
            return[
                v => !!v || this.$t('checkout.courier_rule')
            ];
        },
        deliveryCardUseRules(){ 
            return [
                v => !!v || this.$t('customcard.carduse_rule')
            ];
        },
        deliveryCardMessageRules(){ 
            return [
                v => !!v || this.$t('customcard.cardmessage_rule')
            ];
        },
        deliveryTimeRules(){
            return[
                v => !!v || this.$t('checkout.deliveryTime_rule')
            ];
        },
        totalQuantityInCart(){
           
            let setInCart = this.cart.filter(cart => cart.if_set === 1);
            let setInCartQuantity = setInCart.reduce((acc,item) => acc + item.quantity, 0);
            let setTotalQuantity = setInCartQuantity * 2;

            // console.log('setTotal', setTotalQuantity);

            let itemInCart = this.cart.filter(cart => cart.if_set === 0);
            // console.log('itemInCart', itemInCart)
            let itemInCart100 = itemInCart.filter(cart => cart.size === "100g")
            let itemInCart100Quantity = (itemInCart100.reduce((acc,item) => acc + item.quantity, 0))*1;
            let itemInCart150 = itemInCart.filter(cart => cart.size === "150g")
            // console.log('cart150', itemInCart150);
            let itemInCart150Quantity = (itemInCart150.reduce((acc,item) => acc + item.quantity, 0))*2.5;
            let itemInCart250 = itemInCart.filter(cart => cart.size === "250g")
            let itemInCart250Quantity = (itemInCart250.reduce((acc,item) => acc + item.quantity, 0))*2.5;
            // let itemInCartQuantity = itemInCart.reduce((acc,item) => acc + item.quantity, 0);
            // console.log('100', itemInCart100Quantity)
            // console.log('150', itemInCart150Quantity)
            // console.log('250', itemInCart250Quantity)

            let totalInCartQuantity = setTotalQuantity + itemInCart100Quantity + itemInCart150Quantity + itemInCart250Quantity;
            // console.log('result', totalInCartQuantity);

            return totalInCartQuantity;

        },
        courierOptions(){
            let itemInCart150 = this.cart.filter(cart => cart.size === "150g")
            // console.log('150', itemInCart150)
            if(itemInCart150.length > 0){
                if(this.totalQuantityInCart > 15){
                    return this.couriers.filter(courier => courier.id === 2)
                }else{
                    return this.couriers.filter(courier => courier.id === 1)
                }
            }else{
                if(this.totalQuantityInCart > 15){
                    return this.couriers.filter(courier => courier.id !== 1)
                }else{
                    return this.couriers.filter(courier => courier.id !== 2)
                }
            }
        },
    },
    methods: {
        ...mapActions([
            'setDeliveryOption',
            'setPostage',
        ]),
        setItem(){
            if(this.$i18n.locale == 'ja'){
                return item => item.name + ' ' + item.type
            }else{
                return item => item.name_en + ' ' + item.type_en
            }
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        confirm(){

            console.log('courier1', this.courier)

            if(this.$refs.form.validate()){

                // this.$store.dispatch('setPostage', this.courier);
                this.setPostage({
                    // lang: this.$i18n.locale,
                    lang: this.user.lang,
                    courier: this.courier,
                    prefecture: this.deliveryAddress.prefecture,
                    totalQuantity: this.totalQuantityInCart
                })

                if(this.courier == 3){
                        this.setDeliveryOption({
                            delivery_time: this.deliveryTime,
                            delivery_carduse: this.$t('customcard.nouse'),
                            delivery_cardmessage: '',
                            delivery_cardname: '',
                            delivery_note: this.deliveryNote,
                        })
                }else if(this.deliveryCardUse == this.$t('customcard.use')){
                    if(this.sender == 'ご自身のお名前'){
                        this.setDeliveryOption({
                            delivery_time: this.deliveryTime,
                            delivery_carduse: this.deliveryCardUse,
                            delivery_cardmessage: this.deliveryCardMessage,
                            delivery_cardname: this.deliveryCardName,
                            delivery_note: this.deliveryNote
                        })
                    }else{
                        this.setDeliveryOption({
                            delivery_time: this.deliveryTime,
                            delivery_carduse: this.deliveryCardUse,
                            delivery_cardmessage: this.deliveryCardMessage,
                            delivery_cardname: this.$t('customcard.card_name'),
                            delivery_note: this.deliveryNote
                        })
                    }
                }else{
                    this.setDeliveryOption({
                        delivery_time: this.deliveryTime,
                        delivery_carduse: this.deliveryCardUse,
                        delivery_cardmessage: '',
                        delivery_cardname: '',
                        delivery_note: this.deliveryNote
                    })
                }
               
            }
        }
    }       
}
</script>

<style>
.jp-font-400{
  font-family: 'Noto Sans JP', sans-serif;
  letter-spacing: 0.03em;
}

.mb48{
    margin-bottom: 48px;
}

</style>