<?php
header("Content-Type: application/json");

// Database Connection
$conn = new mysqli("localhost", "root", "", "test");

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Function to check if the graph is empty
function isGraphEmpty($graph) {
    return empty($graph);
}

// Function to detect self-loops and log them separately
function detectSelfLoops($graph) {
    $selfLoops = [];
    foreach ($graph as $node => $neighbors) {
        foreach ($neighbors as $neighbor) {
            if ($node === $neighbor) {
                $selfLoops[] = $node; // Store nodes that have self-loops
            }
        }
    }
    return $selfLoops;
}

// Function to perform BFS for a single component while ignoring self-loops in traversal
function bfsComponent($graph, $start, &$visited) {
    $queue = [$start];
    $result = [];

    while (!empty($queue)) {
        $node = array_shift($queue);
        if (!isset($visited[$node])) {
            $visited[$node] = true;
            $result[] = $node;

            foreach ($graph[$node] as $neighbor) {
                if (!isset($visited[$neighbor])) {
                    $queue[] = $neighbor;
                }
            }
        }
    }
    return $result;
}

// Function to perform BFS for a disconnected graph
function bfsDisconnected($graph) {
    $visited = [];
    $components = [];

    foreach ($graph as $node => $neighbors) {
        if (!isset($visited[$node])) {
            $components[] = bfsComponent($graph, $node, $visited);
        }
    }
    return $components;
}

// Handle API request
$data = file_get_contents("php://input");
$data = json_decode($data, true); // Convert JSON object to associative array

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Invalid request method. Use POST"]);
    exit;
}

// Validate input structure
if (!isset($data["start"]) || !isset($data["graph"])) {
    http_response_code(400);
    echo json_encode(["error" => "Start node or graph not provided"]);
    exit;
}

$startNode = $data["start"];
$graph = $data["graph"];

// Edge case handling
if (isGraphEmpty($graph)) {
    http_response_code(400);
    echo json_encode(["error" => "Graph is empty"]);
    exit;
}

// Detect self-loops
$selfLoops = detectSelfLoops($graph);

// Perform BFS
$bfsResult = bfsDisconnected($graph);
$output = [
    "bfs_result" => $bfsResult,
    "self_loops" => array_values(array_unique($selfLoops)) // Remove duplicates
];

// Convert JSON data safely for MySQL
$graphJson = mysqli_real_escape_string($conn, json_encode($graph));
$outputJson = mysqli_real_escape_string($conn, json_encode($output));
$algo = "BFS";

// Insert result into database
$sql = "INSERT INTO db_algo (algorithm, input, output) VALUES ('$algo', '$graphJson', '$outputJson')";

if ($conn->query($sql) === TRUE) {
    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "BFS result stored successfully",
        "algorithm" => $algo,
        "input" => json_decode($graphJson),  // Return as array
        "output" => json_decode($outputJson) // Return as array
    ]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error storing BFS result: " . $conn->error]);
}

// Close connection
$conn->close();
?>
