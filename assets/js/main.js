function delUser() {
	const group_id = document.getElementById('group_list');
if (group_id) {
  group_id.addEventListener('click', e => {
    if (e.target.className === 'btn btn-danger delete-user') {
        const a_href = e.target.getAttribute('data-id');
      if (confirm('Are you sure?')) {
    $.ajax({url: a_href, success: function(result){
        window.location.reload();
    }});

     }
    }
  });
}

}


function addToGroup() {
	const user_id = document.getElementById('group_list');
if (user_id) {
  user_id.addEventListener('click', e => {
    if (e.target.className === 'btn btn-primary add-to-group') {
        const a_href = e.target.getAttribute('data-id');
      if (confirm('Are you sure?')) {
    $.ajax({url: a_href, success: function(result){
        window.location.reload();
    }});

     }
    }
  });
}

}
