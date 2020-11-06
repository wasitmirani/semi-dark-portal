<template>
<div>

    {{ this.$Progress.start() }}
    <breadcrumb home_name="Dashboard" home_url="/" back_name="Users List" back_url="/all/users" active_name="Users" active_url="/all/users" :breadcrumbbar="true"></breadcrumb>
    <div class="contentbar">
        <!-- Start row -->
        <div class="row mt-4">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="card-title">
                                    <div class="col-md-4">
                                        <div class="searchbar">
                                            <form>
                                                <div class="input-group">
                                                    <input type="search" class="form-control" placeholder="Search" v-model="query" aria-label="Search" aria-describedby="button-addon2" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                            <div class="col-md-4">

                                <div class="btn-group mr-2 float-right">
                                    <button type="button" class="btn   btn-primary mr-4" @click="openModal">
                                        New User
                                    </button>
                                   <div class="dropdown">
                                         <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="mdi mdi-filter-variant"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton6">
                                                        <a class="dropdown-item  mt-1 " role="button"  @click="openDateModal('dateby')">
                                                        <i class="mdi mdi-calendar-text mr-2 text-dark">
                                                        </i>Date By</a>
                                                        <a class="dropdown-item" role="button"><i class="mdi mdi-settings-outline mr-2 text-dark"></i>Status By</a>
                                                        <!-- <a class="dropdown-item" href="#"><i class="feather icon-dollar-sign mr-2"></i>Billing</a>
                                                        <a class="dropdown-item" href="#"><i class="feather icon-settings mr-2"></i>Setting</a> -->
                                                    </div>
                                                </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <b-overlay :show="isloading" rounded="sm">
                        <UserList :users="this.users" :get_users="get_users" v-on:editdata="edit_data($event)" v-on:deletedata="delete_data($event)"></UserList>
                    </b-overlay>
                </div>
            </div>
            <!-- End col -->
        </div>
    </div>

    <!-- Modal User Modal -->
    <div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" v-if="!edit_mode">
                        Register User
                    </h5>
                    <h5 class="modal-title" id="exampleModalLabel" v-else>
                        Update User
                    </h5>
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b-form v-on:submit.prevent="onSubmit">
                        <b-form-group id="input-group-2" label="Your Full Name:" label-for="input-2">
                            <b-form-input id="input-2" v-model="form.name" :state="namevalidation" @keydown="onchangeerror('name')" placeholder="Enter full name"></b-form-input>
                            <b-form-invalid-feedback :state="namevalidation">
                                Your Name must be 3-50 characters long.
                            </b-form-invalid-feedback>
                        </b-form-group>

                        <b-form-group id="input-group-1" label="Email address:" label-for="input-1">
                            <b-form-input id="input-1" v-model="form.email" :state="emailvalidation" type="email" @keydown="onchangeerror('email')" placeholder="Enter email"></b-form-input>
                            <b-form-invalid-feedback :state="emailvalidation">
                                <span v-if="this.errors['email']">
                                    {{ this.errors["email"][0] }}
                                </span>
                                <span v-else>
                                    Please enter a valid email address
                                </span>
                            </b-form-invalid-feedback>
                        </b-form-group>

                        <b-form-group id="input-group-2" label="Password" label-for="input-2">
                            <b-form-input id="input-2" type="password" v-model="form.password" :state="passwordvalidation" @keydown="onchangeerror('password')" placeholder="Enter password"></b-form-input>
                            <b-form-invalid-feedback :state="passwordvalidation">
                                The password must be at least 8 characters.
                            </b-form-invalid-feedback>
                        </b-form-group>

                        <hr />
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

    <!-- Modal -->
<div class="modal fade" id="DateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered model-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Advanced Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                  <!-- Start col -->
                  <div class=" row" v-show="filter.dateby">
                          <b-form v-on:submit.prevent="onDateBy">
                            <div class="row">
                                <div class="col ml-4">

                                    <label for="example-datepicker">Start Date</label>
                                    <datepicker  placeholder="Pick Start Date"  v-model="filter.startdate" format="yyyy-MM-dd" :required="true"></datepicker>
  <b-form-invalid-feedback :state="StartdateValidate">
                                Startdate is required
                            </b-form-invalid-feedback>
                                </div>

                                 <div class="col">
                                    <label for="example-datepicker">End Date</label>
                                    <datepicker placeholder="Pick End Date"   v-model="filter.enddate" format="yyyy-MM-dd" :required="true"> </datepicker>
                                                  <b-form-invalid-feedback :state="EnddateValidate">
                                EndDate is required
                            </b-form-invalid-feedback>
                                </div>

                            </div>
                            <hr>
  <button type="submit" class="btn btn-primary-rgba mt-2 float-right"><i class="mdi mdi-filter mr-2"></i> Filter</button>
                          </b-form>
                    </div>
                    <!-- End col -->

      </div>

    </div>
  </div>
</div>
    {{ this.$Progress.finish() }}
</div>
</template>

<script>
import breadcrumb from "../Breadcrumb/breadcrumb";
import UserList from "../user/UsersListComponent";
import Datepicker from 'vuejs-datepicker';
export default {
    components: {
        breadcrumb,
        UserList,
        Datepicker,
    },
    computed: {
        StartdateValidate(){
            if(this.filter.startdate==""){
                return false;
            }
        },
        EnddateValidate(){
            if(this.filter.enddate==""){
                return false;
            }
        },
        emailvalidation() {
            if (this.form.email == "") {
                if (this.errors["email"]) return false;
                else return null;
            } else {
                if (this.errors["email"]) return false;
                else
                    return this.form.email == "" ?
                        "" :
                        this.form.reg.test(this.form.email) ?
                        true :
                        false;
            }
        },
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
        passwordvalidation() {
            if (this.form.password == "") {
                if (this.errors["password"]) return false;
                else return null;
            } else if (this.errors["password"]) return false;
            else
                return (
                    this.form.password.length > 7 &&
                    this.form.password.length < 45
                );
        }
    },
    data() {
        return {
            users: {},
            auth_user: {},
            errors: [],
            isloading: false,
            isValidation: false,
            filter:{
              dateby:false,
              statusby:false,
              monthby:false,
              startdate:'',
              enddate:'',
            },
            edit_id: "",
            query: "",
            form: {
                name: "",
                password: "",
                email: "",
                reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
                thumbnail: "",
                role: ""
            },
            edit_mode: false
        };
    },
    methods: {
        onchangeerror(name) {
            // console.log(event);
            this.errors[name] = "";
        },
        openDateModal(value){
            console.log(value);
                if(value=="dateby"){
                        this.filter.dateby=true;
                       return $("#DateModal").modal("show");
                }

        },

        onDateBy(){
               let formdata = new FormData();
                 formdata.append("startdate", this.filter.startdate);
                 formdata.append("startend", this.filter.startend);
              axios
                    .post(
                        this.$hostapi_url + "/dashboard/user/filter/dateby",
                        formdata,
                        this.$config
                    )
                    .then(res => {}).catch((er)=>{

                    });
        },
        onSubmit() {
            let formdata = new FormData();
            formdata.append("name", this.form.name);
            formdata.append("id", this.edit_id);
            formdata.append("email", this.form.email);
            formdata.append("password", this.form.password);
            if (!this.edit_mode) {
                axios
                    .post(
                        this.$hostapi_url + "/dashboard/user/store",
                        formdata,
                        this.$config
                    )
                    .then(res => {
                        this.get_users();
                        $("#UserModal").modal("hide");
                        this.rest_form();
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "New User has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(er => {
                        this.errors = er.response.data.errors;
                        console.log(this.errors);
                    });
            } else {
                axios
                    .post(
                        this.$hostapi_url + "/dashboard/user/update",
                        formdata,
                        this.$config
                    )
                    .then(res => {
                        this.get_users();
                        $("#UserModal").modal("hide");
                        this.rest_form();
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "User has been updated",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(er => {
                        this.errors = er.response.data.errors;
                        console.log(this.errors);
                    });
            }
        },
        delete_data(item) {
            console.log(event);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    axios.get(
                            this.$hostapi_url + "/dashboard/user/destroy/" + item.id,
                            this.$config
                        )
                        .then((res) => {
                            this.get_users();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        });

                }
            })
        },
        edit_data(event) {
            this.edit_mode = true;
            this.form.name = event.name;
            this.form.email = event.email;
            this.edit_id = event.id;
            $("#UserModal").modal("show");
        },

        openModal() {
            this.edit_mode = false;
            this.rest_form();
            $("#UserModal").modal("show");
        },
        rest_form() {
            this.form.name = "";
            this.form.email = "";
            this.form.password = "";
        },
        get_users(page = 1) {
            this.isloading = true;
            axios
                .get(
                    this.$hostapi_url + "/dashboard/users?page=" + page,
                    this.$config
                )
                .then(res => {
                    this.users = res.data;
                    this.isloading = false;
                    var self = this;
                    setTimeout(function () {
                        self.$Progress.finish();
                    }, 1000);
                })
                .catch(er => {
                    console.log(er.response.data.errors);
                });
        }
    },
    watch: {},
    mounted() {
        this.get_users();
        this.auth_user = this.$attrs["authuser"];
        var self = this;

        setTimeout(function () {
            self.$Progress.finish();
        }, 1000);
        //
    }
};
</script>

<style></style>
