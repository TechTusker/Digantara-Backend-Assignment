<?php
// Database Connection
$con = mysqli_connect("localhost", "root", "", "test");
if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Function to check if array is sorted
function issort($arr) {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) { // Fix loop to prevent out-of-bounds error
        if ($arr[$i + 1] < $arr[$i]) {
            return false;
        }
    }
    return true;
}

// Binary Search Function
function bs($arr, $value) {
    if (empty($arr)) {
        return -1;
    }

    // Preserve original indexes
    $originalIndexes = array_keys($arr);
    $sortedArr = $arr; // Work on a copy of the array

    if (!issort($arr)) {
        array_multisort($sortedArr, $originalIndexes);
    }

    $low = 0;
    $high = count($sortedArr) - 1;

    while ($low <= $high) {
        $mid = floor(($low + $high) / 2);
        if ($sortedArr[$mid] == $value) {
            return $originalIndexes[$mid]; // Return original index
        }
        if ($value < $sortedArr[$mid]) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }
    return -1; // Element not found
    #returned value is index and the array has 0-based indexing
}

// Ensure request is POST
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    #error in method
    echo "400 Bad Request";
    exit;
}

// Read JSON Input
$data = file_get_contents("php://input");
$data = json_decode($data);

if (empty($data)) {
    echo "No data found";
    exit;
}

if (isset($data->arr) && isset($data->value)) {
    $index = bs($data->arr, $data->value);
    $algo = "Binary Search";
    $input = json_encode($data->arr, JSON_UNESCAPED_UNICODE);
    
    if ($index !== -1) {
        $output = $data->value . " Exists at index " . $index;
        echo $data->value . " Exists at index " . $index;
    } else {
        $output = $data->value . " Does not Exist";
        echo $data->value . " Does not Exist";
    }

    // Escape input values for security preventing SQL injection
    $algo = mysqli_real_escape_string($con, $algo);
    $input = mysqli_real_escape_string($con, $input);
    $output = mysqli_real_escape_string($con, $output);

    // Fix column name in query
    $query = "INSERT INTO db_algo (algorithm, input, output) VALUES ('$algo', '$input', '$output')";
    if (!mysqli_query($con, $query)) {
        echo "Database Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid input format";
}

// Close database connection
mysqli_close($con);
?>