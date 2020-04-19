<template>
    <div id="app">
        <section id="content">
            <router-view></router-view>
        </section>
        <section id="footer" class="mt-4">
            <div class="row">
                <div class="col-12 col-md-9">

                    <p class="small">{{$t('footer.copyright_materials')}}<br />
                        {{$t('footer.copyright_site')}} <a rel="license" target="_blank"
                                                                        href="https://creativecommons.org/licenses/by-nc-sa/4.0/">Creative
                        Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>
                        <br/>
                    </p>
                    <p>
                        <a href="//github.com/Quintenps/OverwatchArcade2" target="_blank"><i class="fab fa-github" style="font-size:24px; margin-right:10px;"></i></a>
                        <a href="//twitter.com/owarcade" target="_blank"><i class="fab fa-twitter" style="font-size:24px"></i></a>
                    </p>

                </div>
                <div class="col-12 col-md-3">
                    <Multiselect v-model="language" :options="options" label="name" :searchable="true"
                                 @close="changeLanguage"
                                 :allow-empty="false"
                                 :close-on-select="true"
                                 :show-labels="false">
                        <template slot="singleLabel" slot-scope="props">
                            <CountryFlag :country='props.option.code' size='small'/> {{ props.option.name }}
                        </template>
                        <template slot="option" slot-scope="props">
                        <div class="option__desc"><span class="option__title"><CountryFlag :country='props.option.code' size='small'/> {{ props.option.name }}</span></div>
                        </template>
                    </Multiselect>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect'
    import CountryFlag from 'vue-country-flag'

    export default {
        name: "layout",
        data() {
            return {
                language: {name: 'English', code: 'US'},
                options: [
                    {name: 'English', code: 'US'},
                    {name: 'Portuguese', code: 'BR'},
                    {name: 'Chinese', code: 'CN'},
                    {name: 'German', code: 'DE'},
                    {name: 'Spanish', code: 'ES'},
                    {name: 'French', code: 'FR'},
                    {name: 'Italian', code: 'IT'},
                    {name: 'Japanese', code: 'JP'},
                    {name: 'Korean', code: 'KR'},
                    {name: 'Mexican', code: 'MX'},
                    {name: 'Polish', code: 'PL'},
                    {name: 'Russian', code: 'RU'},
                    {name: 'Taiwanese', code: 'TW'},
                ]
            }
        },
        components: {
            Multiselect,
            CountryFlag
        },
        methods: {
            changeLanguage() {
                if (this.language) {
                    this.$i18n.locale = this.language.code;
                    localStorage.language = JSON.stringify(this.language);
                }
            }
        },
        mounted() {
            if (localStorage.language) {
                this.language = JSON.parse(localStorage.getItem('language'));
                this.$i18n.locale = JSON.parse(localStorage.getItem('language')).code;
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
