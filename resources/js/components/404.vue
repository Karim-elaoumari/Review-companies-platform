<script>
export default{
    methods: {
        goBack() {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        }

    },

}

</script>
<template>
  404

  <button @click="goBack"> Go Back</button>
</template>
<style>
</style>