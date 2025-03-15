<?php
header("Content-Type: application/json");

# Quick Sort Algorithm with Database Insertion & Logging

function issort($arr) {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        if ($arr[$i] > $arr[$i + 1]) {
            return false;
        }
    }
    return true;
}

function isrevsort($arr) {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        if ($arr[$i] < $arr[$i + 1]) {
            return false;
        }
    }
    return true;
}

function qs($arr) {
    $n = count($arr);
    if ($n <= 1) {
        return $arr;
    } 
    if (issort($arr)) {
        return $arr;  // Already sorted, return as is
    }
    if (isrevsort($arr)) {
        return array_reverse($arr);  // Reverse sorted, return in ascending order
    }

    // Partitioning using first element as pivot
    $pivot = $arr[0];
    $left = $right = array();
    
    for ($i = 1; $i < $n; $i++) { // Start from 1 to exclude pivot
        if ($arr[$i] < $pivot) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }
    
    return array_merge(qs($left), array($pivot), qs($right));
}

# Database Connection
$con = mysqli_connect("localhost", "root", "", "test");
if (!$con) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

# Ensure Request is POST
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Invalid request method. Use POST"]);
    exit;
}

# Read JSON Input
$data = file_get_contents("php://input");
$data = json_decode($data, true); // Convert to associative array

if (empty($data) || !isset($data['arr'])) {
    http_response_code(400);
    echo json_encode(["error" => "No valid data found"]);
    exit;
}

# Handle Empty Array Case
if (empty($data['arr'])) {
    http_response_code(400);
    echo json_encode(["error" => "The array is empty, no data inserted"]);
    exit;
}

# Process Input
$algo = "Quick Sort";
$input = json_encode($data['arr']);
$output = json_encode(qs($data['arr']));

# Escape Strings for Security
$algo = mysqli_real_escape_string($con, $algo);
$input = mysqli_real_escape_string($con, $input);
$output = mysqli_real_escape_string($con, $output);

# Insert into Database with Logging
$sql = "INSERT INTO db_algo (algorithm, input, output) VALUES ('$algo', '$input', '$output')";
$rs = mysqli_query($con, $sql);

if ($rs) {
    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Data successfully inserted into the database",
        "algorithm" => $algo,
        "input" => json_decode($input),  // Return as array
        "output" => json_decode($output) // Return as array
    ]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database insertion failed", "details" => mysqli_error($con)]);
}

# Close Connection
mysqli_close($con);
?>