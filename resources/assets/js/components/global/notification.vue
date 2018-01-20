<template>
    <div v-show="show" class="alert" :class="status" role="alert">
        <button type="button" v-on:click="close" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{message}}
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: 'alert',
        methods: {
            close() {
                this.$store.dispatch('hideAlert')
            }
        },
        computed: {
            ...mapGetters({
                show: 'isOpen',
                message: 'getMessage',
                status: 'getStatus'
            })
        }
    }
</script>

<style scoped>

</style>