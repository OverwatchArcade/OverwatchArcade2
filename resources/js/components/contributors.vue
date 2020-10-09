<template>
    <div>
        <div class="row">
            <div class="col-auto">
                <h1>{{$t('general.contributors')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-4 mb-4" v-for="contributor in contributors">
                <playertile :contributor="contributor"></playertile>
            </div>
        </div>
    </div>
</template>

<script>
    import Playertile from "./elements/playertile";
    export default {
        name: "contributors",
        components: {Playertile},

        data() {
            return {
                "contributors": [{},{},{}]
            }
        },
        methods: {
            getContributors() {
                return axios.get('/api/users').then(response => {
                    this.contributors = response.data;
                })
            },
        },
        mounted() {
            this.getContributors();
        }
    }
</script>

<style scoped>

</style>
