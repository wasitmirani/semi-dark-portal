<template>
<div>

    <!-- Start Date col -->
                            <div class="col-md-12 justify-content-center">
                                <b-form v-on:submit.prevent="onDateBy">
                                    <div class="row ">
                                        <div class="col-12">
                                            <label for="example-datepicker">Start Date</label>
                                            <datepicker  placeholder="Pick Start Date"   v-model="startdate" format="yyyy-MM-dd" :required="true"></datepicker>
                                                <b-form-invalid-feedback :state="StartdateValidate">
                                        Startdate is required
                                    </b-form-invalid-feedback>
                                        </div>

                                        <div class="col-12">
                                            <label for="example-datepicker">End Date</label>
                                            <datepicker placeholder="Pick End Date" style="width:100%"  v-model="enddate" format="yyyy-MM-dd" :required="true"> </datepicker>
                                                        <b-form-invalid-feedback :state="EnddateValidate">
                                        EndDate is required
                                    </b-form-invalid-feedback>
                                        </div>

                                    </div>
                                    <hr>
        <button type="submit" class="btn btn-primary-rgba mt-2 float-right"><i class="mdi mdi-filter mr-2"></i> {{buttonname}}</button>
                                </b-form>
                            </div>
                            <!-- End col -->

</div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
export default {
props: ["buttonname","datepickershow",'apiurl'],
 components: {
        Datepicker,
    },
    computed: {

StartdateValidate(){
            if(this.startdate==""){
                return false;
            }
        },
        EnddateValidate(){
            if(this.enddate==""){
                return false;
            }
        },
    },
    data(){
        return {
            enddate:"",
            startdate:"",

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
mounted(){

}
}
</script>

<style >
.vdp-datepicker__calendar {
    position: absolute;
    z-index: 100;
    background: #fff;
    width: 100% !important;
    border: 1px solid #ccc;
}
input{
    width: 100% !important;
}
</style>
