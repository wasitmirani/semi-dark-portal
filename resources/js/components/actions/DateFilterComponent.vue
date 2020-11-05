<template>
   <a class="dropdown-item btn btn-primary mt-1 model-animation-btn" role="button" v-show="date_show">
       <i class="mdi mdi-calendar-text mr-2 text-success" @click="openDateModal">
    </i>{{label_name}}</a>


</template>

<script>
export default {
props: ['label_name','date_show'],
methods:{
    openDateModal(){
        alert("hello");
    },
},
}
</script>

<style>

</style>
