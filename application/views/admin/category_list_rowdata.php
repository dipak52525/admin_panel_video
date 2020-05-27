<tr id="row-<?= $category->id; ?>">
    <td class="align-middle"><?= $category->id; ?></td>
    <td class="modelName align-middle"><?= $category->categ_name; ?></td>
    <td class="align-middle"><?= $category->created_at; ?></td>
    <td class="modelImage align-middle">
        <?php if ($category->image) { ?>
            <img src="<?= base_url('assets/category_images/'.$category->image); ?>" class="profile_image" alt="Codehub">
        <?php } else { ?>
            Not Found
            <!-- <img src="<?php echo base_url(); ?>/assets/images/category_default_image.jpeg" class="profile_image" alt="Codehub"> -->
        <?php } ?>
    </td>
    <td class="align-middle"><a href="javascript:void(0);" class="btn btn-primary" onclick="showEditForm(<?php echo  $category->id; ?>);">Edit</a></td>
    <td class="align-middle"><a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete(<?php echo  $category->id; ?>);">Delete</a></td>
</tr>