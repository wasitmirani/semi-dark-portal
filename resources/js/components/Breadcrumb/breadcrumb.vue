
<template>
<div>
 <!-- Start Breadcrumbbar -->
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">{{active_name}}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item"><router-link :to="home_url">{{home_name}}</router-link></li>
                                <li class="breadcrumb-item"><router-link :to="back_url">{{back_name}}</router-link></li>
                                <li class="breadcrumb-item active" aria-current="page"><router-link :to="active_url">{{active_name}}</router-link></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <!-- <div class="widgetbar">
                            <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- End Breadcrumbbar -->
</div>

</template>

<script>
export default {
      props: ['home_name','home_url','back_name','back_url','active_name','active_url']
}
</script>

<style>

</style>
