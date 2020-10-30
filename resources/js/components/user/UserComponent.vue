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
                                                    <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">

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
                        <UserList :users="this.users" :get_users="get_users" v-on:changedata="Update_data($event)"></UserList>
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
                    <h5 class="modal-title" id="exampleModalLabel">Register User</h5>
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary">Save</button>
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
    data() {
        return {
            users: {},
            isloading: false,
            edit_collection: {},
        };
    },
    methods: {
        Update_data(event) {
            console.log("hello");
            alert(JSON.stringify(event));
            console.log("update", event);
        },

        openModal() {
            $('#UserModal').modal('show')
        },
        get_users(page = 1) {
            this.isloading = true;
            axios
                .get(this.$hostapi_url + "/get/all/users?page=" + page)
                .then(res => {
                    this.users = res.data;
                    this.isloading = false;
                })
                .catch(er => {
                    console.log(er);
                });
        }
    },
    watch: {
        onClickChild(value) {

            // console.log(UserList.methods.edit_row()) // someValue
        },
    },

    mounted() {
        this.get_users();
        var self = this;
        console.log(UserList.edit_row)
        // console.log("user", UserList.methods.edit_row());
        setTimeout(function () {
            self.$Progress.finish()
        }, 1000);
        //
    }
};
</script>

<style></style>
