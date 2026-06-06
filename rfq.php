
<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';

$page = "rfq";

$rfqs = mysqli_query(
$conn,
"SELECT * FROM rfqs
ORDER BY rfq_id DESC"
);

$totalRFQ = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM rfqs"
));

$openRFQ = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM rfqs
WHERE status='open'"
));

$closedRFQ = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM rfqs
WHERE status='closed'"
));
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>RFQ Management</title>

<link rel="stylesheet"
href="dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="main-content">

    <!-- Topbar -->

    <div class="topbar">

        <div>

            <h1>RFQ Management</h1>

            <p>
                Create and manage procurement requests
            </p>

        </div>

        <div class="profile">

            <i class="fa-solid fa-user-circle"></i>

        </div>

    </div>

    <!-- Statistics -->

    <div class="cards">

        <div class="card">

            <i class="fa-solid fa-file-contract"></i>

            <h2><?php echo $totalRFQ; ?></h2>

            <p>Total RFQs</p>

        </div>

        <div class="card">

            <i class="fa-solid fa-folder-open"></i>

            <h2><?php echo $openRFQ; ?></h2>

            <p>Open RFQs</p>

        </div>

        <div class="card">

            <i class="fa-solid fa-lock"></i>

            <h2><?php echo $closedRFQ; ?></h2>

            <p>Closed RFQs</p>

        </div>

        <div class="card">

            <i class="fa-solid fa-clock"></i>

            <h2>12</h2>

            <p>Pending Responses</p>

        </div>

    </div>

    <!-- RFQ Table -->

    <div class="section">

        <div class="section-header">

            <h2>RFQ Directory</h2>

            <div class="section-actions">

                <input
                type="text"
                class="search-input"
                placeholder="Search RFQs...">

                <a
                href="create_rfq.php"
                class="action-btn">

                    <i class="fa-solid fa-plus"></i>

                    Create RFQ

                </a>

            </div>

        </div>

        <table>

            <thead>

            <tr>

                <th>ID</th>
                <th>RFQ Title</th>
                <th>Quantity</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            <?php while($row=mysqli_fetch_assoc($rfqs)){ ?>

            <tr>

                <td>

                    #<?php echo $row['rfq_id']; ?>

                </td>

                <td>

                    <?php echo $row['rfq_title']; ?>

                </td>

                <td>

                    <?php echo $row['quantity']; ?>

                </td>

                <td>

                    <?php echo $row['deadline']; ?>

                </td>

                <td>

                    <?php
                    if($row['status']=="open")
                    {
                        echo '<span class="status approved">Open</span>';
                    }
                    else
                    {
                        echo '<span class="status rejected">Closed</span>';
                    }
                    ?>

                </td>

                <td>

                    <a
                    href="view_rfq.php?id=<?php echo $row['rfq_id']; ?>"
                    class="edit-btn">

                        <i class="fa-solid fa-eye"></i>

                    </a>

                    <a
                    href="edit_rfq.php?id=<?php echo $row['rfq_id']; ?>"
                    class="edit-btn">

                        <i class="fa-solid fa-pen"></i>

                    </a>

                    <a
                    href="delete_rfq.php?id=<?php echo $row['rfq_id']; ?>"
                    class="delete-btn"
                    onclick="return confirm('Delete RFQ?')">

                        <i class="fa-solid fa-trash"></i>

                    </a>

                </td>

            </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>