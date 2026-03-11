<?php


if ($users && $users->num_rows > 0) {
    while ($row = $users->fetch_assoc()) {
        
    
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['address']}</td>
                <td>{$row['sname']}</td>
                <td>{$row['city']}</td>
                <td>{$row['pincode']}</td>
                <td>
                    <button class='clientbtn btn btn-danger' data-id='{$row['id']}'>
                        Delete
                    </button>
                </td>
                 <td>
        <ul class='nav nav-tabs' id='myTab' role='tablist'>
            <li class='' role='presentation'>
                <button class='btn btn-primary update-btn'
                        id='addclient'
                        data-bs-toggle='tab'
                        data-bs-target='#home-tab-pane'
                        type='button'
                        role='tab'
                        data-eid='{$row['id']}'>
                  Update
                </button>
            </li>
        </ul>
    </td>
            </tr>";
    }
} else {
   
    echo "<tr>
            <td colspan='10' class='text-center'>No client Found</td>
          </tr>";
}

?>