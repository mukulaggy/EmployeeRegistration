<!-- index.php -->
<?php 
require_once __DIR__ . '/backend/get_employees.php';
include __DIR__ . '/includes/header.php';
?>

<main class="container">
    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <button class="tab-button active" onclick="openTab(event, 'registerTab')">Register Employee</button>
        <button class="tab-button" onclick="openTab(event, 'viewTab')">View Employees</button>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert success">Employee registered successfully!</div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="alert error">Error registering employee!</div>
    <?php endif; ?>

    <!-- Register Tab -->
    <div id="registerTab" class="tab-content active">
        <h2>Register New Employee</h2>
        <form id="employeeForm" action="backend/create_employee.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="department">Department:</label>
                <select class="form-control" id="department" name="department" required>
                    <option value="">Select Department</option>
                    <option value="IT">IT</option>
                    <option value="HR">HR</option>
                    <option value="Finance">Finance</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Operations">Operations</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            
            <div class="form-group">
                <label for="hire_date">Hire Date:</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" required>
            </div>
            
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" class="form-control" id="salary" name="salary" step="0.01" required>
            </div>
            
            <button type="submit" class="btn">Register Employee</button>
        </form>
    </div>

    <!-- View Tab -->
    <div id="viewTab" class="tab-content">
        <h2>All Employees</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Hire Date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (getEmployees() as $employee): ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td><?php echo htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($employee['email']); ?></td>
                        <td><?php echo htmlspecialchars($employee['department']); ?></td>
                        <td><?php echo htmlspecialchars($employee['position']); ?></td>
                        <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>
                        <td>$<?php echo number_format($employee['salary'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Add this before closing body tag in footer.php -->
<script>
function openTab(evt, tabName) {
    // Hide all tab content
    var tabContents = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = "none";
    }

    // Remove active class from all tab buttons
    var tabButtons = document.getElementsByClassName("tab-button");
    for (var i = 0; i < tabButtons.length; i++) {
        tabButtons[i].className = tabButtons[i].className.replace(" active", "");
    }

    // Show the selected tab content and mark the button as active
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Show register tab by default
document.getElementById("registerTab").style.display = "block";
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>