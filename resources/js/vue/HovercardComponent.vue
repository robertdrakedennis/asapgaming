<template>
    <div>
    </div>
</template>

<script>

    export default {
        name: "HovercardComponent",
        props: [
            'slug',
            'avatar',
            'rank',
            'site',
            'base_site'
        ],
        data() {
            return {
                user: [],
                errors: [],
            }
        },
        async created() {
            try {
                const response = await this.$http.get(`${this.site + this.slug}`);
                this.user = response.data;
            } catch (e) {
                this.errors.push(e);
            }
        }
    }
</script>
