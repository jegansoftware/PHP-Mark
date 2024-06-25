<?php
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "studmark";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regNo = $_POST['reg_no'];
    $dob = $_POST['dob'];

    // Query to retrieve marks based on Reg No and DOB
    $sql = "SELECT name, tamil, english, maths, science, social
            FROM mark 
            WHERE reg = '$regNo' AND dob = '$dob'";

      
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Start Bootstrap HTML output
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Student Marks</title>';
        // Bootstrap CSS link
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
        echo '</head>';
        echo '<body>';

        // Container for Bootstrap
        echo '<div class="container">';
        echo '<br>';
        // Table responsive div
        echo '<div class="table-responsive">';
        // Bootstrap table
        echo '<table class="table table-bordered">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Tamil</th>';
        echo '<th>English</th>';
        echo '<th>Maths</th>';
        echo '<th>Science</th>';
        echo '<th>Social Science</th>';
        echo '<th>Total</th>';
        echo '<th>Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $tamil1=$row["tamil"] ;
            $english1=$row["english"] ;
            $maths1=$row["maths"] ;
            $science1=$row["science"] ;
            $social1=$row["social"] ;
            $status;
            if($tamil1>=35 && $english1>=35 && $maths1>=35 && $science1>=35 && $social1>=35)
            {
                $status="PASS";
            }
            else
            {
                $status="FAIL";
            }

            echo '<tr>';
            echo '<td>' . $row["name"] . '</td>';
            
            if($tamil1>=35)
            {
                echo '<td><b style="color:green;">' . $row["tamil"] . '</b></td>';
            }
            else if($tamil1<35){
                echo '<td><b style="color:red;">' . $row["tamil"] . '</b></td>';
            }

            if($english1>=35)
            {
                echo '<td><b style="color:green;">' . $row["english"] . '</b></td>';
            }
            else if($english1<35){
                echo '<td><b style="color:red;">' . $row["english"] . '</b></td>';
            }

            if($maths1>=35)
            {
                echo '<td><b style="color:green;">' . $row["maths"] . '</b></td>';
            }
            else if($maths1<35){
                echo '<td><b style="color:red;">' . $row["maths"] . '</b></td>';
            }

            if($science1>=35)
            {
                echo '<td><b style="color:green;">' . $row["science"] . '</b></td>';
            }
            else if($science1<35){
                echo '<td><b style="color:red;">' . $row["science"] . '</b></td>';
            }

            
            if($social1>=35)
            {
                echo '<td><b style="color:green;">' . $row["social"] . '</b></td>';
            }
            else if($social1<35){
                echo '<td><b style="color:red;">' . $row["social"] . '</b></td>';
            }

            echo '<td><b>' . $total=$row["tamil"]+$row["english"]+$row["maths"]+$row["science"]+$row["social"] . '</b></td>';

            echo '<td><b>' . $status . '</b></td>';
           
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>'; // end table-responsive div
        echo '</div>'; // end container div

        // Bootstrap JS and dependencies
        echo '<!-- Bootstrap JS and dependencies -->';
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

        echo '</body>';
        echo '</html>';
    } else {
        echo "No records found for the provided Registration Number and Date of Birth.";
    }
    
    $conn->close();
}
?>
