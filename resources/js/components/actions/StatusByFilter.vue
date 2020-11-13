<template>
    <div>
    <b-form @submit="onSubmit" v-show="statusshow">
      <b-form-group
        id="input-group-1"
        label="Please Select Status"
        label-for="input-1"
        description=""
      >
    <b-form-select v-model="selected" :options="options" class="mb-3">

      <template #first>
        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
      </template>
    </b-form-select>
    </b-form-group>
     <button type="submit" class="btn btn-primary-rgba mt-2 float-right"><i class="mdi mdi-filter mr-2"></i> {{buttonname}}</button>
    </b-form>
  </div>
</template>

<script>
export default {
    props: ["buttonname","statusshow",'apiurl'],
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
         onDateBy(){
            if(this.startdate!="" && this.enddate!=""){


               let formdata = new FormData();
                 formdata.append("startdate",moment.utc(this.startdate).format('YYYY-MM-DD'));
                 formdata.append("enddate",moment.utc(this.enddate).format('YYYY-MM-DD'));
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
            }
        },
    },
}
</script>

<style>

</style>
