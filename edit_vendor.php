<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';

$id = $_GET['id'];

$vendor = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM vendors
WHERE vendor_id='$id'"
));

if(isset($_POST['update_vendor']))
{
    $vendor_name = mysqli_real_escape_string($conn,$_POST['vendor_name']);
    $vendor_category = mysqli_real_escape_string($conn,$_POST['vendor_category']);
    $gst_number = mysqli_real_escape_string($conn,$_POST['gst_number']);
    $contact_person = mysqli_real_escape_string($conn,$_POST['contact_person']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $status = $_POST['status'];

    mysqli_query($conn,"
    UPDATE vendors SET

    vendor_name='$vendor_name',
    vendor_category='$vendor_category',
    gst_number='$gst_number',
    contact_person='$contact_person',
    email='$email',
    phone='$phone',
    address='$address',
    status='$status'

    WHERE vendor_id='$id'
    ");

    header("Location: vendors.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Vendor</title>

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="main-content">

<div class="section">

<h2>
<i class="fa-solid fa-pen"></i>
Edit Vendor
</h2>

<form method="POST">

<div class="form-grid">

<div class="form-group">
<label>Vendor Name</label>
<input
type="text"
name="vendor_name"
value="<?php echo $vendor['vendor_name']; ?>"
required>
</div>

<div class="form-group">
<label>Vendor Category</label>
<input
type="text"
name="vendor_category"
value="<?php echo $vendor['vendor_category']; ?>">
</div>

<div class="form-group">
<label>GST Number</label>
<input
type="text"
name="gst_number"
value="<?php echo $vendor['gst_number']; ?>">
</div>

<div class="form-group">
<label>Contact Person</label>
<input
type="text"
name="contact_person"
value="<?php echo $vendor['contact_person']; ?>">
</div>

<div class="form-group">
<label>Email</label>
<input
type="email"
name="email"
value="<?php echo $vendor['email']; ?>">
</div>

<div class="form-group">
<label>Phone</label>
<input
type="text"
name="phone"
value="<?php echo $vendor['phone']; ?>">
</div>

<div class="form-group">
<label>Status</label>

<select name="status">

<option
value="active"
<?php if($vendor['status']=="active") echo "selected"; ?>>

Active

</option>

<option
value="inactive"
<?php if($vendor['status']=="inactive") echo "selected"; ?>>

Inactive

</option>

</select>

</div>

<div class="form-group full-width">

<label>Address</label>

<textarea
name="address"
rows="4"><?php echo $vendor['address']; ?></textarea>

</div>

</div>

<button
type="submit"
name="update_vendor"
class="action-btn">

Update Vendor

</button>

<a
href="vendors.php"
class="cancel-btn">

Cancel

</a>

</form>

</div>

</div>

</body>
</html>