<template>
    <div>
        <ul class="owarcade-menu">
            <li>
                <router-link to="/overwatch">Overwatch</router-link>
            </li>
            <li>
                <router-link to="/overwatch2">Overwatch 2</router-link>
            </li>
            <li>
                <router-link to="/contributors">{{ $t("general.contributors") }}</router-link>
            </li>
            <li>
                <router-link to="/notifications">{{ $t("general.notifications") }}</router-link>
            </li>
            <li>
                <router-link to="/api">API</router-link>
            </li>
            <li v-if="loggedIn">
                <a href="/staff/settings">{{ $t("general.settings") }}</a>
            </li>
        </ul>
    </div>
</template>

<script>

    import card from "./elements/gametile";

    export default {
        name: "index",
        components: {
            card,
        },
        data() {
            return {
                loggedIn: false
            }
        },
        methods: {
            isContributor() {
                this.loggedIn = document.getElementById("loggedIn");
            }
        },
        mounted() {
            this.isContributor();
        }
    }
</script>

<style scoped>

</style>
