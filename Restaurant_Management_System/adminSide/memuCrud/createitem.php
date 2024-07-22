<?php
session_start(); // Ensure session is started
?>
<?php  include '../inc/dashHeader.php'?>
<?php
// Include index file
require_once "../index.php";
 
$input_item_id = $item_id_err = $item_id = "";
 
// Processing form data when form is submitted
if(isset($_POST['submit'])){
    if (empty($_POST['item_id'])) {
    $item_idErr = 'ID is required';
  } else {
    // $item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $item_id = filter_input(
      INPUT_POST,
      'item_id',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
    
}
?>
<head>
    <meta charset="UTF-8">
    <title>Create New Item</title>
    <style>
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>

 <div class="wrapper" >
    <h3>Create New Item</h1>
    <p>Please fill Items Information Properly </p>
    
<form method="POST" action="success_create.php" class="ht-600 w-50">
    
        <div class="form-group">
            <label for="item_id" class="form-label">Item ID :</label>
            <input type="text" name="item_id" class="form-control <?php echo !$item_idErr ?:
                'is-invalid'; ?>" id="item_id" required item_id="item_id" placeholder="S1" value="<?php echo $item_id; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
            Please provide a valid item_id.
            </div>
        </div>
    
        <div class="form-group"> 
            <label for="item_name">Item Name :</label>
            <input type="text" name="item_name" id="item_name" placeholder="Soup" required class="form-control <?php echo (!empty($itemname_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>
        
        <div class="form-group">
            <label for="item_type">Item Type:</label>
            <select name="item_type" id="item_type" class="form-control placeholder="Select Item Type" <?php echo (!empty($itemtype_err)) ? 'is-invalid' : ''; ?>" required>
                <option value="">Select Item Type</option>
                <option value="Fish">Fish</option>
                <option value="Beef">Beef</option>
                <option value="Chicken">Chicken</option>
                <option value="Soup">Soup</option>
                <option value="Energy Drink">Energy Drink</option>
            </select>
            <span class="invalid-feedback"></span>
        </div><br>
        
        <div class="form-group">
            <label for="item_category">Item Category:</label>
            <select name="item_category" id="item_category" class="form-control <?php echo (!empty($itemcategory_err)) ? 'is-invalid' : ''; ?>" required>
                <option value="">Select Item Category</option>
                <option value="Main Dishes">Main Dishes</option>
                <option value="Side Snacks">Side Snacks</option>
                <option value="Drinks">Drinks</option>
            </select>
            <span class="invalid-feedback"></span>
        </div><br>
        
        <div class="form-group">
            <label for="item_price">Item Price :</label>
            <input min='0.01' type="number" name="item_price" id="item_price" placeholder="12.34" step="0.01" required class="form-control <?php echo (!empty($itemprice_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>
        
        <div class="form-group">
            <label for="item_description">Item Description :</label>
            <textarea name="item_description" id="item_description" rows="4" placeholder="The dish...." required class="form-control <?php echo (!empty($itemdescription_err)) ? 'is-invalid' : ''; ?>" ></textarea><br>
            <span class="invalid-feedback"></span>
        </div>
        
        <div class="form-group">
            <input type="submit" class="btn btn-dark" value="Create Item">
        </div>    
        
    
 </form>
 </div>
 
