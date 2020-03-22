<template>
    <div id="cards">
        <div class="row">
            <div class="col">
                <h2>Overwatch 2</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-12 largeTile mb-4">
                <card :gamemode="daily.modes.tile_1"></card>
                <multiselect v-model="value['tile_1']" :options="options" @input="onChange(value['tile_1'], 'tile_1')"
                             :searchable="true"
                             :close-on-select="true" :custom-label="multiSelectLabel"
                             :show-labels="false" placeholder="Pick a value"></multiselect>
            </div>
            <div class="col-xl-8 col-md-12">
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <card :gamemode="daily.modes.tile_2"></card>
                        <multiselect v-model="value['tile_2']"
                                     @input="onChange(value['tile_2'], 'tile_2')" :options="options" :searchable="true"
                                     :close-on-select="true" :custom-label="multiSelectLabel"
                                     :show-labels="true" placeholder="Choose gamemode"></multiselect>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <card :gamemode="daily.modes.tile_3"></card>
                        <multiselect v-model="value['tile_3']"
                                     @input="onChange(value['tile_3'], 'tile_3')" :options="options" :searchable="true"
                                     :close-on-select="true" :custom-label="multiSelectLabel"
                                     :show-labels="true" placeholder="Choose gamemode"></multiselect>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <card :gamemode="daily.modes.tile_4"></card>
                        <multiselect v-model="value['tile_4']"
                                     @input="onChange(value['tile_4'], 'tile_4')" :options="options" :searchable="true"
                                     :close-on-select="true" :custom-label="multiSelectLabel"
                                     :show-labels="true" placeholder="Choose gamemode"></multiselect>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <card :gamemode="daily.modes.tile_5"></card>
                        <multiselect v-model="value['tile_5']"
                                     @input="onChange(value['tile_5'], 'tile_5')" :options="options" :searchable="true"
                                     :close-on-select="true" :custom-label="multiSelectLabel"
                                     :show-labels="true" placeholder="Choose gamemode"></multiselect>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <card :gamemode="daily.modes.tile_6"></card>
                        <multiselect v-model="value['tile_6']"
                                     @input="onChange(value['tile_6'], 'tile_6')" :options="options" :searchable="true"
                                     :close-on-select="true" :custom-label="multiSelectLabel"
                                     :show-labels="true" placeholder="Choose gamemode"></multiselect>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <card :gamemode="daily.modes.tile_7"></card>
                        <multiselect v-model="value['tile_7']"
                                     @input="onChange(value['tile_7'], 'tile_7')" :options="options" :searchable="true"
                                     :close-on-select="true" :custom-label="multiSelectLabel"
                                     :show-labels="true" placeholder="Choose gamemode"></multiselect>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button v-on:click="submitTodayGamemode()" class="btn btn-warning btn-block">Submit</button>
            </div>
        </div>
    </div>
</template>


<script>
    import card from "../../elements/gametile"
    import Multiselect from 'vue-multiselect'


    export default {
        name: "ow_submit",
        data() {
            return {
                value: {
                    'tile_1': false,
                    'tile_2': false,
                    'tile_3': false,
                    'tile_4': false,
                    'tile_5': false,
                    'tile_6': false,
                    'tile_7': false,
                },
                options: [],
                daily: {
                    created_at: null,
                    user: {},
                    modes: {
                        "tile_1": {},
                        "tile_2": {},
                        "tile_3": {},
                        "tile_4": {},
                        "tile_5": {},
                        "tile_6": {},
                        "tile_7": {}
                    }
                },
                outdated: true
            }
        },
        components: {
            card,
            Multiselect
        },
        methods: {
            getGamemodes() {
                return axios.get("/api/overwatch/arcademodes").then(response => {
                    this.options = response.data;
                })
            },
            getDaily() {
                return axios.get("/api/overwatch2/today").then(response => {
                    this.daily = response.data;
                })
            },
            submitTodayGamemode() {
                let toasted = this.$toasted;
                let alert = this.$swal;

                axios.post('/staff/overwatch2/submit', this.daily.modes).then(response => {
                    alert.fire({
                        title: 'Success',
                        text: 'Thank you for submitting today\'s arcade! <3. Tweet will be sent out shortly after this message.',
                        icon: 'success',
                        onClose: () => {
                            location.href = "/overwatch2";
                        }
                    });
                }).catch(function (error) {
                    if (error.response.status === 409) {
                        alert.fire({
                            title: 'Already been set',
                            text: 'Today\'s arcade has already been set, sorry!',
                            icon: 'warning',
                            onClose: () => {
                                location.href = "/overwatch2";
                            }
                        });
                    } else {
                        toasted.show("Something went wrong, are you sure you've filled in all the modes?");
                    }
                    console.log(error.response);
                })
            },
            onChange(value, id) {
                this.daily.modes[id] = value;
            },
            multiSelectLabel({name, players}) {
                return `${name} — [${players}]`
            },
        },
        mounted() {
            this.getDaily();
            this.getGamemodes();
        }
    }
</script>

<style scoped>
    .card { height: auto; }
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
