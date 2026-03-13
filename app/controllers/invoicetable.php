<?php

if ($users && $users->num_rows > 0) {

    while ($row = $users->fetch_assoc()) {

        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['invoice_codes']}</td>
                <td>{$row['client_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['total']}</td>
                <td>{$row['created_at']}</td>
                <td>
                    <button class='btn btn-primary update-btn'
                            data-eid='{$row['id']}'>
                        Update
                    </button>
                </td>
              </tr>";
    }

} else {

    echo "<tr>
            <td colspan='7' class='text-center'>No Invoices Found</td>
          </tr>";
}

?>