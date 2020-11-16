<template>
    <div>
          <div class="col-md-12 justify-content-center">
    <b-form v-on:submit.prevent="StatusBy" >
      <b-form-group
        id="input-group-1"
        label="Please Select Status"

        label-for="input-1"
        description=""
      >
    <b-form-select  v-model="selected" :options="options" class="mb-3 form-control">

      <template #first>
        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
      </template>
    </b-form-select>
    </b-form-group>
     <button type="submit" class="btn btn-primary-rgba mt-2 float-right"><i class="mdi mdi-filter mr-2"></i> {{buttonname}}</button>
    </b-form>
          </div>
  </div>
</template>

<script>
export default {
    props: ["buttonname",'apiurl'],
    data() {
      return {
        selected: null,
        options: [
          { value: '1', text: 'Active' },
          { value: '0', text: 'Inactive' }
        ]
      }
    },
    methods:{
         StatusBy(){



               let formdata = new FormData();
                 formdata.append("status",this.selected);

              axios
                    .post(
                        this.$hostapi_url + "/"+this.apiurl,
                        formdata,
                        this.$config
                    )
                    .then(res => {

                     return this.$emit("datalist", res.data);

                    }).catch((er)=>{

                    });

        },
    },
}
</script>

<style>
.custom-select {
    background-color: #ffffff !important;
    border: 1px solid #0080ff !important;
}
</style>
