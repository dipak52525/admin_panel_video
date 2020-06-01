<!DOCTYPE html>
<html lang="en">

<body>
     <!-- Sidebar -->
     <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Hashcode </div>
        <div class="list-group list-group-flush">
            <img src="<?php echo base_url(); ?>/assets/images/food-and-restaurant.png" class="profile_image" alt="Codehub">
            <a href="<?= base_url('index.php/Admin/welcome') ?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="<?= base_url('index.php/Videos/video_list') ?>" class="list-group-item list-group-item-action bg-light">Videos</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">About Us</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Contact Us</a>
            <!-- <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Status</a> -->
        </div>
    </div>
    <!-- /#sidebar-wrapper -->
</body>
</html>