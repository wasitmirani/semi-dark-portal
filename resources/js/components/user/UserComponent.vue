<template>
    <div>
        <breadcrumb
            home_name="Dashboard"
            home_url="/"
            back_name="Users List"
            back_url="/all/users"
            active_name="Users"
            active_url="/all/users"
        ></breadcrumb>
        <div class="contentbar">
            <!-- Start row -->
            <div class="row mt-4">
                <!-- Start col -->
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-title">
                                     <div class="searchbar">
                                        <form>
                                            <div class="input-group">
                                              <input type="search" class="form-control" placeholder="Search"  aria-label="Search" aria-describedby="button-addon2">
                                            
                                            </div>
                                        </form>
                                    </div>
                                    </h5>
                                </div>
                                <div class="col-md-2  float-right">
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                    >
                                        New User
                                    </button>
                                </div>
                            </div>
                        </div>
                        <b-overlay :show="isloading" rounded="sm">
                            <UserList
                                :users="this.users"
                                :get_users="get_users"
                            ></UserList>
                        </b-overlay>
                    </div>
                </div>
                <!-- End col -->
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
            isloading: false
        };
    },
    methods: {
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
    mounted() {
        this.get_users();
    }
};
</script>

<style></style>
