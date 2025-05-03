<?php
require_once 'conf.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IAMS - Coordinator Dashboard</title>
    <link rel="stylesheet" href="match.css">
</head>
<body>
    <div class="container">
        <h1>Industrial Attachment Matching System</h1>
        
        <div class="filters">
            <h2>Filters</h2>
            <select id="locationFilter">
                <option value="">All Locations</option>
                <?php
                global $pdo;
                $locations = $pdo->query("SELECT DISTINCT preferred_Location FROM studentsTable2")->fetchAll(PDO::FETCH_COLUMN);
                foreach ($locations as $loc) {
                    echo "<option value='$loc'>$loc</option>";
                }
                ?>
            </select>
            <button onclick="runMatching()">Run Matching Algorithm</button>
        </div>

        <div class="results">
            <h2>Matching Results</h2>
            <table id="matchesTable">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Skills</th>
                        <th>Organization</th>
                        <th>Org Skills</th>
                        <th>Match Score</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Filled by AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function runMatching() {
            console.log("Running matching...");
            const location = document.getElementById('locationFilter').value;
            
            fetch('match.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ location })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log("Received data:", data);
                const table = document.querySelector('#matchesTable tbody');
                table.innerHTML = '';
                
                if (data.matches && data.matches.length > 0) {
                    data.matches.forEach(match => {
                        const row = `
                            <tr>
                                <td>${match.student_id}</td>
                                <td>${match.student_skills}</td>
                                <td>${match.org_name}</td>
                                <td>${match.org_skills}</td>
                                <td>${Math.round(match.score * 100)}%</td>
                                <td>
                                    <button onclick="confirmMatch('${match.student_id}', ${match.org_id})">Confirm</button>
                                </td>
                            </tr>
                        `;
                        table.innerHTML += row;
                    });
                } else {
                    table.innerHTML = '<tr><td colspan="6">No matches found</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error running matching: ' + error.message);
            });
        }

        function confirmMatch(studentId, orgId) {
            console.log("Confirming match:", studentId, orgId);
            fetch('match2.php?action=confirm', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ studentId, orgId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("Match confirmed!");
                } else {
                    alert("Failed to confirm match");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error confirming match: ' + error.message);
            });
        }
    </script>
</body>
</html>