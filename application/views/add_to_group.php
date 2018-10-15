<div class="example-wrapper">
    <h1>View User Groups</h1>

    <?php //echo validation_errors(); 
    if ($msg !='') { echo '<div class="alert alert-info">'. $msg. ' </div>';} ?>

        <?php if ($groups){ ?>
            <table id="group_list" class="table table-striped">
            <thead>
                <tr>
                <th>Group Detail</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($groups as $group) { ?>
                <tr>
                    <td><?= $group['g_name'] ?> <br/>
                    <?= $group['g_about'] ?> </td>
                    <td>
                    <?php $membership = $this->db->get_where('user_groups', array('uid'=>$user_id, 'gid'=>$group['id']))->row();
                     if(!$membership){?>
                   Not a Member <a href="#"  onclick="addToGroup()" data-id="<?=base_url()?>users/add/<?= $user->id.'/'.$group['id'] ?>" class="btn btn-primary add-to-group">Add to Group</a>
                     <?php } else {?>
                   Already a Member <a href="#"  onclick="delUser()" class="btn btn-danger delete-user" data-id="<?=base_url()?>users/remove/<?= $membership->id ?>">Remove</a>
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
