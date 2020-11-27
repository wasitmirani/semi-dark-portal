<template>
  <div>
         <b-form v-on:submit.prevent="onSubmit">
                        <b-form-group id="input-group-2" label="Your Full Name:" label-for="input-2">
                            <b-form-input id="input-2" v-model="form.name"  :state="namevalidation" @keydown="onchangeerror('name')" placeholder="Enter full name"></b-form-input>
                            <b-form-invalid-feedback :state="namevalidation">
                                Your Name must be 3-50 characters long.
                            </b-form-invalid-feedback>
                        </b-form-group>

                        <b-form-group id="input-group-1" label="Users" label-for="input-1">

                                  <multiselect v-model="form.users" tag-placeholder="Add this as new user"
                                  placeholder="Search" label="name" track-by="id" :options="options"
                                  :multiple="true" :taggable="true" ><span slot="noResult">Oops! No elements found. Consider changing the search query.</span></multiselect>

                            <b-form-invalid-feedback >
                                <span v-if="this.errors['users']">
                                    {{ this.errors["users"][0] }}
                                </span>
                                <span v-else>
                                    Please enter a valid email address
                                </span>
                            </b-form-invalid-feedback>
                        </b-form-group>

         </b-form>
  </div>


</template>

<script>

export default {

     props: ["edit_mode",'edit_form'],
      components: {

    },
     computed: {
        namevalidation() {
            if (this.form.name == "") {
                if (this.errors["name"]) return false;
                else return null;
            } else {
                if (this.errors["name"]) return false;
                else
                    return (
                        this.form.name.length > 2 && this.form.name.length < 51
                    );
            }
        },
        },
    data(){
        return {
             options:[],
                errors:[],
                form:{
                    users:{},


                    name:"",
                },
        }
    },
    watch:{
        test(){
            console.log(this.form.users);
        }
    },
        methods:{
            adduser(newuser){
                console.log(newuser);
            },
                onchangeerror(){

                },
            get_users(){
                     axios
                .get(
                    this.$hostapi_url +
                        "/role/users",
                    this.$config
                )
                .then(res => {
                    this.options=res.data;


                })
                .catch(er => {
                    console.log(er.response.data.errors);
                });
            }
        },
        mounted(){
                this.get_users();
        },

}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.multiselect__input, .multiselect__single {
    position: relative !important;
    display: inline-block;
    min-height: 20px;
    line-height: 20px;
    border: none;
    border-radius: 5px;
    background: #fff;
    padding: 0 0 0 5px !important;
    width: 100% !important;
    transition: border .1s ease;
    box-sizing: border-box;
    margin-bottom: 8px;
    vertical-align: top;
}

</style>
