<template>
    <v-card
        max-width = 560
        max-height = 315
    >
        <div class="youtube-css-responsive">
        <iframe 
            :src="`https://www.youtube.com/embed/${youtube}`" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
        </div>
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
.youtube-css-responsive{
    height: 0;
    overflow:hidden;
    position:relative;
    padding-bottom: 56.25%;
}

.youtube-css-responsive iframe{
    position:absolute;
    left:0;
    top:0;
    height:100%;
    width:100%;
}

</style>