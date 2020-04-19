<template>
    <div class="card" v-if="gamemode.name">
        <span v-if="gamemode.label" class="card-ribbon"
              :class="getLabelColor(gamemode.label)">{{ $t('overwatch.labels.'+gamemode.label) }}</span>
        <div class="card-img-top" :style="{background: 'url('+gamemode.image+') no-repeat 50% 0'}" :alt="gamemode.name + ' Overwatch arcade gamemode'"></div>
        <div class="card-body">
            <h5 class="text-players">{{ $t('overwatch.arcademodes.'+gamemode.name+gamemode.players+'.Players') }}</h5>
            <h4 class="text-gamemode">{{ $t('overwatch.arcademodes.'+gamemode.name+gamemode.players+'.Name') }}</h4>
        </div>
    </div>
    <div class="card" v-else>
        <content-loader
                :height="475"
                :width="400"
                :speed="1"
                primaryColor="#DADADA"
                secondaryColor="#C4C4C4"
        >
            <rect x="0" y="1" rx="5" ry="5" width="100%" height="200"/>
            <rect x="10.78" y="250.67" rx="0" ry="0" width="163" height="25"/>
            <rect x="10.78" y="300.67" rx="0" ry="0" width="226" height="46"/>
        </content-loader>
    </div>
</template>

<script>
    import {ContentLoader} from "vue-content-loader"

    export default {
        name: "gametile",
        components: {
            ContentLoader
        },
        props: {
            'gamemode': Object,
        },
        methods: {
            getLabelColor(label) {
                switch (label.toLowerCase()) {
                    case 'daily':
                        return '-secondary';
                    case 'weekly':
                        return '';
                    case 'permanent':
                        return '';
                    default:
                        return null;
                }
            }
        }
    }
</script>

<style scoped>

</style>

