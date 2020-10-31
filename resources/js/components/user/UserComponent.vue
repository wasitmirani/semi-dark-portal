<template>
<div>
    {{ this.$Progress.start()}}
    <breadcrumb home_name="Dashboard" home_url="/" back_name="Users List" back_url="/all/users" active_name="Users" active_url="/all/users" :breadcrumbbar="true"></breadcrumb>
    <div class="contentbar">
        <!-- Start row -->
        <div class="row mt-4">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h5 class="card-title">
                                    <div class="col-md-4">

                                        <div class="searchbar">
                                            <form>
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Search" v-model="query" aria-label="Search" aria-describedby="button-addon2">

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                            <div class="col-md-2 ">
                                <button type="button" class="btn btn-primary  float-right" @click="openModal">
                                    New User
                                </button>
                            </div>
                        </div>
                    </div>
                    <b-overlay :show="isloading" rounded="sm">
                        <UserList :users="this.users" :get_users="get_users" v-on:editdata="edit_data($event)"></UserList>
                    </b-overlay>
                </div>
            </div>
            <!-- End col -->
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="!edit_mode">Register User</h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-else>Update User</h5>
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                         <b-form @submit="onSubmit"  >
                     <b-form-group
                            id="input-group-1"
                            label="Email address:"
                            label-for="input-1"

                        >
                            <b-form-input
                            id="input-1"
                            v-model="form.email"
                            :state="emailvalidation"
                            type="email"
                             @keydown="emailerror"
                            required
                            placeholder="Enter email"
                            ></b-form-input>
                                  <b-form-invalid-feedback :state="emailvalidation">
                                      <span v-if="this.errors['email']">
                                            {{ this.errors['email'][0] }}
                                      </span>
                                      <span v-else>
                                        Please enter a valid email address
                                      </span>

                                  </b-form-invalid-feedback>
                        </b-form-group>

                    <b-form-group id="input-group-2" label="Your Full Name:" label-for="input-2">
                        <b-form-input
                        id="input-2"
                        v-model="form.name"
                         :state="namevalidation"
                        required
                        placeholder="Enter full name"
                        ></b-form-input>
                         <b-form-invalid-feedback :state="namevalidation">
                                  Your Name  must be 4-45 characters long.
                                  </b-form-invalid-feedback>
                         </b-form-group>

                    <b-form-group id="input-group-2" label="Password" label-for="input-2">
                        <b-form-input
                        id="input-2"
                        type="password"
                        v-model="form.password"
                         :state="passwordvalidation"

                        placeholder="Enter password"
                        ></b-form-input>
                         <b-form-invalid-feedback :state="passwordvalidation">
                                   The password must be at least 8 characters.
                                  </b-form-invalid-feedback>
                         </b-form-group>

                         <hr>
                         <div class="float-right">
                                <b-button type="submit" variant="primary" v-if="!edit_mode">Save</b-button>
                             <b-button type="submit" variant="success" v-else>Update</b-button>
                            <b-button type="reset" variant="danger" data-dismiss="modal">Close</b-button>
                              <!-- <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button> -->

                         </div>

                            </b-form>
                </div>
            </div>
        </div>

    </div>

</div>
</template>

<script>
import breadcrumb from "../Breadcrumb/breadcrumb";
import UserList from "../user/UsersListComponent";
export default {
    components: {
        breadcrumb,
        UserList
    },
    computed: {
      emailvalidation() {
          if(this.form.email=="")
           return null;
           else{
                if(this.errors['email'] && this.form.email!="")
                return false;
            else
             return (this.form.email == "") ? "" : (this.form.reg.test(this.form.email)) ? true : false;
           }

      },
    namevalidation() {
        if(this.form.name=="")
            return null
        else
         return this.form.name.length > 2 && this.form.name.length < 45
      },
    passwordvalidation() {
        if(this.form.password==""){

             return null
        }

        else
         return this.form.password.length > 7 && this.form.password.length < 45
      }
    },
    data() {
        return {
            users: {},
            auth_user:{},
            errors:[],
            isloading: false,
            isValidation:false,
            edit_id:'',
            query:"",
            form:{
                name:'',
                password:'',
                email:'',
                reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
                thumbnail:'',
                role:'',
            },
            edit_collection: {},
            edit_mode: false,
        };
    },
    methods: {
        emailerror(){
            // console.log(event);
            this.errors['email']="";
        },
          onSubmit(evt) {
              this.isValidation=true;
              const config = {
                headers: { Authorization: `Bearer `+this.auth_user.api_token }
            };
            let formdata=new FormData();
            formdata.append('name',this.form.name);
            formdata.append("email",this.form.email);
            formdata.append('password',this.form.password);

        if(!this.edit_mode){
            axios.post(this.$hostapi_url+"/admin/user/store",formdata,config).then((res)=>{
                alert("success");
            }).catch((er)=>{
            this.errors=er.response.data.errors;

            console.log(this.errors);
            });
        }
        else{

        }

       },
        edit_data(event) {
            this.edit_mode = true;
            this.edit_collection = event;
            this.edit_id=event.id;
            $('#UserModal').modal('show')
        },

        openModal() {
            $('#UserModal').modal('show')
        },
        get_users(page = 1) {
            this.isloading = true;
            axios
                .get(this.$hostapi_url + "/admin/users?page=" + page,this.$config)
                .then(res => {
                    this.users = res.data;
                    this.isloading = false;
                    var self = this;
                    setTimeout(function () {
                        self.$Progress.finish()
                    }, 1000);
                })
                .catch(er => {
                    console.log(er.response.data.errors);
                });
        }
    },
    watch: {

    },

    mounted() {
        this.get_users();
       this.auth_user= this.$attrs['authuser'];
        var self = this;

        setTimeout(function () {
            self.$Progress.finish()
        }, 1000);
        //
    }
};
</script>

<style></style>
