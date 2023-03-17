<script>
export default{
    data(){
        return{
           
        }
    },
    methods: {
        gotoPosts(){
            this.$router.push('/posts')
        }
    },

}
</script>
<template>
 home

 <button @click.prevent="gotoPosts()">
    get posts
 </button>
</template>
<style>
</style>