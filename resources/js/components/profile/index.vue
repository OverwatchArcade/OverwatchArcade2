<template>
    <div>
        <div class="row">
            <div class="col-12 text-center">
                <img :src="user_data.avatar" class="img-fluid rounded-circle" style="max-height:128px">
                <h3 id="username">{{user_data.name}}</h3>
                <h4>Contributor since {{user_data.member_since}} with {{user_data.contributions}} submittions</h4>
            </div>
        </div>
        <section id="user-info" class="mt-5" v-if="Object.keys(user_data.profile_data).length">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <h3>Personal</h3>
                    <div class="row">
                        <div class="col-12">
                            <table class="table bg-white table-striped p-2">
                                <tbody>
                                <tr>
                                    <th scope="row">Country</th>
                                    <td>
                                        <p v-if="user_data.profile_data.profile.country"><CountryFlag :country='user_data.profile_data.profile.country.code' size='small'/> {{user_data.profile_data.profile.country.name}} </p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">About</th>
                                    <td>
                                        <p>{{user_data.profile_data.profile.about}}</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1 col-12">
                    <div class="row">
                        <div class="col-12">
                            <h3>Favourite Arcade Modes</h3>
                            <div class="text-dark p-2">
                                <div class="row">
                                    <div v-if="overwatch.arcadeImages" v-for="mode in user_data.profile_data.game.mode">
                                        <img  class="border" style="height:128px"
                                             :src="overwatch.arcadeImages[mode].image" :title="mode">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <h3>Favourite Heroes</h3>
                            <div class="text-dark p-2">
                                <div class="row">
                                    <div v-for="character in user_data.profile_data.game.character">
                                        <img class="border" style="height:128px"
                                             :src="'/img/characters/' + character + '.jpg'" :title="character">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <h3>Favourite Maps</h3>
                            <div class="text-dark p-2">
                                <div class="row">
                                    <div v-for="map in user_data.profile_data.game.map">
                                        <img class="border" style="height:100px"
                                             :src="'/img/maps/' + map + '.jpg'" :title="map">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import arcademodes from '../../../../database/data/overwatch/arcademodes';
    import CountryFlag from 'vue-country-flag'

    export default {
        name: "profile_index",
        data() {
            return {
                user_data: {
                    "name": null,
                    "avatar": null,
                    "contributions": null,
                    "last_submit": null,
                    "member_since": null,
                    "profile_data": {
                        "game": {
                            "mode": [],
                            "map": [],
                            "character": []
                        },
                        "profile": {
                            "country": null,
                            "about": null,
                        }
                    }
                },
                overwatch: {
                    arcademodes: [],
                    arcadeImages: false,
                }
            }
        },
        components: {
            CountryFlag: CountryFlag
        },
        methods: {
        },
        mounted() {
            let username = this.$route.params.pathMatch.replace(/#/, '%23');
            axios.get('/api/user/' + username).then(response => {
                this.user_data = response.data
            });

            // Image list build
            axios.get('/api/overwatch/arcademodes').then(response => {
                let arcadelist = {};
                response.data.forEach(function(element){
                   arcadelist[element.name] = {"image": element.image}
                });
                this.overwatch.arcadeImages = arcadelist;
            });
        }
    }
</script>
<style>
    th {
        text-align: right;
    }
</style>