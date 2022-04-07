<template>
    <div>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogRegisterToOrder" 
                max-width=640
            >
                <v-card>
                    <v-container>
                    <v-row justify="center">
                        <v-col cols="10" sm="10" md="8">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <div class="page-heading">
                                                Register
                                            </div>
                                            <div class="jp-font-400 grey--text text--darken-4 mb48">会員登録をする</div>
                                        </v-col>
                                    </v-row>
                                    <v-form 
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                        class="mb48"
                                    >
                                        <v-row justify="center">
                                            <v-col cols="12" sm="12" md="12">
                                                <v-text-field
                                                    v-model="name"
                                                    :label="$t('register.name')" 
                                                    outlined
                                                    required
                                                    :rules="nameRules"
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.name ? true : false"
                                                    :error-messages="allRegisterError.name"
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
                                                    :error="allRegisterError.kana ? true : false"
                                                    :error-messages="allRegisterError.kana"
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
                                                    :error="allRegisterError.zipcode ? true : false"
                                                    :error-messages="allRegisterError.zipcode"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="state"
                                                    :label="$t('register.prefecture')"
                                                    outlined
                                                    required
                                                    :rules="prefectureRules"
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.prefecture ? true : false"
                                                    :error-messages="allRegisterError.prefecture"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="city"
                                                    :label="$t('register.city')"
                                                    outlined
                                                    required
                                                    :rules="cityRules"
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.city ? true : false"
                                                    :error-messages="allRegisterError.city"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="address1"
                                                    :label="$t('register.address1')"
                                                    outlined
                                                    required
                                                    :rules="address1Rules"
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.address_1 ? true : false"
                                                    :error-messages="allRegisterError.address_1"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="building"
                                                    :label="$t('register.building')"
                                                    outlined
                                                    :error="allRegisterError.building ? true : false"
                                                    :error-messages="allRegisterError.building"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="phone"
                                                    :label="$t('register.phone')"
                                                    outlined
                                                    required
                                                    :rules="phoneRules"
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.phone ? true : false"
                                                    :error-messages="allRegisterError.phone"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="email"
                                                    :label="$t('register.email')"
                                                    outlined
                                                    required
                                                    :rules="emailRules" 
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.email ? true : false"
                                                    :error-messages="allRegisterError.email"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="confirmEmail"
                                                    :label="$t('register.confirm_email')"
                                                    outlined
                                                    required
                                                    :rules="confirmEmailRules" 
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.email ? true : false"
                                                    :error-messages="allRegisterError.email"
                                                ></v-text-field>
                                                <v-text-field 
                                                    v-model="password"
                                                    :label="$t('register.password')"  
                                                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :type="showPassword ? 'text' : 'password'"
                                                    outlined
                                                    required
                                                    :hint="$t('register.hint_password')"
                                                    :rules="passwordRules" 
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.password ? true : false"
                                                    :error-messages="allRegisterError.password"
                                                    @click:append="showPassword = !showPassword"
                                                ></v-text-field>
                                                <v-text-field 
                                                    v-model="password_confirmation"
                                                    :label="$t('register.confirm_password')"  
                                                    :append-icon="showPassword2 ? 'mdi-eye' : 'mdi-eye-off'"
                                                    :type="showPassword2 ? 'text' : 'password'"
                                                    outlined
                                                    required
                                                    :rules="confirmPasswordRules" 
                                                    validate-on-blur
                                                    @blur="() => $refs.form.resetValidation()"
                                                    :error="allRegisterError.password_confirmation ? true : false"
                                                    :error-messages="allRegisterError.password_confirmation"
                                                    @click:append="showPassword2 = !showPassword2"
                                                ></v-text-field>

                                                <v-btn 
                                                    dark 
                                                    color="primary" 
                                                    class="mb-2 mr-2" 
                                                    @click="goRegister()"
                                                    :looading="loading"
                                                >
                                                    {{$t('btn.register')}}
                                                </v-btn>
                                                 <v-btn 
                                                    outlined
                                                    color="primary" 
                                                    class="mb-2" 
                                                    @click="close()"
                                                >
                                                    {{$t('btn.back')}}
                                                </v-btn>
                                                <!-- <v-btn text color="primary" class="pa-0" @click.stop="toLogin()">ログインする</v-btn> -->
                                            </v-col>
                                        </v-row>
                                        <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                                        
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
        dialogRegisterToOrder: Boolean,
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
            email: '',
            confirmEmail: '',
            password: '',
            password_confirmation: '', 
            showPassword: false,
            showPassword2: false
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
            'allRegisterError',
            'loading'
        ]),
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
        },
        passwordRules(){
            return[
                (v) => !!v || this.$t('register.password_rule'),
                (v) => v.length >= 8 || this.$t('register.password_rule2')
            ];
        },
        confirmPasswordRules(){
            return[
                (v) => !!v || this.$t('register.confirmPassword_rule'),
                (v) => v == this.password || this.$t('register.confirmPassword_rule2')
            ];
        },
    },
    methods: {
        ...mapActions([
            'registerToOrder'
        ]),
        goRegister(){    

            this.$store.commit('setLoading', true)

            let lang = this.$i18n.locale
            
            if(this.$refs.form.validate()){
                this.registerToOrder({
                    url: "/register",
                    user_type: 1,
                    name: this.name,
                    kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    lang: lang
                })
            }
        }, 
        close(){
            this.$store.commit('setDialogRegisterToOrder', false);
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