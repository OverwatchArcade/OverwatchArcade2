<template>
    <router-link
            :to="{ path: '/profile/'+contributor.name.replace(/#/, '%23'), params: {contributor: contributor.name.replace(/#/, '%23') }}"
            class="card" id="playertile" v-if="contributor.name">
        <div class="card-img-top" :style="{background: 'url('+contributor.avatar+') no-repeat 50% 0'}"
             :alt="contributor.name + '\'s avatar'"></div>
        <div class="card-img-overlay">
            <h4>{{contributor.name}}</h4>
            <div class="small">
                <ul class="list-group" style="list-style:none;">
                    <li>{{contributor.contributions}} contributions</li>
                    <li>Since: {{contributor.member_since}}</li>
                    <li>Last submit: {{contributor.last_submit}}</li>
                </ul>
            </div>
        </div>
    </router-link>
    <div class="card" v-else>
        <content-loader
                :height="250"
                :width="400"
                :speed="1"
                primaryColor="#DADADA"
                secondaryColor="#C4C4C4"
        >
        </content-loader>
    </div>
</template>

<script>
    import {ContentLoader} from "vue-content-loader"

    export default {
        name: "playertile",
        components: {
            ContentLoader
        },
        props: {
            'contributor': Object,
        },
        methods: {}
    }
</script>

<style scoped>

</style>

