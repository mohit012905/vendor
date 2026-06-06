<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';

if(isset($_POST['add_vendor']))
{
    $vendor_name = mysqli_real_escape_string($conn,$_POST['vendor_name']);
    $vendor_category = mysqli_real_escape_string($conn,$_POST['vendor_category']);
    $gst_number = mysqli_real_escape_string($conn,$_POST['gst_number']);
    $contact_person = mysqli_real_escape_string($conn,$_POST['contact_person']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);

    mysqli_query($conn,"
    INSERT INTO vendors
    (
        vendor_name,
        vendor_category,
        gst_number,
        contact_person,
        email,
        phone,
        address,
        status
    )
    VALUES
    (
        '$vendor_name',
        '$vendor_category',
        '$gst_number',
        '$contact_person',
        '$email',
        '$phone',
        '$address',
        'active'
    )
    ");

    header("Location: vendors.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Vendor</title>

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="main-content">

<div class="section">

<h2>
<i class="fa-solid fa-user-plus"></i>
Add Vendor
</h2>

<form method="POST">

<div class="form-grid">

<div class="form-group">
<label>Vendor Name</label>
<input type="text" name="vendor_name" required>
</div>

<div class="form-group">
<label>Vendor Category</label>
<input type="text" name="vendor_category" required>
</div>

<div class="form-group">
<label>GST Number</label>
<input type="text" name="gst_number">
</div>

<div class="form-group">
<label>Contact Person</label>
<input type="text" name="contact_person">
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email">
</div>

<div class="form-group">
<label>Phone</label>
<input type="text" name="phone">
</div>

<div class="form-group full-width">
<label>Address</label>
<textarea
name="address"
rows="4"></textarea>
</div>

</div>

<button
type="submit"
name="add_vendor"
class="action-btn">

Save Vendor

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