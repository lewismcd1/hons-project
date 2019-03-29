<div class="wrapper">

    <nav id="sidebar">
        <div class="sidebar-header">
            <a class="navbar-brand" href="index.php">Stock Management</a>
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="index.php"><i class="fa fa-home" style="margin-right: 4%;"></i>Dashboard </a>
            </li>
            <li>
                <a href="manage_categories.php"><i class="far fa-clone" style="margin-right: 4.5%;"></i></i>Categories</a>
            </li>
            <li>
                <a href="manage_brand.php"><i class="fas fa-tags" style="margin-right: 3%; margin-left: -1%"></i></i>Brands</a>
            </li>
            <li>
                <a href="manage_products.php"><i class="fas fa-box" style="margin-right: 4.5%;"></i></i>Products</a>
            </li>
            <li>
                <a href="new_order.php"><i class="fas fa-dolly" style="margin-right: 3.5%; margin-left: -1%;"></i>Orders</a>
            </li>
            <li>
                <a href="manage_invoice.php"><i class="fas fa-file-invoice" style="margin-right: 4.9%; margin-left: 1%"></i>Invoices</a>
            </li>
        </ul>
        <?php
        if (isset($_SESSION["userid"])) {
            ?>
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="logout.php" class="article"><i class="fa fa-user"></i>
                        Sign Out</a>
                </li>
            </ul>
        <?php } ?>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="./index.php">Home</a>
                        </li>
                        <?php
                        if (isset($_SESSION["userid"])) {
                            ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="./logout.php">Sign Out</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
        </nav>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
                });
            });
            
        </script>
