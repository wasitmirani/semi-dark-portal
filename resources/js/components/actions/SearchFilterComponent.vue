<template>
      <div class="searchbar">
         <form>
             <div class="input-group">
                      <input type="search" class="form-control" placeholder="Search" v-model="query" aria-label="Search" v-on:keyup="search_query" aria-describedby="button-addon2" />
              </div>
         </form>
     </div>
</template>

<script>
export default {
    props: ['apiurl'],
    data(){
        return {
             query: "",

        }

    },
    methods:{
           //asyncdata
    search_query: _.debounce(
      function() {

        this.$emit("isloading",true);
        this.search();
      },
      500 // 500 milliseconds
    ),

    search() {
      if (this.query.length > 1) {

        axios
          .get(this.$hostapi_url+"/"+this.apiurl+""+ this.query,this.$config)
          .then(response => {
              this.$emit("isloading",false);
              this.$emit("datalist", response.data);
          });
      }
      else {
            this.$emit("reload");
      }

    }
 },
}
</script>

<style>

</style>
