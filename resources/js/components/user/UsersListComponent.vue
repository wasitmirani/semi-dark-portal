<template>
<div>
    <div class="card-body">
        <h6 class="card-subtitle">All Users.</h6>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th data-priority="1">Status</th>
                        <th data-priority="1">Name</th>
                        <th data-priority="2">Email</th>
                        <th data-priority="3">Last login</th>
                        <th data-priority="4">Created</th>
                        <th data-priority="5">Updated</th>
                        <th data-priority="6">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in users.data" :key="item.id">
                        <td>{{ item.thumbnail }} </td>
                        <td v-if="item.status==1">  <b-badge pill variant="success">active</b-badge></td>
                         <td v-else>  <b-badge pill variant="danger">Deactive</b-badge></td>
                        <th><span class="co-name">{{ item.name }}</span></th>
                        <td>{{ item.email }}</td>
                        <td>{{ item.last_login | timeformat }}</td>
                        <td>{{ item.created_at | timeformat }}</td>
                        <td>{{ item.updated_at | timeformat }}</td>
                        <td>
                            <h5><a role="button" @click="changedata(item)"><i class="mdi mdi-circle-edit-outline text-primary"></i></a> | <a role="button" @click="changedata(item)"><i class="mdi mdi mdi-trash-can text-danger"></i></a> </h5>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <hr>
        <pagination :data="users" @pagination-change-page="get_users"></pagination>

    </div>
</div>
</template>

<script>
export default {
    props: ['users', 'get_users'],
    methods: {
        changedata: function (item) {
            // this.current_item=item;
            // this.$emit("changedata","This is new Data");
            // console.log(item);
            return this.$emit("changedata", item);

            // return item;
        }
    },

}
</script>

<style>

</style>
