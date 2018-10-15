<div class="example-wrapper">
    <h1>All Users</h1>
	 <a href="<?=base_url()?>users/new" class="btn btn-primary text-right">Add User</a>


    <?php if ($users){ ?>
    <table id="group_list" class="table table-striped">
      <thead>
        <tr>
          <th>User Detail</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user) { ?>
          <tr>
            <td><?= $user['name'] ?> -> <?= $user['gender'] ?></td>
            <td>
              <a href="<?=base_url()?>users/<?= $user['id'] ?>" class="btn btn-dark">View</a>
              <a href="#"  onclick="delUser()" class="btn btn-danger delete-user" data-id="<?=base_url()?>users/remove/<?= $user['id'] ?>"> Delete</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } else{ ?>
    <p>No Users to display</p>
    <?php } ?>
</div>
