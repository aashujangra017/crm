<?php

if ($users && $users->num_rows > 0) {
    while ($row = $users->fetch_assoc()) {

    
        $statusText = ($row['status'] == 1) ? 'Active' : 'Inactive';

        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$statusText}</td>
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
            <td colspan='7' class='text-center'>No Users Found</td>
          </tr>";
}
?>