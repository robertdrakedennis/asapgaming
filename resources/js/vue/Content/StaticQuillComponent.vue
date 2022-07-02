<template>
    <div>
        <div ref="post_container" class="text-light"></div>
    </div>
</template>
<script>
    import Quill from 'quill';


    export default {
        props: [
            'post'
        ],
        data() {
            return {
                post_container: null
            };
        },
        mounted() {
            this.post_container = new Quill(this.$refs.post_container, {
                modules: {
                    toolbar: {
                        container: [],
                        handlers: {}
                    },
                },
                theme: 'bubble',
                readOnly: true,
            });
            let post = this.post;
            this.post_container.setContents(JSON.parse(post));
        },

    }
</script>

<style scoped>
    .ql-editor{
        min-height: 250px !important;
    }
</style>
