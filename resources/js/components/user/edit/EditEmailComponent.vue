<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-text-field
                    v-model="email"
                    :label="$t('edit.email.new_email')" 
                    outlined
                    required
                    :rules="emailRules"
                    :error="allerror.email ? true : false"
                    :error-messages="allerror.email"
                >
                </v-text-field>
                 <v-text-field
                    v-model="confirmEmail"
                    :label="$t('edit.email.confirm_new_email')" 
                    outlined
                    required
                    :rules="confirmEmailRules" 
                    :error="allerror.email ? true : false"
                    :error-messages="allerror.email"
                ></v-text-field>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateEmail"
                >
                    {{ $t('btn.update_data') }}
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="backEmail"
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
        isEditingEmail: Boolean,
    },
    data: function(){
        return {
            valid: true,
            email: '',
            confirmEmail: '', 
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
    },
    methods: {
        ...mapActions([
            'updateUserEmail'
        ]),
        updateEmail(){

            if(this.$refs.form.validate()){
                this.updateUserEmail({
                 email: this.email,
                })
            };

            this.$store.dispatch('clearError');
            
        },
        backEmail(){
            // this.$refs.form.reset();
            this.$store.commit('setIsEditingEmail', false)
            this.$store.dispatch('clearError');
            // this.$router.go({name: 'profile'})
        }
    }


}
</script>

<style>

</style>