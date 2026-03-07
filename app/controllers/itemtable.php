
<?php

if ($items && $items->num_rows > 0) {
    while ($row = $items->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['itemname']}</td>
                <td>{$row['price']}</td>
                <td>{$row['description']}</td>
              
                <td><img src='uploads/{$row['image']}' alt='Item Image' width='100'></td>
                <td>
                    <button class='deletebutton btn btn-danger' data-id='{$row['id']}'>
                        Delete
                    </button>
                </td>
                <td>
                    <button class='edit-btn btn btn-primary' data-eid='{$row['id']}'>
                        Update
                    </button>
                </td>
            </tr>";
    }
} else {
   
    echo "<tr>
            <td colspan='8' class='text-center'>No Items Found</td>
          </tr>";
}
?>