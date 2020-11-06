<template>
<div>
   <a class="dropdown-item btn btn-primary mt-1 model-animation-btn" role="button" v-show="date_show" @click="openDateModal">
       <i class="mdi mdi-calendar-text mr-2 text-success">
    </i>{{label_name}}</a>

    <!-- Modal -->


</div>
</template>

<script>
export default {
props: ['label_name','date_show'],
methods:{
    openDateModal(){
         $("#exampleModalLong").modal("show");
    //   return this.$emit("deletedata", "Helloworld");
        // alert("hello");
    },

},
mounted(){

}
}
</script>

<style>

</style>
