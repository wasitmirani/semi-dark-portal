<template>
    <Breadcrumb
    :breadcrumbbar="true"
    home_name="Dashboard"
    home_url="/"
    active_name="Dashboard"
    active_url="/"

    />
</template>

<script>
import Breadcrumb from "../Breadcrumb/breadcrumb";
    export default {
         components: {
        Breadcrumb,
        },
        mounted() {
            console.log('Component mounted.')
                 this.$Progress.finish()
        }

    }
</script>
