<template>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div 
                    v-if="$i18n.locale=='en'" 
                    :class="fontWeightClasses" 
                    class="mb24"
                >
                    {{$t('checkout.home_address')}}
                </div>
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
                    <v-text-field
                        v-model="email"
                        :label="$t('register.email')"
                        outlined
                        required
                        :rules="emailRules"
                        validate-on-blur
                        @blur="() => $refs.form.resetValidation()"
                        :error="allerror.email ? true : false"
                        :error-messages="allerror.email"
                    ></v-text-field>
                    <v-text-field
                        v-model="confirmEmail"
                        :label="$t('register.confirm_email')"
                        outlined
                        required
                        :rules="confirmEmailRules" 
                        validate-on-blur
                        @blur="() => $refs.form.resetValidation()"
                        :error="allerror.email ? true : false"
                        :error-messages="allerror.email"
                    ></v-text-field>
                    <v-btn
                        block
                        @click="add"
                        color="primary"
                        class="mb-6"
                        :disabled="disabled.guestHomeAddress"
                    >
                    {{$t('btn.send')}}
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        
    },
    data: function(){
        
        return {
            valid: true,
            type: '',
            name: '',
            kana: '',
            zipcode: '',
            state: '',
            city: '',
            address1: '',
            building: '',
            phone: '',
            email: '',
            confirmEmail: '',
            // items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
        }
    },
    watch: {
        zipcode: function(val){
            if(7 != val.length){
                return
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
            'disabled',
        ]),
        fontWeightClasses(){
          if(this.$i18n.locale == 'en') return 'en-jp-font'
          return 'jp-font'
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
        emailRules() {
            return [
                (v) => !!v || this.$t('register.email_rule'),
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || this.$t('register.email_rule2')
            ];
        },
        confirmEmailRules() {
            return [
                (v) => !!v || this.$t('register.confirmEmail_rule'),
                (v) => v == this.email || this.$t('register.confirmEmail_rule2')
            ];
        }
    
    },
    methods: {
        ...mapActions([
            'addGuest',
        ]),
        add(){

            if(this.$refs.form.validate()){
                this.addGuest({
                    type: 0,
                    name: this.name,
                    kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                    email: this.email,
                    // delivery_time: this.deliveryTime
                })
            }
            
        },
        reset(){
            this.$refs.form.reset();
        }

      
        
    }       
}
</script>

<style>

</style>