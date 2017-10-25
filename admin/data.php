<?php
// Database details
$db_server   = 'localhost';
$db_username = 'ourstories';
$db_password = 'ourstories';
$db_name     = 'ourstories';

// Get job (and id)
$job = '';
$id  = '';
if (isset($_GET['job'])){
  $job = $_GET['job'];
  if ($job == 'get_companies' ||
      $job == 'get_company'   ||
      $job == 'add_company'   ||
      $job == 'edit_company'  ||
      $job == 'delete_company'){
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      if (!is_numeric($id)){
        $id = '';
      }
    }
  } else {
    $job = '';
  }
}

// Prepare array
$mysql_data = array();

// Valid job found
if ($job != ''){
  
  // Connect to database
  $db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }
  
  // Execute job
  if ($job == 'get_companies'){
    
    // Get companies
    $query = "SELECT * FROM company ORDER BY id";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['company_id'] . '" data-name="' . $company['company_name'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['company_id'] . '" data-name="' . $company['company_name'] . '"><span>Delete</span></a></li>';
        $functions .= '</ul></div>';
        $mysql_data[] = array(
          "id"          => $company['id'],
          "companyName"  => $company['companyName'],
          "street"    => $company['street'],
           "postnr"     => number_format($company['postnr'], 0, '.', ','),
          "city"       => $company['city'],
          "description"   => $company['description'],
          
          "website"    => $company['website'],
          "facebook"  => $company['facebook'],
          "functions"     => $functions
        );
      }
    }
    
  } elseif ($job == 'get_company'){
    
    // Get company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "SELECT * FROM company WHERE companyID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
            "id"          => $company['id'],
            "companyName"  => $company['companyName'],
            "street"    => $company['street'],
            "postnr"       => $company['postnr'],
            "city"   => $company['city'],
            "description"     => $company['description'],
            "website"    => $company['website'],
            "facebook"  => $company['facebook']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO company SET ";
    if (isset($_GET['id']))         { $query .= "id         = '" . mysqli_real_escape_string($db_connection, $_GET['id'])         . "', "; }
    if (isset($_GET['companyName'])) { $query .= "companyName = '" . mysqli_real_escape_string($db_connection, $_GET['companyName']) . "', "; }
    if (isset($_GET['street']))   { $query .= "street   = '" . mysqli_real_escape_string($db_connection, $_GET['street'])   . "', "; }
    if (isset($_GET['postnr']))      { $query .= "postnr      = '" . mysqli_real_escape_string($db_connection, $_GET['postnr'])      . "', "; }
    if (isset($_GET['city']))  { $query .= "city  = '" . mysqli_real_escape_string($db_connection, $_GET['city'])  . "', "; }
    if (isset($_GET['description']))    { $query .= "description    = '" . mysqli_real_escape_string($db_connection, $_GET['description'])    . "', "; }
    if (isset($_GET['website']))   { $query .= "website   = '" . mysqli_real_escape_string($db_connection, $_GET['website'])   . "', "; }
    if (isset($_GET['facebook'])) { $query .= "facebook = '" . mysqli_real_escape_string($db_connection, $_GET['facebook']) . "'";   }
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
    }
  
  } elseif ($job == 'edit_company'){
    
    // Edit company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "UPDATE company SET ";
    if (isset($_GET['id']))         { $query .= "id         = '" . mysqli_real_escape_string($db_connection, $_GET['id'])         . "', "; }
    if (isset($_GET['companyName'])) { $query .= "companyName = '" . mysqli_real_escape_string($db_connection, $_GET['companyName']) . "', "; }
    if (isset($_GET['street']))   { $query .= "street   = '" . mysqli_real_escape_string($db_connection, $_GET['street'])   . "', "; }
    if (isset($_GET['postnr']))      { $query .= "postnr      = '" . mysqli_real_escape_string($db_connection, $_GET['postnr'])      . "', "; }
    if (isset($_GET['city']))  { $query .= "city  = '" . mysqli_real_escape_string($db_connection, $_GET['city'])  . "', "; }
    if (isset($_GET['description']))    { $query .= "description    = '" . mysqli_real_escape_string($db_connection, $_GET['description'])    . "', "; }
    if (isset($_GET['website']))   { $query .= "website   = '" . mysqli_real_escape_string($db_connection, $_GET['website'])   . "', "; }
    if (isset($_GET['facebook'])) { $query .= "facebook = '" . mysqli_real_escape_string($db_connection, $_GET['facebook']) . "'";   }
      $query .= "WHERE companyID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query  = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
    
  } elseif ($job == 'delete_company'){
  
    // Delete company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "DELETE FROM company WHERE companyID = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
  
  }
  
  // Close database connection
  mysqli_close($db_connection);

}

// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);

// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;
?>