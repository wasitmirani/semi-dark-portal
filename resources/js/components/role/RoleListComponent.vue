<template>
    <div>
           <div class="card-body">
        <h6 class="card-subtitle">All roles.</h6>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>

                        <th data-priority="1">Role</th>
                        <th data-priority="1">Users</th>
                        <th data-priority="4">Created</th>
                        <th data-priority="6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="roles.data=='' || roles.data==null">
                        <td colspan="6">
                            <div class="row justify-content-center">
                                <h3 class="alert alert-info">Data Not Found</h3>
                            </div>
                            </td>
                    </tr>
                    <tr v-for="item in roles.data" :key="item.id">
                        <td>{{ item.thumbnail }}</td>
                        <td v-if="item.status == 1">
                            <b-badge pill variant="success">active</b-badge>
                        </td>
                        <td v-else>
                            <b-badge pill variant="danger">Deactive</b-badge>
                        </td>
                        <th>
                            <span class="co-name">{{   item.name     }}</span>
                        </th>
                        <td>{{ item.users }}</td>

                        <td>{{ item.created_at | timeformat }}</td>

                        <td>
                            <h5>
                                <a role="button" @click="editdata(item)"><i class="mdi mdi-circle-edit-outline text-primary"></i></a>
                                |
                                <a role="button" @click="deletedata(item)"><i class="mdi mdi mdi-trash-can text-danger"></i></a>
                            </h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr />
        <pagination :data="roles" :limit="4" @pagination-change-page="get_roles"></pagination>
    </div>
    </div>
</template>

<script>
export default {
    props: ["roles", "get_roles","query"],
    methods: {
        deletedata: function (item) {
            return this.$emit("deletedata", item);

        },
        editdata: function (item) {

            return this.$emit("editdata", item);

        }
    }
}
</script>

<style>

</style>
