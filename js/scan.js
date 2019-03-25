$(document).ready(function () {
    // Variables
    window.scan_version = 1;

    // Events
    document.getElementById('find-product-btn').onclick = getProduct;
    document.getElementById('scan-barcode').onclick = scan;
    document.getElementById('rescan-btn').onclick = rescan;

    // Scan Barcode
    function scan() {
        // UI
        $("#test").css({"display": "block"});
        $('#scan-barcode-modal').modal('show');
        $("#wrapper").css({display: 'block'});

        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#test'),
                constraints: {
                    width: {min: 640},
					height: {min: 480},
                    deviceId: 0,
                    aspectRatio: {min: 1, max: 100},
                    facingMode: "environment",
                },			

            },
            locator: {
				patchSize: "medium",
				halfSample: true
			},
			numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
            decoder: {
                readers: ["ean_reader", "ean_8_reader"]
            },
            locate: true
        }, 
        function (err) {
            if (err) {
                console.log(err);
                return
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });

        window.scan_version += 1;
        let codes = [];
        let cv = window.scan_version;
        Quagga.onDetected(function(data) {
            // Checks
            if (cv != window.scan_version) {
                return false;
            }
            if (codes.length >= 40) {
                console.log("Code array length over 40, the size is:" + codes.length);

                let b = {};
                let max = '';
                let maxi = 0;
                for (var k of codes) {
                    if (b[k]) b[k]++; else b[k] = 1;
                    if (maxi < b[k]) {
                        max = k;
                        maxi = b[k]
                    }
                }

                codes = [];
                $("#product-id-number").val(max);
                $("#test").css({"display": "none"});
                Quagga.stop();
            }

            codes.push(data.codeResult.code);
            document.querySelector("#process").style.background = (codes.length % 2) ? "#0f0" : "#020";
        });
    }

    function rescan() {
        scan();
        $("#product-id-number").val("");
    }

    // Find Product
    function getProduct() {
        // Variables
        let ean = document.getElementById('product-id-number').value;
        let response = null;

        // Checks
        if (!ean) {
            return false
        }

        $.post("includes/product.php", {function: "getProduct", barcode: ean}, function (d) {
            if (typeof(d.Product) !== "undefined" && d.Product != null) {
                editProduct(d);
            } else if (typeof(d.Product) !== "undefined") {
                createProduct(d);
            } else {
                alert("an internal error occurred whilst fetching that product");
            }

        })

        // UI 
        $('#scan-barcode-modal').modal('hide');
    }


// Create Product
    function createProduct(d) {

        // Checks
        if (d.Categories) {
            // Variables
            let fragment = document.createDocumentFragment();

            // Loop
            for (let i = 0; i < d.Categories.length; i++) {
                // Variables
                let option = document.createElement('option');
                let category = d.Categories[i];

                // Attributes
                option.value = category.cid;
                option.innerText = category.category_name;

                // Append
                fragment.appendChild(option);
            }

            // Append
            document.getElementById('select_cat').innerHTML = '';
            document.getElementById('select_cat').appendChild(fragment);
        }
        if (d.Brands) {
            // Variables
            let fragment = document.createDocumentFragment();

            // Loop
            for (let i = 0; i < d.Brands.length; i++) {
                // Variables
                let option = document.createElement('option');
                let brand = d.Brands[i];

                // Attributes
                option.value = brand.bid;
                option.innerText = brand.brand_name;

                // Append
                fragment.appendChild(option);
            }

            // Append
            document.getElementById('select_brand').innerHTML = '';
            document.getElementById('select_brand').appendChild(fragment);
        }


        document.querySelector('#add-products button[type="submit"]').onclick = function () {
            // Checks
            if (!document.getElementById('select_cat').value) {
                alert("Please select a category")
            }
            if (!document.getElementById('select_brand').value) {
                alert("Please select a brand")
            }
            if (!document.getElementById('product_name').value) {
                alert("Please enter a valid name")
            }
            if (!document.getElementById('product_qty').value) {
                alert("Please enter a valid stock count")
            }
            if (!document.getElementById('product_price').value) {
                alert("Please enter a valid price")
            }
            let ean = document.getElementById('product-id-number').value;

            $.post("includes/product.php", {
                    function: "createProduct",
                    barcode: ean,
                    "product_name": $("#product_name").val(),
                    "cid": $("#select_cat").val(),
                    "bid": $("#select_brand").val(),
                    "product_price": parseFloat($("#product_price").val().replace(new RegExp(/[^0-9.]/ig), "")),
                    "product_stock": $("#product_qty").val(),
                },
                function (d) {
                    if (!d || d != "true") {
                        alert("an error occurred whilst creating product");
                        scan();
                    }else{
                        alert("Product successfully added");
                        scan();
                    }
                });

            // UI
            $('#add-products').modal('hide');
        };

        // UI
        $('#product_name').val("");
        $('#product_price').val("£0.00");
        $('#product_qty').val("0");
        $('#add-products').modal('show');
    }

// Edit Existing Product
    function editProduct(d) {

        // Checks
        if (d.Categories) {
            // Variables
            let fragment = document.createDocumentFragment();

            // Loop
            for (let i = 0; i < d.Categories.length; i++) {
                // Variables
                let option = document.createElement('option');
                let category = d.Categories[i];

                // Attributes
                option.value = category.cid;
                option.innerText = category.category_name;
                option.selected = d.Product.cid && d.Product.cid == category.cid ? true : false;

                // Append
                fragment.appendChild(option);
            }

            // Append
            document.getElementById('update_select_cat').innerHTML = '';
            document.getElementById('update_select_cat').appendChild(fragment);
        }
        if (d.Brands) {
            // Variables
            let fragment = document.createDocumentFragment();

            // Loop
            for (let i = 0; i < d.Brands.length; i++) {
                // Variables
                let option = document.createElement('option');
                let brand = d.Brands[i];

                // Attributes
                option.value = brand.bid;
                option.innerText = brand.brand_name;
                option.selected = d.Product.bid && d.Product.bid == brand.bid ? true : false;

                // Append
                fragment.appendChild(option);
            }

            // Append
            document.getElementById('update_select_brand').innerHTML = '';
            document.getElementById('update_select_brand').appendChild(fragment);
        }



        document.querySelector('#update_product_form button[type="submit"]').onclick = function () {
            // Checks
            if (!d.Product.pid || isNaN(d.Product.pid)) {
                alert("Product ID is not in the correct format. Potentially an internal error")
            }
            if (!document.getElementById('update_select_cat').value) {
                alert("select a category")
            }
            if (!document.getElementById('update_select_brand').value) {
                alert("please select a brand")
            }
            if (!document.getElementById('update_product_name').value) {
                alert("please enter a valid name")
            }
            if (!document.getElementById('update_product_qty').value) {
                alert("please enter a valid stock count")
            }
            if (!document.getElementById('update_product_price').value) {
                alert("please enter a valid price")
            }
            let ean = document.getElementById('product-id-number').value;

            $.post("includes/product.php", {
                    function: "updateProduct", barcode : ean,
                    "product_name": $("#update_product_name").val(),
                    "cid": $("#update_select_cat").val(),
                    "bid": $("#update_select_brand").val(),
                    "product_price": parseFloat($("#update_product_price").val().replace(new RegExp(/[^0-9.]/ig), "")),
                    "product_stock": $("#update_product_qty").val()
                },
                function (d) {
                    if (!d || d != "true") {
                        alert("an error occurred whilst creating product");
                        // UI
                        document.getElementById('update-form-product').style.display = 'block';
                        document.getElementById('update-form-product').classList.add('show');
                    }else{
                        alert("Product successfully edited");
                        scan();
                    }
                });

            // UI
            $('#update-form-product').modal('hide');
        };

        // UI
        document.getElementById('update_product_name').value = d.Product.product_name;
        //format price with 2 decimals if exists, if not return £0.00
        document.getElementById('update_product_price').value = `£${d.Product.product_price ? parseFloat(d.Product.product_price).toFixed(2) : "0.00" }`;
        document.getElementById('update_product_qty').value = d.Product.product_stock;
        $('#update-form-product').modal('show');

    }
});
