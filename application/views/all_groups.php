<div class="example-wrapper">
    <h1>All Groups</h1>
	 <a href="<?=base_url()?>groups/new" class="btn btn-primary text-right">Add Group</a>


    <?php if ($groups){ ?>
    <table id="group_list" class="table table-striped">
      <thead>
        <tr>
          <th>User Detail</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($groups as $group) { ?>
          <tr>
            <td><?= $group['g_name'] ?> -> <?= $group['g_about'] ?></td>
            <td>
              <?php $members = $this->db->where('gid',$group['id'])->from('user_groups')->count_all_results();
                     if($members < 1){?>
                     No Member <a href="#"  onclick="delUser()" class="btn btn-danger delete-user" data-id="<?=base_url()?>groups/remove/<?= $group['id'] ?>"> Delete</a> or <br>
                     <a href="<?=base_url()?>groups/<?= $group['id'] ?>" class="btn btn-dark">Add Members</a>
                     <?php } else {?>

                     <a href="<?=base_url()?>groups/<?= $group['id'] ?>" class="btn btn-dark">View Members (<?=$members?>)</a>
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
