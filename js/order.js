$(document).ready(function () {
    // add new order item
    addRow();
    $("#add").click(function () {
        addRow();
    });

    function addRow() {
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            data: {getNewOrderItem: 1},
            success: function (data) {
                $("#invoice_item").append(data);
                var n = 0;
                $(".number").each(function () {
                    $(this).html(++n);
                })
            }
        })
    }

    // remove order item
    $("#remove").click(function () {
        $("#invoice_item").children("tr:last").remove();
        calculate(0);
    });

    $("#invoice_item").delegate(".pid", "change", function () {
        var pid = $(this).val();
        var tr = $(this).parent().parent();
        $.ajax({
            url: "includes/process.php",
            method: "POST",
            dataType: "json",
            data: {getPriceAndQty: 1, id: pid},
            success: function (data) {
                tr.find(".tqty").val(data["product_stock"]);
                tr.find(".pro_name").val(data["product_name"]);
                tr.find(".qty").val(1);
                tr.find(".price").val(data["product_price"]);
                tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
                calculate(0);
            }
        })
    });

    $("#invoice_item").delegate(".qty", "keyup", function () {
        var qty = $(this);
        var tr = $(this).parent().parent();
        if (isNaN(qty.val())) {
            alert("Please enter a valid quantity");
            qty.val(1);
        } else {
            if ((qty.val() - 0) > (tr.find(".tqty").val()) - 0) {
                alert("Quantity not available");
                qty.val(1);
            } else {
                tr.find(".amt").html(qty.val() * tr.find(".price").val());
                calculate(0);
            }
        }
    });

    function calculate(paid) {

        var sub_total = 0;
        var tax = 0;
        var net_total = 0;
        var paid_amount = paid;
        var due = 0;

        $(".amt").each(function () {
            sub_total = sub_total + ($(this).html() * 1);
        })

        tax = 0.18 * sub_total;
        tax = parseFloat(tax.toFixed(2));
        net_total = tax + sub_total;
        due = net_total - paid_amount;

        $("#sub_total").val(sub_total);
        $("#tax").val(tax);
        $("#net_total").val(net_total);
        $("#due").val(due);
        if (due < 0) {
            alert("Please enter a valid paid amount");

        }

    }

    $("#paid").keyup(function () {
        var paid = $(this).val();
        calculate(paid);
    });

    // Accept order
    $("#order_form").click(function () {
        var invoice = $("#order_data").serialize();
        if ($("#cust_name").val() === "") {
            alert("Please enter customer name.");
        } else if ($("#paid").val() === "") {
            alert("Please enter paid amount.");
        } else {
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                async: false,
                data: $("#order_data").serialize(),
                success: function (data) {
                    if (data < 0) {
                        alert("Error");
                    } else if (data == "QTY_NOT_AVAIL") {
                        alert("Quantity not available.");
                    } else if (data == "PAID_ERROR") {
                        alert("Please enter full amount to process order.");
                    } else {
                        if (confirm("Do you want to print invoice?")) {
                            $('#order_data')[0].reset();
                            window.open("includes/invoice_bill.php?invoice_no=" + data + "&" + invoice, "Invoice", "width=1000,height=800");

                        }
                    }

                }
            })
        }

    })


});