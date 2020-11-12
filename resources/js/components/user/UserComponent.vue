<template>
<div>

    {{ this.$Progress.start() }}
    <breadcrumb
    home_name="Dashboard" home_url="/"
    back_name="Users List"
    back_url="/all/users"
    active_name="Users"
    active_url="/all/users"
    :breadcrumbbar="true"></breadcrumb>
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
                                    <div class="col-md-4 col-sm-6 col-xs-10">
                                        <SearchFilter :apiurl="'users?page='+this.page_num+'&query='+this.query"  v-on:query="isquery($event)"  v-on:isloading="is_loading($event)" v-on:reload="get_users()"  v-on:datalist="search_data($event)" ></SearchFilter>
                                    </div>
                                </h5>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="btn-group mr-2 float-right mt-2">
                                    <button type="button" class="btn   btn-primary mr-4" @click="openModal">
                                        New User
                                    </button>
                                   <div class="dropdown">
                                     <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="mdi mdi-filter-variant"></i></button>
                                     <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton6">
                                          <a class="dropdown-item" role="button" @click="get_users()"><i class="feather icon-refresh-ccw mr-2"></i>Refresh</a>
                                                        <a class="dropdown-item  mt-1 " role="button"  @click="openFilterModal('dateby')">
                                                        <i class="mdi mdi-calendar-text mr-2 text-dark" >
                                                        </i>Date By</a>
                                                        <a class="dropdown-item" role="button" @click="openFilterModal('statusby')"><i class="mdi mdi-settings-outline mr-2 text-dark"></i>Status By</a>

                                                        <!-- <a class="dropdown-item" href="#"><i class="feather icon-settings mr-2"></i>Setting</a> -->
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
                    <UserForm :edit_mode="edit_mode" :edit_form="edit_collection" v-on:updated="updated($event)" v-on:stored="stored($event)"></UserForm>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal  Filters-->
        <div class="modal fade" id="FilterModal" tabindex="-1" role="dialog">
             <div class="modal-dialog modal-dialog-centered model-md" role="document">
                 <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Advanced Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                  <div class="modal-body">
                         <div class=" row" v-show="filter.dateby">
                            <DateFilter :datepickershow="true"  v-on:datalist="datefilter_data($event)" apiurl="user/filter/dateby" buttonname="Filter"></DateFilter>
                         </div>
                        <!-- Start Status col -->
                            <div class=" row" v-show="filter.statusby">
                                <b-form v-on:submit.prevent="onStatusBy">
                                    <div class="row">
                                        <div class="col ml-4">
                                        </div>
                                    </div>
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
import DateFilter from "../actions/DateFilterComponent";
import SearchFilter from "../actions/SearchFilterComponent"
import UserForm from "../user/UserFormComponent"
export default {
    components: {
        breadcrumb,
        UserList,
        DateFilter,
        SearchFilter,
        UserForm,
    },
    data() {
        return {
            users: {},
            auth_user: {},
            isloading: false,
            page_num:1,
            query:"",
            filter:{
              dateby:false,
              statusby:false,
              monthby:false,
            },
            edit_mode: false,
            edit_collection:{},
        };
    },
    methods: {
        isquery(query){
            this.query=query;
        },
        datefilter_data(data){
            $("#FilterModal").modal("hide");
             this.users=data;
        },
        is_loading(value){
            this.isloading=value;
        },
        search_data(data){
              this.users=data;
        },
        openFilterModal(value){
                if(value=="dateby"){
                    this.filter.statusby=false;
                        this.filter.dateby=true;
                       return $("#FilterModal").modal("show");
                }
                if(value=="statusby"){
                          this.filter.dateby=false;
                        this.filter.statusby=true;
                       return $("#FilterModal").modal("show");
                }
        },

        stored(item){
            if(item)
            {
                     this.get_users();
                     $("#UserModal").modal("hide");
            }
        },
        updated(item){
            if(item)
            {
                     this.get_users();
                     $("#UserModal").modal("hide");
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
                            this.$hostapi_url + "/user/destroy/" + item.id,
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
            this.edit_collection=event;
            $("#UserModal").modal("show");

        },
        openModal() {
            this.edit_mode = false;
            this.edit_collection=null;
            $("#UserModal").modal("show");
        },
        get_users(page = 1) {
            this.isloading = true;
            this.page_num=page;
            axios
                .get(
                    this.$hostapi_url + "/users?page=" + page+"&query="+this.query,
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


        //
    }
};
</script>


