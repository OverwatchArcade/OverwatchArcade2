<template>
    <div id="app">
        <section id="content">
            <router-view></router-view>
        </section>
        <section id="footer" class="mt-4">
            <div class="row">
                <div class="col-12 col-md-10">

                    <p class="small">Game content and materials are trademarks and copyrights of their respective
                        publisher and
                        its
                        licensors. All
                        rights reserved.</p>
                    <p class="small">
                        This work is licensed under a <a rel="license"
                                                         href="https://creativecommons.org/licenses/by-nc-sa/4.0/">Creative
                        Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.<br/>
                        This site is made for fun by <a href="//bluedog.dev">bluedog</a> and maintained by the <a
                            href="/contributors">contributors</a>
                    </p>

                </div>
                <div class="col-12 col-md-2">
                    <Multiselect v-model="language" :options="options" label="name" :searchable="true"
                                 @close="changeLanguage"
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
                language: {name: 'English', code: 'EN'},
                options: [
                    {name: 'English', code: 'US'},
                    {name: 'German', code: 'DE'},
                    {name: 'Portuguese', code: 'BR'},
                    {name: 'Spanish', code: 'ES'},
                    {name: 'French', code: 'FR'},
                    {name: 'Italian', code: 'IT'},
                    {name: 'Japanese', code: 'JP'},
                    {name: 'Korean', code: 'KR'},
                    {name: 'Polish', code: 'PL'},
                    {name: 'Russian', code: 'RU'},
                    {name: 'Taiwanese', code: 'TW'}
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