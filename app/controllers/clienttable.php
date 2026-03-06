<?php


if ($users && $users->num_rows > 0) {
    while ($row = $users->fetch_assoc()) {
        
    
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['address']}</td>
                <td>{$row['state']}</td>
                <td>{$row['city']}</td>
                <td>{$row['pincode']}</td>
                <td>
                    <button class='clientbtn btn btn-danger' data-id='{$row['id']}'>
                        Delete
                    </button>
                </td>
                <td>
                    <button class='update-btn btn btn-primary' data-eid='{$row['id']}'>
                        Update
                    </button>
                </td>
            </tr>";
    }
} else {
   
    echo "<tr>
            <td colspan='10' class='text-center'>No client Found</td>
          </tr>";
}

?>