<script>
    export default {
        beforeCreate() {
            const {params, query} = this.$route;
            const {path} = params;
            if (path == undefined) {
                this.$router.replace({path: '/index'});
            } else {
                // this.$router.replace({ path: '/' + path, query });
                this.$router.replace({path: '/404'});
            }
        },
        render: function (h) {
            return h(); // avoid warning message
        },
    };
</script>
