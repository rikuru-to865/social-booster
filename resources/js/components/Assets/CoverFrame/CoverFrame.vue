<template>
<div>
    <router-link :to="'/concept/' + concept.id" class="link">
        <b-card class="mt-2" footer-class="pt-1 pb-1" header-class="">
            <hr :class="'hr-' + concept.layer">
            <span>{{concept.layer | layerName}}</span><span class="float-right">{{concept.user !== null ? concept.user.name : 'Anonymous'}}</span>
            <hr>
            <h6 v-show="concept.name !== null">{{concept.name}}</h6>
            <br v-show="concept.name !== null">
            <p>{{concept.content}}</p>
            <div class="text-right">
                <CoverFrameStats v-show="mode === 'upper'" :cover="cover" />
                <CoverFrameVote v-show="mode === 'upper'" :cover="cover" />
            </div>
        </b-card>
    </router-link>
</div>
</template>

<script>
import CoverFrameVote from "./CoverFrameVote"
import CoverFrameStats from "./CoverFrameStats"
export default {
    data() {
        return {
            concept: Object
        }
    },
    components: {
        CoverFrameVote,
        CoverFrameStats
    },
    props: {
        cover: Object,
        mode: String
    },
    created() {
        this.concept = this.cover[this.mode + '_concept']
    },
    mounted() {},
    methods: {}
}
</script>
