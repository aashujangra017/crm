
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
            <td colspan='8' class='text-center'>No Items Found</td>
          </tr>";
}
?>