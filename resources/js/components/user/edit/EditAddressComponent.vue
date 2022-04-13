<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="zipcode"
                    :label="$t('register.zipcode')"
                    outlined
                    required
                    :hint="$t('register.hint_zipcode')"
                    persistent-hint
                    :rules="zipcodeRules"
                    :error="allerror.zipcode ? true : false"
                    :error-messages="allerror.zipcode"
                ></v-text-field>
                <v-text-field
                    v-model="state"
                    :label="$t('register.prefecture')"
                    outlined
                    required
                    :rules="prefectureRules"
                    :error="allerror.prefecture ? true : false"
                    :error-messages="allerror.prefecture"
                ></v-text-field>
                <v-text-field
                    v-model="city"
                    :label="$t('register.city')"
                    outlined
                    required
                    :rules="cityRules"
                    :error="allerror.city ? true : false"
                    :error-messages="allerror.city"
                ></v-text-field>
                <v-text-field
                    v-model="address1"
                    :label="$t('register.address1')"
                    outlined
                    required
                    :rules="address1Rules"
                    :error="allerror.address_1 ? true : false"
                    :error-messages="allerror.address_1"
                ></v-text-field>
                <v-text-field
                    v-model="building"
                    :label="$t('register.building')"
                    outlined
                ></v-text-field>
                <v-text-field
                    v-model="phone"
                    :label="$t('register.phone')"
                    outlined
                    required
                    :rules="phoneRules"
                    :error="allerror.phone ? true : false"
                    :error-messages="allerror.phone"
                ></v-text-field>
                <v-btn
                    color="primary"
                    darken
                    @click="updateAddress"
                    class="mr-2"
                >
                    {{ $t('btn.update_data') }}
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="back"
                >
                    {{ $t('btn.back') }}
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {

    },
    data: function(){
        
        return {
            valid: true,
            
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
            'isEditingAddress',
            'user',
        ]),
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
        zipcode: {
            get(){                
                return this.user.zipcode
            },
            set (value) {
                this.$store.commit('updateUserZipcode', value)
            }
        },
        state: {
            get(){                
                return this.user.prefecture
            },
            set (value) {
                this.$store.commit('updateUserPrefecture', value)
            }
        },
        city: {
           get(){                
                return this.user.city
            },
            set (value) {
                this.$store.commit('updateUserCity', value)
            }
        },
        address1: {
            get(){                
                return this.user.address_1
            },
            set (value) {
                this.$store.commit('updateUserAddress1', value)
            }
        },
        building: {
            get(){                
                return this.user.building
            },
            set (value) {
                this.$store.commit('updateUserBuilding', value)
            }
        },
        phone: {
            get(){                
                return this.user.phone
            },
            set (value) {
                this.$store.commit('updateUserPhone', value)
            }
        },
    
    
    },
    methods: {
        ...mapActions([
            'updateUserAddress'
        ]),
        updateAddress(){

            if(this.$refs.form.validate()){
                this.updateUserAddress({
                    // name: this.name,
                    // kana: this.kana,
                    zipcode: this.zipcode,
                    prefecture: this.state,
                    city: this.city,
                    address_1: this.address1,
                    building: this.building,
                    phone: this.phone,
                })
            }
            
        },
        back(){
            this.$store.commit('setIsEditingAddress', false)
            // this.$store.dispatch('fetchUser')
        }

      
        
    }       
}
</script>

<style>

</style>