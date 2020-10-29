<template>
<div>
                            <div class="card-body">
                                <h6 class="card-subtitle">User, Display all User data.</h6>

                                <div class="table-responsive" >
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
                                                <td>{{ item.status }}</td>
                                                <th><span class="co-name">{{ item.name }}</span></th>
                                                <td>{{ item.email }}</td>
                                                <td>{{ item.last_login }}</td>
                                                <td>{{ item.created_at }}</td>
                                                <td>{{ item.updated_at }}</td>
                                                <td>Action</td>
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
  props: ['users','get_users']
}
</script>

<style>

</style>
