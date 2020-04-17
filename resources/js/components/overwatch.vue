<template>
    <div id="overwatch">
        <div class="row mb-lg-2">
            <div class="col">
                <h3 v-if="outdated"><span class="badge badge-warning">{{$t('message.warning')}}</span>
                    {{$t('overwatch.not_updated_yet')}}</h3>
                <div v-if="!outdated && daily.user.battletag">
                    <h3 v-if="daily.user.battletag">Contributor</h3>
                    <router-link :to="/profile/+daily.user.battletag.replace(/#/, '%23')">
                        <p>
                            <img :src="daily.user.avatar" class="rounded-circle mr-2" height="32px"> {{
                            daily.user.battletag }}
                        </p>
                    </router-link>
                </div>
            </div>
            <div class="col col-md-auto">
                <div>
                    <countdown :time="timeleft" @end="handleCountdownEnd" :transform="transform">
                        <template slot-scope="props">
                            <h3>{{ $t('overwatch.day_resets_in') }} {{props.hours}}:{{props.minutes}}:{{props.seconds}}</h3>
                        </template>
                    </countdown>
                </div>
            </div>
        </div>
        <div id="cards">
            <div class="row ">
                <div class="col-xl-4 col-md-12 largeTile mb-4 mb-xl-0">
                    <card :gamemode="daily.modes.tile_1"></card>
                </div>
                <div class="col-xl-8 col-md-12">
                    <div class="row mb-4">
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 mb-xl-0">
                            <card :gamemode="daily.modes.tile_2"></card>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 mb-xl-0">
                            <card :gamemode="daily.modes.tile_3"></card>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 mb-xl-0">
                            <card :gamemode="daily.modes.tile_4"></card>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 mb-xl-0">
                            <card :gamemode="daily.modes.tile_5"></card>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 mb-xl-0">
                            <card :gamemode="daily.modes.tile_6"></card>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 mb-xl-0">
                            <card :gamemode="daily.modes.tile_7"></card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4" v-if='loggedIn && gameconfig'>
            <div class="col-12 col-md-4 col-lg-2" v-if="outdated">
                <a :href="gameconfig['update_url']" class="btn btn-light btn-block"><i class="fa fa-wrench"></i> Update</a>
            </div>
            <div class="col-12 col-md-4 col-lg-2 mt-2 mt-md-0" v-if="!outdated">
                <a href="#" v-on:click="undoGamemode" class="btn btn-light btn-block"><i class="fa fa-undo"></i> Undo</a>
            </div>
        </div>
    </div>
</template>

<script>
    import card from './elements/gametile';
    import countdown from '@chenfengyuan/vue-countdown';

    export default {
        name: "homepage",
        data() {
            return {
                timeleft: this.$moment.utc().endOf('day') - this.$moment.utc(),
                gameconfig: false,
                loggedIn: false,
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
            countdown
        },
        methods: {
            getOwConfig() {
                switch (this.$route['name']) {
                    case "overwatch":
                        this.gameconfig = {
                            'update_url': '/staff/overwatch',
                            'undo_url': '/staff/overwatch/undo',
                            'api_url': '/api/overwatch/today'
                        };
                        return true;
                    case "overwatch2":
                        this.gameconfig = {
                            'update_url': '/staff/overwatch2',
                            'undo_url': '/staff/overwatch2/undo',
                            'api_url': '/api/overwatch2/today'
                        };
                        return true;
                }
            },
            getDaily() {
                return axios.get(this.gameconfig['api_url']).then(response => {
                    this.daily = response.data;
                    if (response.data['is_today']) {
                        this.outdated = false
                    }
                })
            },
            undoGamemode() {
                let toasted = this.$toasted;
                let alert = this.$swal;

                alert.fire({
                    title: 'Are you sure?',
                    text: "You\re about to undo today\'s gamemode, are you sure?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.post(this.gameconfig['undo_url']).then(response => {
                            toasted.show('Daily has been deleted!');
                            this.outdated = true;
                            this.getDaily();
                        });
                    }
                });
            },
            isContributor() {
                this.loggedIn = document.getElementById("loggedIn");
            },
            handleCountdownEnd: function () {
                this.$toasted.show('Today\'s arcade has ended, it usually takes 5-10 minutes to update.', {
                    icon: 'clock',
                    type: "info"
                });
                this.getDaily();
            },
            transform(props) {
                Object.entries(props).forEach(([key, value]) => {
                    const digits = value < 10 ? `0${value}` : value;
                    props[key] = `${digits}`;
                });
                return props;
            },
        },
        mounted() {
            this.getOwConfig();
            this.getDaily();
            this.isContributor();
        }
    }
</script>
