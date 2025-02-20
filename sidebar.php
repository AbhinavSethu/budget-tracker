<div class="border-right" id="sidebar-wrapper">
    <div class="user">
        <img class="img img-fluid rounded-circle" src="uploads/default_profile.png" width="120">
        <h5><?php echo $username; ?></h5>
        <p><?php echo $useremail; ?></p>
    </div>
    <div class="sidebar-heading">Management</div>
    <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
        <a href="add_expense.php" class="list-group-item list-group-item-action"><span data-feather="plus-square"></span> Add Expenses</a>
        <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expenses</a>
        <a href="expensereport.php" class="list-group-item list-group-item-action"><span data-feather="file-text"></span> Expense Report</a>
        <a href="add_income.php" class="list-group-item list-group-item-action"><span data-feather="file-text"></span> Add Income</a>
    </div>
    <div class="sidebar-heading">Settings</div>
    <div class="list-group list-group-flush">
        <a href="profile.php" class="list-group-item list-group-item-action"><span data-feather="user"></span> Profile</a>
        <a href="logout.php" class="list-group-item list-group-item-action"><span data-feather="power"></span> Logout</a>
    </div>
</div>
