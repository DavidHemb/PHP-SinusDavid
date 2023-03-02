<?php 
$customers = User::GetAllCustomersFromDB();

?>


<h3>Customers</h3>
<table>
    <thead>
        <tr>
            <th scope="col">Customer Id</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">City</th>
            <th scope="col">Street Adress</th>
            <th scope="col">Zip Code</th>
            <th scope="col">Phone Number</th>
            <th scope="col">E-Mail</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php for ($i = 0; $i < count($customers); $i++) {  ?>
            <tr>

                <td><?= $customers[$i]["user_id"]; ?></td>
                <td><?= $customers[$i]["username"]; ?></td>
                <td><?= $customers[$i]["name"]; ?></td>
                <td><?= $customers[$i]["city"]; ?></td>
                <td><?= $customers[$i]["address"]; ?></td>
                <td><?= $customers[$i]["zipcode"]; ?></td>
                <td><?= $customers[$i]["phone"]; ?></td>
                <td><?= $customers[$i]["email"]; ?></td>

            </tr>


        <?php  }  ?>
            
        </tr>
    </tbody>
</table>