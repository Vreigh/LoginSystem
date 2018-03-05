<?php include("View/parts/header.php")?>
<div class="container">
    
    <a class="button-link" href="<?php echo Helpers\UriManager::getUrl('user/create')?>"><button type="button" class="btn btn-success">Create +</button></a>
    
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Address</th>
        <th>Is Admin?</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user){
            echo "<tr>
                    <td>$user[name]</td>
                    <td>$user[surname]</td>
                    <td>$user[email]</td>
                    <td>$user[address]</td>
                    <td>$user[is_admin]</td>
                    <td><a class=\"button-link\" href=\"" . Helpers\UriManager::getUrl('user?id=' . $user['id']) ."\"><button type=\"button\" class=\"btn btn-warning\">Edit</button></a></td>
                    <td><a class=\"button-link\" href=\"" . Helpers\UriManager::getUrl('user/delete?id=' . $user['id']) ."\"><button type=\"button\" class=\"btn btn-danger\">Delete</button></a></td>
                </tr>";
        }
        ?>
    </tbody>
  </table>
</div>
<?php include("View/parts/footer.php")?>

