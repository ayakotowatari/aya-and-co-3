<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field 
                    v-model="password"
                    :label="$t('edit.password.new_password')" 
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPassword ? 'text' : 'password'"
                    outlined
                    required
                    :hint="$t('register.hint_password')"
                    :rules="passwordRules" 
                    :error="allerror.password ? true : false"
                    :error-messages="allerror.password"
                    @click:append="showPassword = !showPassword"
                ></v-text-field>
                <v-text-field 
                    v-model="password_confirmation"
                    :label="$t('edit.password.confirm_new_password')"  
                    :append-icon="showPassword2 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPassword2 ? 'text' : 'password'"
                    outlined
                    required
                    :rules="confirmPasswordRules" 
                    :error="allerror.password_confirmation ? true : false"
                    :error-messages="allerror.password_confirmation"
                    @click:append="showPassword2 = !showPassword2"
                ></v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updatePassword"
                >
                    {{ $t('btn.update_data') }}
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="backPassword"
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
        user: Object,
        isEditingPassword: Boolean,
    },
    data: function(){
        return {
            valid: true,
            password: '',
            password_confirmation: '',
            showPassword: false,
            showPassword2: false
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'allerror',
        ]),
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
            'updateUserPassword'
        ]),
        updatePassword(){

            if(this.$refs.form.validate()){
                this.updateUserPassword({
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
            }
            
        },
        backPassword(){
            this.$refs.form.reset();
            this.$store.commit('setIsEditingPassword', false)
            // this.$router.go({name: 'profile'})
        }
    }


}
</script>

<style>

</style>