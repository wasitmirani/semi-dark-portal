<template>
   <a class="dropdown-item" href="#" v-show="date_show">
       <i class="mdi mdi-calendar-text mr-2 text-success">
    </i>{{label_name}}</a>
</template>

<script>
export default {
props: ['label_name','date_show']
}
</script>

<style>

</style>
