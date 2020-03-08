<template>
    <div class="card" v-if="gamemode.name">
        <span v-if="gamemode.label" class="card-ribbon"
              :class="getLabelColor(gamemode.label)">{{ $t('overwatch.labels.'+gamemode.label) }}</span>
        <div class="card-img-top" :style="{background: 'url('+gamemode.image+') no-repeat 50% 0'}" :alt="gamemode.name + ' Overwatch arcade gamemode'"></div>
        <div class="card-body">
            <h4>{{ $t('overwatch.arcademodes.'+gamemode.name+'.Name') }}</h4>
            <p class="card-text">{{ $t('overwatch.arcademodes.'+gamemode.name+'.Players') }}</p>
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
                    case 'changes daily':
                        return '-secondary';
                    case 'changes weekly':
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

