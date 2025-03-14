# Digantara Backend Developer Assignment

## Overview
This project is designed to demonstrate proficiency in backend development, algorithm implementation, and API design. It includes three RESTful APIs implemented in PHP using XAMPP and MySQL. Each API executes a fundamental data structure algorithm and logs all requests in a MySQL database for tracking and persistence. The implemented algorithms are:
- **Binary Search**: Efficiently searches for an element in a sorted array.
- **Quick Sort**: Sorts an array using the divide-and-conquer strategy.
- **Breadth-First Search (BFS)**: Traverses a graph structure level by level.

These APIs are designed to handle input validation, error responses, and structured logging to ensure a robust and efficient backend system.

## Technologies Used
This project leverages the following technologies to implement and deploy the backend solution:
- **PHP**: The core programming language used to implement API logic.
- **XAMPP**: A local server environment that includes Apache, MySQL, and PHP.
- **MySQL**: A relational database used for storing API logs, including input and output data.
- **Postman**: A tool for testing API requests and responses.

## Database Setup
To ensure proper logging of API requests, set up a MySQL database by following these steps:
1. Open the XAMPP Control Panel and start **Apache** and **MySQL**.
2. Open `phpMyAdmin` and create a new database named `test`.
3. Run the following SQL command to create a table for storing API call logs:
   ```sql
   CREATE TABLE db_algo (
       id INT AUTO_INCREMENT PRIMARY KEY,
       algorithm VARCHAR(100),
       input VARCHAR(100),
       output VARCHAR(100),
       timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```
   This table will automatically record each API call, storing details about the algorithm used, input provided, output generated, and the timestamp of execution.

## Installation and Setup
To set up the project locally, follow these steps:
1. Download and install **XAMPP** from [Apache Friends](https://www.apachefriends.org/).
2. Copy the PHP API files (`binary_search.php`, `quick_sort.php`, and `bfs.php`) into the `htdocs` directory of your XAMPP installation.
3. Start the XAMPP Control Panel and ensure both **Apache** and **MySQL** services are running.
4. Open a browser and go to `http://localhost/phpmyadmin/` to verify the database setup.
5. Use **Postman** or `cURL` to test API endpoints by sending POST requests with the required JSON payloads.

## API Endpoints
Each algorithm has a dedicated API endpoint that receives input in JSON format and returns a structured JSON response. All API calls are logged in the database.

### 1. **Binary Search API**
This API performs a binary search on a sorted array and returns the index of the searched element if found.
- **Endpoint**: `/binary_search.php` eg.[(http://localhost:8080/learn/project/bs.php)]
- **Method**: `POST`
- **Request Body (JSON Format)**:
  ```json
  {
      "arr": [2, 4, 6, 8, 10],
      "value": 6
  }
  ```
- **Response Example**:
  ```json
  {
      "status": "success",
      "algorithm": "Binary Search",
      "input": [2, 4, 6, 8, 10],
      "output": "6 Exists at index 2"
  }
  ```

### 2. **Quick Sort API**
This API sorts an array using the Quick Sort algorithm and returns the sorted output.
- **Endpoint**: `/quick_sort.php` eg.[(http://localhost:8080/learn/project/qs.php)]
- **Method**: `POST`
- **Request Body (JSON Format)**:
  ```json
  {
      "arr": [9, 4, 7, 3, 1]
  }
  ```
- **Response Example**:
  ```json
  {
      "status": "success",
      "algorithm": "Quick Sort",
      "input": [9, 4, 7, 3, 1],
      "output": [1, 3, 4, 7, 9]
  }
  ```

### 3. **Breadth-First Search (BFS) API**
This API performs a BFS traversal on a graph and returns the visited nodes in order.
- **Endpoint**: `/bfs.php` eg.[(http://localhost:8080/learn/project/bfs.php)]
- **Method**: `POST`
- **Request Body (JSON Format)**:
  ```json
  {
      "start": "A",
      "graph": {
          "A": ["B", "C"],
          "B": ["A", "D", "E"],
          "C": ["A", "F"],
          "D": ["B"],
          "E": ["B", "F"],
          "F": ["C", "E"]
      }
  }
  ```
- **Response Example**:
  ```json
  {
      "status": "success",
      "algorithm": "BFS",
      "input": {
          "A": ["B", "C"],
          "B": ["A", "D", "E"],
          "C": ["A", "F"],
          "D": ["B"],
          "E": ["B", "F"],
          "F": ["C", "E"]
      },
      "output": [["A", "B", "C", "D", "E", "F"]]
  }
  ```

## Accessing Logs
To review API call logs stored in the database, execute the following SQL query in `phpMyAdmin` or a MySQL terminal:
```sql
SELECT * FROM db_algo;
```
This will display all logged API requests along with their inputs, outputs, and timestamps.

## Error Handling
The APIs include robust error handling mechanisms to manage various types of failures:
- **Invalid request method** (`405 Method Not Allowed`) – Ensures only `POST` requests are accepted.
- **Missing or incorrect input data** (`400 Bad Request`) – Returns an error if required parameters are missing or incorrectly formatted.
- **Database connection failure** (`500 Internal Server Error`) – Handles cases where the database is unreachable or misconfigured.
- **Edge cases** – Handles cases such as empty arrays, self-loops in BFS, and unsorted arrays in Binary Search.

## Optional Enhancements
This project can be extended in several ways to improve performance, usability, and deployment flexibility:
- **Deployment**: The APIs can be hosted on a cloud-based PHP server such as AWS, DigitalOcean, or Heroku.
- **Dockerization**: The application can be containerized using Docker for streamlined deployment and scalability.
- **Authentication**: Implementing API keys or JWT authentication can enhance security.
- **Rate Limiting**: Prevent abuse by limiting the number of API requests per minute.

## Author
This project was developed as part of the Digantara Backend Developer Assignment 2025. It showcases proficiency in backend API development, data structure implementation, and MySQL integration.
