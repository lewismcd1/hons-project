$(document).ready(function () {

    /* --------------CATEGORY-------------- */

    //Fetch category for add
    fetch_category();
    function fetch_category() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {getCategory: 1},
            success: function (data) {
                var root = "<option value='0'>Root Category</option>";
                var choose = "<option value=''>Choose Category</option>";
                $("#parent_cat").html(root + data);
                $("#select_cat").html(choose + data);
            }

        })
    }

    //Add category
    $("#category_form").on("submit", function () {
        if ($("#category_name").val() == "") {
            $("#category_name").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please enter a category name.</span>")
        } else {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: $("#category_form").serialize(),
                success: function (data) {
                    if (data == "CATEGORY_ADDED") {
                        $("#category_name").removeClass("border-danger");
                        $("#cat_error").html("<span class='text-success'>Category Added</span>");
                        $("#category_name").val("");
                        fetch_category();
                    } else {
                        alert(data);
                    }
                    $('#form-category').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }
            })
        }
    })

//Manage category
    manageCategory();
    function manageCategory() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {manageCategory: 1},
            success: function (data) {
                $("#get_category").html(data);
                $('#category_data').DataTable({
                    "destroy": true,
                });
            }
        })
    }

    //Delete category
    $("body").delegate(".del_cat", "click", function () {
        var did = $(this).attr("did");
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: {deleteCategory: 1, id: did},
                success: function (data) {
                    if (data == "DEPENDANT_CATEGORY") {
                        alert("Could not delete.");
                    } else if (data == "CATEGORY_DELETED") {
                        alert("Category successfully deleted");
                        location.reload();
                    } else if (data == "DELETED") {
                        alert("Deleted successfully");
                        location.reload();
                    } else {
                        alert(data);
                    }
                }
            })
        } else {

        }
    })

    //Fetch category for edit
    fetch_update_category();
    function fetch_update_category() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {getCategory: 1},
            success: function (data) {
                var root = "<option value='0'>Root</option>";
                var choose = "<option value=''>Choose Category</option>";
                $("#update_parent_cat").html(root + data);
                $("#update_select_cat").html(choose + data);
            }
        })
    }


    //Update Category
    $("body").delegate(".edit_cat", "click", function () {
        var eid = $(this).attr("eid");
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            dataType: "json",
            data: {updateCategory: 1, id: eid},
            success: function (data) {
                console.log(data);
                $("#cid").val(data["cid"]);
                $("#update_category_name").val(data["category_name"]);
                $("#update_parent_cat").val(data["parent_cat"]);
            }
        })
    })

    $("#update_category_form").on("submit", function () {
        if ($("#update_category_name").val() == "") {
            $("#update_category_name").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        } else {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: $("#update_category_form").serialize(),
                success: function (data) {
                    window.location.href = "";
                }
            })
        }
    })


    //--------------------  Brand -----------------------

    //Fetch brand for add
    fetch_brand();
    function fetch_brand() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {getBrand: 1},
            success: function (data) {
                var choose = "<option value=''>Choose Brand</option>";
                $("#select_brand").html(choose + data);
            }

        })
    }

    //Add brand
    $("#brand_form").on("submit", function () {
        if ($("#brand_name").val() == "") {
            $("#brand_name").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please enter a brand name.</span>")
        } else {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: $("#brand_form").serialize(),
                success: function (data) {
                    if (data == "BRAND_ADDED") {
                        $("#brand_name").removeClass("border-danger");
                        $("#brand_error").html("<span class='text-success'>Brand name Added</span>");
                        $("#brand_name").val("");
                        fetch_brand();
                    } else {
                        alert(data);
                    }
                    $('#form-brand').on('hidden.bs.modal', function () {
                        location.reload();
                    });

                }
            })
        }
    })
    //Fetch brand for edit
    fetch_update_brand();
    function fetch_update_brand() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {getBrand: 1},
            success: function (data) {
                var choose = "<option value=''>Choose Brand</option>";
                $("#update_select_brand").html(choose + data);
            }

        })
    }

    //Manage brand
    manageBrand();

    function manageBrand() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {manageBrand: 1},
            success: function (data) {
                $("#get_brand").html(data);
                $('#brand_data').DataTable({
                    "destroy": true,
                });
            }
        })
    }

    //Delete brand
    $("body").delegate(".del_brand", "click", function () {
        var did = $(this).attr("did");
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: {deleteBrand: 1, id: did},
                success: function (data) {
                    if (data == "DELETED") {
                        alert("Deleted successfully");
                        location.reload();
                    } else {
                        alert(data);
                    }
                }
            })
        }
    })

    //Update Brand
    $("body").delegate(".edit_brand", "click", function () {
        var eid = $(this).attr("eid");
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            dataType: "json",
            data: {updateBrand: 1, id: eid},
            success: function (data) {
                console.log(data);
                $("#bid").val(data["bid"]);
                $("#update_brand_name").val(data["brand_name"]);
            }
        })
    })

    $("#update_brand_form").on("submit", function () {
        if ($("#update_brand_name").val() == "") {
            $("#update_brand_name").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        } else {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: $("#update_brand_form").serialize(),
                success: function (data) {
                    window.location.href = "";
                }
            })
        }
    })

    //--------------------  Products -----------------------

    //Add product
    $("#product_form").on("submit", function () {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: $("#product_form").serialize(),
            success: function (data) {
                if (data == "PRODUCT_ADDED") {
                    alert("New product successfully added");
                    $("#product_name").val("");
                    $("#product_qty").val("");
                    $("#select_cat").val("");
                    $("#select_brand").val("");
                    $("#barcode").val("");
                    $("#product_price").val("");
                } else {
                    console.log(data);
                    alert(data);
                }
                $('#add-products').on('hidden.bs.modal', function () {
                    location.reload();
                });
            }
        })
    })

    //Manage products
    manageProduct();
    function manageProduct() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {manageProduct: 1},
            success: function (data) {
                $("#get_product").html(data);
                $('#product_data').DataTable({
                    responsive: true,
                    "destroy": true,
                });
            }
        })
    }

    //Delete product
    $("body").delegate(".del_product", "click", function () {
        var did = $(this).attr("did");
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                data: {deleteProduct: 1, id: did},
                success: function (data) {
                    if (data == "DELETED") {
                        alert("Deleted successfully");
                        location.reload();
                    } else {
                        alert(data);
                    }
                }
            })
        }
    })

    //Update product
    $("body").delegate(".edit_product", "click", function () {
        var eid = $(this).attr("eid");
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            dataType: "json",
            data: {updateProduct: 1, id: eid},
            success: function (data) {
                console.log(data);
                $("#update_pid").val(data["pid"]);
                $("#update_product_name").val(data["product_name"]);
                $("#update_select_cat").val(data["cid"]);
                $("#update_select_brand").val(data["bid"]);
                $("#update_product_price").val(data["product_price"]);
                $("#update_product_qty").val(data["product_stock"]);

            }
        })
    })

    $("#update_product_form").on("submit", function () {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: $("#update_product_form").serialize(),
            success: function (data) {
                if (data == "UPDATED") {
                    alert("Updated successfully");
                    location.reload();
                } else {
                    alert(data);
                }
            }
        })
    })

    //--------------------  Invoices -----------------------

//Manage invoice
    manageInvoice();

    function manageInvoice() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {manageInvoice: 1},
            success: function (data) {
                $("#get_invoice").html(data);
                $('#invoice_data').DataTable({
                    "destroy": true,
                });
            }
        })
    }

});

