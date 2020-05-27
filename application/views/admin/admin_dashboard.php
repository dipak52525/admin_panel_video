<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Hashcode </div>
        <div class="list-group list-group-flush">
            <img src="<?php echo base_url(); ?>/assets/images/food-and-restaurant.png" class="profile_image" alt="Codehub">
            <a href="<?= base_url('index.php/Admin/welcome') ?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Videos</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">About Us</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Contact Us</a>
            <!-- <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Status</a> -->
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <div class="container-fluid">
        <!-- Table Link : Bootstrap table editable - examples & tutorial. Basic & advanced usage - Material Design for Bootstrap -->
        <div class="card mt-5">
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Categories</h3>
            <div class="card-body">
                <div id="table" class="table-editable">
                    <span class="table-add float-right mb-3 mr-2"><a href="javascript:void(0);" onclick="showCategoryModel();" class="text-success"><i
                                class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
                    <table id="CategoryData" class="table table-bordered table-responsive-md table-striped text-center ">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Created Date</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($categories)) { ?>
                                <?php foreach ($categories as $category) {
                                        $this->load->view('admin/category_list_rowdata', ['category'=>$category]);
                                    }?>
                            <?php } else { ?>
                                <tr>
                                    <td>No Any Category Found! Please Add new Catgory</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /#wrapper -->
    
    <!-- Add Category -->
    <div class="modal fade" id="modalLaunchCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="response">
                
                </div>
            </div>
        </div>
    </div>
    
        <!-- Success Message Modal -->
    <div class="modal fade" id="ajaxSuccessResponse" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Message Modal -->
    <div class="modal fade" id="ajaxDeleteResponse" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="deleteRecord();">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery link [ this is put before javasript functions because of it will first load ] -->
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script type="text/javascript">
        var base_url = '<?php echo base_url();?>';

            function showCategoryModel()
            {
                // This function is used for launch the create category view for create the new category in DB

                $("#modalLaunchCategory").modal("show");
                
                // using ajax load the create_category_form and using this form load the whole form with fields in modalLaunchCategory
                $.ajax({
                    url: '<?php echo base_url().'index.php/Category/loadCreateCategoryFormFields'; ?>',
                    type: 'POST',
                    data: {},
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        $('#response').html(response["html"]);
                    } 
                });
            }

            $("body").on("submit", "#addCategoryModel", function(e){
                // This function is used for sending the request to controller for create new record in DB

                e.preventDefault(); // to stop the default submission process
                $.ajax({
                    url: '<?php echo base_url().'index.php/Category/insertCategory'; ?>',
                    type: 'POST',
                    data: new FormData(this), //$(this).serializeArray()
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    dataType: 'json',
                    success: function(response){
                        if (response['status'] == 0)
                        {
                            if (response["categ_name"] == 0){
                                $(".nameError").html(response["name"]).addClass('invalid-feedback d-block');
                                $("#category_name").addClass('is-invalid');
                            } else {
                                $(".nameError").html("").removeClass('invalid-feedback d-block');
                                $("#category_name").removeClass('is-invalid');
                            }

                            if (response["error_string"] != ""){
                                $(".imageError").html(response["error_string"]).addClass('invalid-feedback d-block');
                                $("#categoryImage").addClass('is-invalid');
                            } else {
                                $(".imageError").html("").removeClass('invalid-feedback d-block');
                                $("#categoryImage").removeClass('is-invalid');
                            }

                        } else {
                            
                            $("#modalLaunchCategory").modal("hide");
                            $("#ajaxSuccessResponse .modal-body").html(response["message"]);
                            $("#ajaxSuccessResponse").modal("show");
                            
                            $(".nameError").html("").removeClass('invalid-feedback d-block');
                            $("#category_name").removeClass('is-invalid');

                            $(".imageError").html("").removeClass('invalid-feedback');
                            $("#categoryImage").removeClass('is-invalid');

                            // bind a new created row in table
                            $('#CategoryData').append(response["rowHtml"]);
                        }
                    } 
                });
            });

            function showEditForm(id)
            {
                // This function is used for launch the edit view for updating the category data
                $("#modalLaunchCategory .modal-title").html("Edit Category");
                $.ajax({
                    url: '<?php echo base_url().'index.php/Category/editCategory/' ?>'+id,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response){
                        $("#modalLaunchCategory #response").html(response["html"]);
                        $("#modalLaunchCategory").modal("show");
                    } 
                });
            }

            $("body").on("submit", "#editCategoryModel", function(e){
                // This function is used for sending the request to controller for update the record in DB
                
                // to stop the default submission process
                e.preventDefault();
                
                $.ajax({
                    url: '<?php echo base_url().'index.php/Category/updateCategory'; ?>',
                    type: 'POST',
                    data: new FormData(this), //$(this).serializeArray()
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    dataType: 'json',
                    success: function(response){
                        if (response['status'] == 0)
                        {
                            if (response["categ_name"] == 0){
                                $(".nameError").html(response["name"]).addClass('invalid-feedback d-block');
                                $("#category_name").addClass('is-invalid');
                            } else {
                                $(".nameError").html("").removeClass('invalid-feedback d-block');
                                $("#category_name").removeClass('is-invalid');
                            }
                        } else {
                            $("#modalLaunchCategory").modal("hide");
                            $("#ajaxSuccessResponse .modal-body").html(response["message"]);
                            $("#ajaxSuccessResponse").modal("show");
                            
                            $(".nameError").html("").removeClass('invalid-feedback d-block');
                            $("#category_name").removeClass('is-invalid');

                            var id = response["rowHtml"]["id"];
                            $("#row-"+id+" .modelName").html(response["rowHtml"]["categ_name"]);
                            
                            $("#row-"+id+" .modelImage").html('<img src="'+base_url+'assets/category_images/'+response["rowHtml"]["image"]+'" class="profile_image">');
                            
                            /* this will remove the whole row <tr> without reload  page if user uncheck the active checkbox field
                                if (response["is_active"] == 0){
                                    $("#row-"+id).remove();
                             }*/
                        }
                    } 
                });
            });

            function confirmDelete(id)
            {
                // This function is used for get the confirmation of record is delete or not
                $('#ajaxDeleteResponse').modal("show");
                $('#ajaxDeleteResponse .modal-body').html("Are you sure you want to delete Category Id: #" +id+ "?");
                $('#ajaxDeleteResponse').data("id", id); // this will used for store te data for getting data from form for processing.
            }

            function deleteRecord(){
                // This function is used for sending the request to controller for delete the record from DB
                var id = $('#ajaxDeleteResponse').data('id');
                $.ajax({
                        url: '<?php echo base_url().'index.php/Category/deleteCategory/'; ?>'+id,
                        type: 'POST',
                        data: {},
                        dataType: 'json',
                        success: function(response){
                            if(response['status'] == 1){
                                $('#ajaxDeleteResponse').modal("hide");
                                $("#ajaxSuccessResponse .modal-body").html(response["msg"]);
                                $("#ajaxSuccessResponse").modal("show");
                                $("#row-"+id).remove(); // this will remove the whole row <tr> without reload  page
                            } else {
                                $('#ajaxDeleteResponse').modal("hide");
                                $("#ajaxSuccessResponse .modal-body").html(response["msg"]);
                                $("#ajaxSuccessResponse").modal("show");
                            }
                        } 
                    });
            }

    </script>
   
</body>
</html>

<?php include('footer.php'); ?>