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
                    <ul class='nav nav-tabs' id='myTab' role='tablist'>
                        <li class='nav-item' role='presentation'>
                            <button class='nav-link'
                                    id='addclient'
                                    data-bs-toggle='tab'
                                    data-bs-target='#home-tab-pane'
                                    type='button'
                                    role='tab'>
                                Add invoice
                            </button>
                        </li>
                    </ul>
                </td>
              </tr>";
    }
} else {
    echo "<tr>
            <td colspan='7' class='text-center'>No Invoices Found</td>
          </tr>";
}
?>