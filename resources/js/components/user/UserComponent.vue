<template>
<div>
<breadcrumb
home_name="Dashboard" home_url="/"
back_name="Users List"
back_url="/all/users"
active_name="Users"
active_url="/all/users"></breadcrumb>

            <!-- Start row -->
                <div class="row mt-4">
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Manage Users</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">User, Display all User data.</h6>
                                <div class="table-responsive rwd-table">
                                    <table id="tech-companies-1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Thumbnail</th>
                                            <th data-priority="1">Status</th>

                                                <th data-priority="1">Name</th>
                                                <th data-priority="3">Email</th>
                                                <th data-priority="1">Last_login</th>
                                                <th data-priority="3">Created</th>
                                                <th data-priority="3">Updated</th>
                                                <th data-priority="6">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Thumbnail </th>
                                                <td>Status</td>
                                                <td><span class="co-name">Name</span></td>
                                                <td>14.81 (2.54%)</td>
                                                <td>582.93</td>
                                                <td>597.95</td>
                                                <td>597.73 x 100</td>
                                                <td>597.91 x 300</td>
                                                <td>731.10</td>
                                                <td colspan="2">Spanning cell</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>

</div>

</template>

<script>
import breadcrumb from "../Breadcrumb/breadcrumb"
export default {
 components: {
     breadcrumb
    },

}
</script>

<style>

</style>
