<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogNewAddress" 
                max-width=560
            >
                <v-card>
                    <v-container>
                    <v-row justify="center" v-if="user !== null">
                        <v-col cols="12" sm="12" md="8">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <div :class="formTitleClasses" class="rey--text text--darken-4 mt48 mb48">{{$t('otheraddress.add')}}</div>
                                        </v-col>
                                    </v-row>
                                    <v-form
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                    >
                                        <v-text-field
                                            v-model="name"
                                            :label="$t('register.name')"
                                            outlined
                                            required
                                            :rules="nameRules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error="allerror.name ? true : false"
                                            :error-messages="allerror.name"
                                            class="text-title"
                                        ></v-text-field>
                                        <v-text-field
                                            v-if="$i18n.locale == 'ja'"
                                            v-model="kana"
                                            :label="$t('register.kana')"
                                            outlined
                                            required
                                            :rules="kanaRules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error="allerror.kana ? true : false"
                                            :error-messages="allerror.kana"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="zipcode"
                                            :label="$t('register.zipcode')"
                                            outlined
                                            required
                                            :hint="$t('register.hint_zipcode')"
                                            persistent-hint
                                            :rules="zipcodeRules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error="allerror.zipcode ? true : false"
                                            :error-messages="allerror.zipcode"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="state"
                                            :label="$t('register.prefecture')"
                                            outlined
                                            required
                                            :rules="prefectureRules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error="allerror.prefecture ? true : false"
                                            :error-messages="allerror.prefecture"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="city"
                                            :label="$t('register.city')"
                                            outlined
                                            required
                                            :rules="cityRules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error="allerror.city ? true : false"
                                            :error-messages="allerror.city"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="address1"
                                            :label="$t('register.address1')"
                                            outlined
                                            required
                                            :rules="address1Rules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error="allerror.address_1 ? true : false"
                                            :error-messages="allerror.address_1"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="building"
                                            :label="$t('register.building')"
                                            outlined
                                            :error="allerror.building ? true : false"
                                            :error-messages="allerror.building"
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="phone"
                                            :label="$t('register.phone')"
                                            outlined
                                            required
                                            :rules="phoneRules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error="allerror.phone ? true : false"
                                            :error-messages="allerror.phone"
                                        ></v-text-field>
                                        <!-- <v-select
                                            v-model="deliveryTime"
                                            :items = "items"
                                            label="ご希望の配達時間帯"
                                            outlined
                                            required
                                        ></v-select> -->
                                        <v-row class="mb48">
                                            <v-col cols="6" sm="6" md="6">
                                                <v-btn
                                                    color="primary"
                                                    block
                                                    darken
                                                    @click="add"
                                                    class="mb24"
                                                >
                                                {{$t('btn.add')}}
                                                </v-btn>
                                            </v-col>
                                            
                                            <v-col cols="6" sm="6" md="6">
                                                <div class="link">
                                                    <v-btn
                                                        color="primary"
                                                        block
                                                        outlined
                                                        @click="back"
                                                    >
                                                        {{$t('btn.back')}}
                                                    </v-btn>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                    </v-container>
                </v-card>
            
        </v-dialog>
    </v-row>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialogNewAddress: Boolean,
    },
    data: function(){
        return {
            valid: true,
            name: '',
            kana: '',
            zipcode: '',
            state: '',
            city: '',
            address1: '',
            building: '',
            phone: '',
            // deliveryTime: '',
            // items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
        }
    },
    watch: {
        zipcode: function(val){
            if(7 != val.length){
                return;
            }

            let self = this;
            let lang = "";
            //言語
            if(this.$i18n.locale == "en"){
                lang = "rome";
            }else{
                lang = "ja";
            }
            //自サイトのAPI
            let url = "/ajax/zipcode/" + val + "/" + lang;

            axios
            .get(url)
            .then(res => {
                self.state = res.data.pref;
                self.city = res.data.address;
                // self.address1 = res.data.town;
            })
        }
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
         ...mapState([
            'allerror',
            'user',
        ]),
        formTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-form-title'
          return 'form-title'
        },
        nameRules(){
            return[
                v => !!v || this.$t('register.name_rule')
            ];
        },
        kanaRules() {
            return [
                v => !!v || this.$t('register.kana_rule')
            ];
        },
        zipcodeRules() {
            return [
                v => !!v || this.$t('register.zipcode_rule'),
                v => v.length == 7 || this.$t('register.hint_zipcode')
            ];
        },
        prefectureRules() {
            return [
                v => !!v || this.$t('register.prefecture_rule')
            ];
        },
        cityRules() {
            return [
                v => !!v || this.$t('register.city_rule')
            ];
        },
        address1Rules() {
            return [
                v => !!v || this.$t('register.address1_rule')
            ];
        },
        phoneRules() {
            return [
                v => !!v || this.$t('register.phone_rule')
            ];
        },
    },
    methods: {
        ...mapActions([
            'addOtherAddress',
        ]),
        add(){

            if(this.$refs.form.validate()){
                this.addOtherAddress({
                    name: this.name,
                    kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                    // delivery_time: this.deliveryTime
                })
            }
           
        },
        back(){
            this.$store.dispatch("dialogNewAddress", false);
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

.jp-font-400-18{
  font-family: 'Noto Sans JP', sans-serif;
  letter-spacing: 0.03em;
  font-size: 18px;
}


</style>