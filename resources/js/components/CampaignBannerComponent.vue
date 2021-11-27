<template>
    <v-card
        class="mx-quto"
        max-width = 344
        @click.prevent="$router.push({name: 'wrapping-kit'})"
        outlined
    >
        <v-img
            src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/wrappingkit.png"
            height="200px"
        ></v-img>

        <v-card-title class="jp-font-400 grey--text text--darken-3">
            簡単ギフトラッピングキット
        </v-card-title>

        <v-card-subtitle class="jp-font-400">
            ご家族やご友人にへのプレゼントに。ご自身で簡単でオシャレなギフトラッピングができるキットを無料進呈中
        </v-card-subtitle>

        <v-card-actions>
            <v-btn
                color="primary"
                text
                @click="$router.push({name: 'wrapping-kit'})"
            >
                もっとみる
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    props: {
        youtube: String
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
    
    },
    methods: {
      

        
    }


}
</script>

<style>

</style>