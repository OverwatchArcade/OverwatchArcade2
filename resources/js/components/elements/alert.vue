<template>

</template>
<script>
    export default {
        name: "alert",
        props: {
          msg: String
        },
        mounted() {
            this.$toasted.show(this.msg, {
                theme: "outline",
                position: "top-right",
                duration: 5000
            });
        }
    }
</script>

<style scoped>

</style>
