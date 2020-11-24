<template>
  <div>
        {{ this.$Progress.start() }}
        <Breadcrumb
            home_name="Dashboard"
            home_url="/"
            back_name="Users List"
            back_url="/all/users"
            active_name="Roles"

            :breadcrumbbar="true"
        ></Breadcrumb>
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
                                        <div
                                            class="col-md-4 col-sm-6 col-xs-10"
                                        >
                                            <SearchFilter
                                                :apiurl="
                                                    'roles?page=' +
                                                        this.page_num
                                                "
                                                v-on:query="isquery($event)"
                                                v-on:isloading="
                                                    is_loading($event)
                                                "
                                                v-on:reload="get_roles()"
                                                v-on:datalist="
                                                    search_data($event)
                                                "
                                            ></SearchFilter>
                                        </div>
                                    </h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div
                                        class="btn-group mr-2 float-right mt-2"
                                    >
                                        <button
                                            type="button"
                                            class="btn   btn-primary mr-4"
                                            @click="openModal"
                                        >
                                            New Role
                                        </button>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-round btn-outline-primary"
                                                type="button"
                                                id="CustomdropdownMenuButton6"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i
                                                    class="mdi mdi-filter-variant"
                                                ></i>
                                            </button>
                                            <div
                                                class="dropdown-menu"
                                                aria-labelledby="CustomdropdownMenuButton6"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    role="button"
                                                    @click="get_roles()"
                                                    ><i
                                                        class="feather icon-refresh-ccw mr-2"
                                                    ></i
                                                    >Refresh</a
                                                >
                                                <a
                                                    class="dropdown-item  mt-1 "
                                                    role="button"
                                                    @click="
                                                        openFilterModal(
                                                            'dateby'
                                                        )
                                                    "
                                                >
                                                    <i
                                                        class="mdi mdi-calendar-text mr-2 text-dark"
                                                    >
                                                    </i
                                                    >Date By</a
                                                >

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <b-overlay :show="isloading" rounded="sm">
                            <RoleList
                                :roles="this.roles"
                                :query="query"
                                :get_roles="get_roles"
                                v-on:editdata="edit_data($event)"
                                v-on:deletedata="delete_data($event)"
                            ></RoleList>
                        </b-overlay>
                    </div>
                </div>
                <!-- End col -->
            </div>
        </div>

    <div
            class="modal fade"
            id="Modal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="exampleModalLabel"
                            v-if="!edit_mode"
                        >
                            New Role
                        </h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-else>
                            Update Role
                        </h5>
                        <button
                            type="button"
                            class="close"
                            style="color:white;"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <RoleForm
                            :edit_mode="edit_mode"
                            :edit_form="edit_collection"
                            v-on:updated="updated($event)"
                            v-on:stored="stored($event)"
                        ></RoleForm> -->
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import Breadcrumb from "../Breadcrumb/breadcrumb";
import DateFilter from "../actions/DateFilterComponent";
import SearchFilter from "../actions/SearchFilterComponent";
import RoleList from "../role/RoleListComponent";
export default {
        components: {
                Breadcrumb,
                SearchFilter,
                DateFilter,
                RoleList,

        },
        data(){
            return {
            roles: {},

            isloading: false,
            page_num: 1,
            query: "",
            filter: {
                dateby: false,
                statusby: false,
                monthby: false
            },
            edit_mode: false,
            edit_collection: {}
            }
        },
        methods:{

        datefilter_data(data) {
            $("#FilterModal").modal("hide");
            this.roles = data;
        },
        is_loading(value) {
            this.isloading = value;
        },
        search_data(data) {
            this.roles = data;
        },
        openFilterModal(value) {
            if (value == "dateby") {

                this.filter.dateby = true;
                return $("#FilterModal").modal("show");
            }
        },

        stored(item) {
            if (item) {
                this.get_roles();
                $("#Modal").modal("hide");
            }
        },
        updated(item) {
            if (item) {
                this.get_users();
                $("#Modal").modal("hide");
            }
        },

         edit_data(event) {
            this.edit_mode = true;
            this.edit_collection = event;
            $("#UserModal").modal("show");
        },
        openModal() {
            this.edit_mode = false;
            this.edit_collection = null;
            $("#Modal").modal("show");
        },
        get_roles(page = 1) {
            this.isloading = true;
            this.page_num = page;
            axios
                .get(
                    this.$hostapi_url +
                        "/roles?page=" +
                        page +
                        "&query=" +
                        this.query,
                    this.$config
                )
                .then(res => {
                    this.roles = res.data;
                    this.isloading = false;

                })
                .catch(er => {
                    console.log(er.response.data.errors);
                });
        }
        }
}
</script>

<style>

</style>
