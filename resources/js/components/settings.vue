<template>
    <div class="row">
        <div class="col-12">
            <h2>Profile settings</h2>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <img :src="user_data.avatar" class="img-thumbnail" style="height:158px">
                            <input type="file" accept="image/jpeg" class="form-control-file" @change=uploadImage>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <h4>Profile</h4>
            <div class="p-2 rounded">
                <div class="form-group">
                    <label for="country" class="font-weight-bold">Country</label>
                    <multiselect v-model="user_data.profile_data.profile.country" id="country" name="country"
                                 :searchable="true"
                                 :options="countries"
                                 label="name"
                                 track-by="name"
                    ></multiselect>
                </div>
                <div class="form-group">
                    <label for="about" class="font-weight-bold">About</label>
                    <textarea type="email" class="form-control" id="about"
                              v-model="user_data.profile_data.profile.about"></textarea>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <h4>Game</h4>
            <div class=" p-2 rounded">
                <div class="form-group">
                    <label for="favourite_game_character" class="font-weight-bold">Favourite
                        Character</label>
                    <multiselect v-model="user_data.profile_data.game.character" id="favourite_game_character"
                                 name="favourite_game_character" :options="overwatch.characters" :searchable="true"
                                 :close-on-select="false"
                                 :multiple="true" :show-labels="true"></multiselect>
                </div>
                <div class="form-group">
                    <label for="favourite_game_mode" class="font-weight-bold">Favourite Arcade Mode</label>
                    <multiselect v-model="user_data.profile_data.game.mode" id="favourite_game_mode"
                                 name="favourite_game_mode" :searchable="true"
                                 :close-on-select="false"
                                 :options="overwatch.arcademodes.map(mode => mode.name)"
                                 :multiple="true" :show-labels="true"></multiselect>
                </div>
                <div class="form-group">
                    <label for="favourite_game_map" class="font-weight-bold">Favourite Map</label>
                    <multiselect v-model="user_data.profile_data.game.map" id="favourite_game_map"
                                 name="favourite_game_map"
                                 :close-on-select="false"
                                 :options="overwatch.maps" :searchable="true"
                                 :multiple="true" :show-labels="true"></multiselect>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" v-on:click="updateProfile()" class="btn btn-warning">Submit</button>
        </div>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect'
    import countries from '../../../database/data/general/countries.json';
    import maps from '../../../database/data/overwatch/maps.json';
    import characters from '../../../database/data/overwatch/characters.json';
    import arcademodes from '../../../database/data/overwatch/arcademodes.json';

    export default {
        name: "settings",
        data() {
            return {
                user_data: {
                    "avatar": "//via.placeholder.com/450x450",
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
                errors: {},
                overwatch: {
                    maps: this.getTitleValues(maps),
                    characters: this.getTitleValues(characters),
                    arcademodes: arcademodes
                },
                countries: countries
            }
        },
        components: {
            Multiselect
        },
        methods: {
            updateProfile() {
                return axios.post("/api/user/update", this.user_data.profile_data).then(response => {
                    this.$toasted.show("Profile succesfully updated!", {
                        theme: "outline",
                        position: "top-right",
                        duration: 5000
                    });
                }).catch(response => {
                    this.$toasted.show(response.errors, {
                        theme: "outline",
                        position: "top-right",
                        duration: 5000
                    });
                })
            },
            getTitleValues(array) {
                let arr = [];
                array.forEach(element => arr.push(element.title));
                return arr;
            },
            uploadImage(e) {
                const image = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.user_data.profile_data.avatar = e.target.result;
                    this.user_data.avatar = e.target.result;
                };
            }
        },
        mounted() {
            let username = document.getElementById('username').innerHTML.replace(/#/, '%23');
            axios.get('/api/user/' + username).then(response => {
                if (response.data.profile_data) {
                    this.user_data.profile_data = response.data.profile_data
                }
                this.user_data.avatar = response.data.avatar;
                this.user_data.name = response.data.name;
            });
        }
    }
</script>