<template>
<div v-if="loaded">
    <ConceptPageBackButton :concept_id="concept.id" />
    <ConceptRegister />
    <ConceptFrame :concept="concept" />
    <ConceptPageCover :concept_id="concept.id" :concept_layer="concept.layer" />
</div>
<div class="text-center" v-else>
    <b-spinner variant="secondary" style="height: 3rem;width: 3rem;" label="Loading..."></b-spinner>
</div>
</template>

<script>
import ConceptRegister from "../../Assets/ConceptRegister/ConceptRegister"
import ConceptFrame from "../../Assets/ConceptFrame/ConceptFrame"
import ConceptPageCover from "./ConceptPageCover"
import ConceptPageBackButton from "./ConceptPageBackButton"
export default {
    beforeRouteUpdate(to, from, next) {
        this.queryConcept(to.params.concept_id)
        next()
    },
    data() {
        return {
            loaded: false,
            concept: Object,
            covers: Array,
            covers_select_mode: 'upper'
        }
    },
    props: {
        concept_id: String
    },
    components: {
        ConceptRegister,
        ConceptFrame,
        ConceptPageCover,
        ConceptPageBackButton
    },
    created() {
        this.queryConcept(this.concept_id)
    },
    methods: {
        queryConcept: function(concept_id) {
            axios.get('/ajax/query/concept', {
                    params: {
                        concept_id: concept_id
                    }
                }).then(function(response) {
                    this.concept = response.data
                    this.loaded = true
                    this.$emit('updateHead');
                }.bind(this))
                .catch(function(error) {
                    console.log(error);
                });
        }
    },
    head: {
        title: function() {
            return {
                inner: this.concept.layer === 5 || this.concept.layer === 4 ? this.concept.name : this.concept.content
            }
        },
        meta: function() {
            return [{
                name: 'description',
                content: this.concept.content,
                id: 'desc'
            }]
        }
    }
}
</script>
