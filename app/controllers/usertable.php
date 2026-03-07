<?php


// if ($users && $users->num_rows > 0) {
//     while ($row = $users->fetch_assoc()) {
        
    
//         echo "<tr>
//                 <td>{$row['id']}</td>
//                 <td>{$row['name']}</td>
//                 <td>{$row['email']}</td>
//                 <td>{$row['phone']}</td>
//                 <td>{$row['status']}</td>
//                 <td>
//                     <button class='deletebutton btn btn-danger' data-id='{$row['id']}'>
//                         Delete
//                     </button>
//                 </td>
//                 <td>
//                     <button class='edit-btn btn btn-primary' data-eid='{$row['id']}'>
//                         Update
//                     </button>
//                 </td>
//             </tr>";
//     }
// } else {
   
//     echo "<tr>
//             <td colspan='7' class='text-center'>No Users Found</td>
//           </tr>";
// }


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
                    <button class='edit-btn btn btn-primary' data-eid='{$row['id']}'>
                        Update
                    </button>
                </td>
            </tr>";
    }
} else {
    echo "<tr>
            <td colspan='7' class='text-center'>No Users Found</td>
          </tr>";
}
?>