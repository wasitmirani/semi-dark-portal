
<template>
<div>
 <!-- Start Breadcrumbbar -->
            <div class="breadcrumbbar" v-show="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">{{active_name}}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item" v-if="home_name!=null ||home_url !=null "><router-link :to="home_url">{{home_name}}</router-link></li>
                                <li class="breadcrumb-item" v-if="back_name!=null  ||back_url !=null"><router-link :to="back_url">{{back_name}}</router-link></li>
                                <li class="breadcrumb-item active" aria-current="page"  v-if=" active_name!=null" >{{active_name}}</li>
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
      props: ['home_name','home_url','back_name','back_url','active_name','active_url','breadcrumbbar']
}
</script>

<style>

</style>
