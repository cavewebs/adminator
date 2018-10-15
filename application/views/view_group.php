<div class="example-wrapper">
    <h1><?=$details->g_name?>'s Users</h1>

    <?php //echo validation_errors(); 
    if ($msg !='') { echo '<div class="alert alert-info">'. $msg. ' </div>';} ?>

        <?php if ($users){ ?>
            <table id="group_list" class="table table-striped">
            <thead>
                <tr>
                <th>Users Detail</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user) { ?>
                <tr>
                    <td><?= $user['name'] ?> ->
                    <?= $user['gender'] ?> </td>
                    <td>
                    <?php $membership = $this->db->get_where('user_groups', array('gid'=>$details->id, 'uid'=>$user['id']))->row();
                     if(!$membership){?>
                   Not a Member <a href="#"  onclick="addToGroup()" data-id="<?=base_url()?>add/<?= $user['id'].'/'.$details->id ?>" class="btn btn-primary add-to-group">Add to Group</a>
                     <?php } else {?>
                   Already a Member <a href="#"  onclick="delUser()" class="btn btn-danger delete-user" data-id="<?=base_url()?>remove/<?= $membership->id ?>">Remove</a>
                     <?php }?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
            <?php } else{ ?>
            <p>No Groups to display</p>
        <?php } ?>    
</div>
<a href="<?=site_url()?>groups" class=""><i class="fa fa-arrow-back"></i>Go Back</a>
