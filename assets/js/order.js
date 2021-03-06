var purchaseOrderTable = null;
var supplier_id = null;

purchaseOrderTable = $('#purchaseOrderTable').DataTable({
    'ajax': '/ipheya/core/sub/php_action/fetchOrder.php',
    'order': []
});

function addInventory(id)
{
    $.ajax({
        url: '/ipheya/core/sub/php_action/findSupplier.php',
        type: 'post',
        data:{inventory_id: id},
        dataType: 'json',
        success: function(response)
        {
            if(response.success==true)
            {
                purchaseOrderTable.ajax.reload(null, true);
                $('#feedback').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                '</div>');
            }

        } //success
    });
}
// GET SUUPILER
function getSupplier() {
    id = Number($('#supplier').val());
    if (isNaN(id) === false) {
        $.ajax({
            url: '/ipheya/core/sub/php_action/findSupplier.php',
            type: 'post',
            data: {supplier_id: id},
            dataType: 'json',
            success: function(response)
            {
                    $("#sup_email").text(response.email);
                    $("#sup_address").text(response.address);
                    $("#sup_number").text(response.mobile);
                    $("#sup_web").text(response.web);
                    $("#weblink").attr("href", response.web);
            } //success
        });
        supplier_id = id;
    } else
    {
        $("#sup_email").text("");
        $("#sup_address").text("");
        $("#sup_number").text("");
        $("#sup_web").text("");
        $("#weblink").attr("href", "");
        supplier_id="";
    }
}

$(document).ready(function() {
    $("#expected_date").datepicker({
        minDate:0,
        dateFormat: 'yy-mm-dd'
    });

    var divRequest ='add';
    // top nav bar
    $("#navOrder").addClass('active');

    if (divRequest == 'add')
    {
        // add order
        // top nav child bar
        $('#topNavAddOrder').addClass('active');

        // create order form function
        $("#createOrderForm").unbind('submit').bind('submit', function()
        {
            var form = $(this);

            $('.form-group').removeClass('has-error').removeClass('has-success');
            $('.text-danger').remove();

            var supplier =supplier_id;
            var expected_date = $("#expected_date").val();
            var order_date = moment().format("YYYY-MM-DD");
            var discount = $("#discount").val();
            // alert(supplier);
            // form validation
            if (supplier == "")
            {
                $("#supplier").after('<p class="text-danger"> Please select supplier </p>');
                $('#supplier').closest('.form-group').addClass('has-error');
            }
            else
            {
                $('#supplier').closest('.form-group').addClass('has-success');
            } // /else

            if (expected_date == "")
            {
                $("#expected_date").after('<p class="text-danger"> Choose the expected date </p>');
                $('#expected_date').closest('.form-group').addClass('has-error');
            }
             else
            {
                $('#expected_date').closest('.form-group').addClass('has-success');
            } // /else


            if (discount == "")
            {
                discount =0;
            }
            else
            {
                $('#discount').closest('.form-group').addClass('has-success');
            } // /else
            // array validation
            var productName = document.getElementsByName('productName[]');
            var validateProduct;
            for (var x = 0; x < productName.length; x++)
            {
                var productNameId = productName[x].id;
                if (productName[x].value == '')
                {
                    $("#" + productNameId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
                    $("#" + productNameId + "").closest('.form-group').addClass('has-error');
                } else
                {
                    $("#" + productNameId + "").closest('.form-group').addClass('has-success');
                }
            } // for
            for (var x = 0; x < productName.length; x++) {
                if (productName[x].value)
                {
                    validateProduct = true;
                }
                else
                {
                    validateProduct = false;
                }
            } // for


            var quantity = document.getElementsByName('quantity[]');
            var validateQuantity;
            var order_quality = 0;
            for (var x = 0; x < quantity.length; x++)
            {
                var quantityId = quantity[x].id;
                if (quantity[x].value == '')
                {
                    $("#" + quantityId + "").after('<p class="text-danger">Enter the order quality </p>');
                    $("#" + quantityId + "").closest('.form-group').addClass('has-error');
                }
                else
                {
                    $("#" + quantityId + "").closest('.form-group').addClass('has-success');
                    order_quality += Number(quantity[x].value);
                }
            } // for

            for (var x = 0; x < quantity.length; x++)
            {
                if (quantity[x].value)
                {
                    validateQuantity = true;
                } else
                {
                    validateQuantity = false;
                }
            } // for

            var unitPrice = document.getElementsByName('unitprice[]');
            var validateUnitprice;
            for (var x = 0; x < unitPrice.length; x++)
            {
                var unitpriceId = unitPrice[x].id;
                if (unitPrice[x].value == '')
                {
                    $("#" + unitpriceId + "").after('<p class="text-danger"> Enter product unit price </p>');
                    $("#" + unitpriceId + "").closest('.form-group').addClass('has-error');
                }
                else
                {
                    $("#" + unitpriceId + "").closest('.form-group').addClass('has-success');
                    // order_quality += quantity[x];
                }
            } // for
            for (var x = 0; x < unitPrice.length; x++)
            {
                if (unitPrice[x].value)
                {
                    validateUnitprice = true;
                } else
                {
                    validateUnitprice = false;
                }
            } // for

            $("#orderdate").val(order_date);
            $("#totalQuantity").val(order_quality);

            if (supplier != null && expected_date != null  && discount != null)
            {
                if (validateProduct == true && validateQuantity == true &&  validateUnitprice)
                {
                    // create order button
                    var form = $('form');
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response)
                        {
                                // reset button
                                $(".text-danger").remove();
                                $('.form-group').removeClass('has-error').removeClass('has-success');

                                if (response.success == true)
                                {

                                    // create order button
                                    $(".success-messages").html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        ' <br /> <br /> <a type="button" onclick="printOrder(' + response.order_id + ')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>' +
                                        '<a href="purchaseorder.php" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Order </a>' +

                                        '</div>');

                                    $("html, body, div.panel, div.pane-body").animate({ scrollTop: '0px' }, 100);

                                    // disabled te modal footer button
                                    $(".submitButtonFooter").addClass('div-hide');
                                    // remove the product row
                                    $(".removeProductRowBtn").addClass('div-hide');
                                }
                            }, // /response
                            error:function (res)
                            {
                                alert(res.responseText);
                            }
                    }); // /ajax
                } // if array validate is true

            } // /if field validate is true

            return false;
        }); // /create order form function

    }
}); // /documernt


// print order function
function printOrder(orderId)
{
    if (orderId)
    {

        $.ajax({
            url: '/ipheya/core/sub/php_action/printOrder.php',
            type: 'post',
            data: { orderId: orderId },
            dataType: 'text',
            success: function(response) {

                    var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
                    mywindow.document.write('<html><head><title>Order Invoice</title>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

                    mywindow.print();
                    mywindow.close();

                } // /success function
        }); // /ajax function to fetch the printable order
    } // /if orderId
} // /print order function

function addRow() {
    // $("#addRowBtn").button("loading");

    var tableLength = $("#productTable tbody tr").length;

    var tableRow;
    var arrayNumber;
    var count;

    if (tableLength > 0) {
        tableRow = $("#productTable tbody tr:last").attr('id');
        arrayNumber = $("#productTable tbody tr:last").attr('class');
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }

    $.ajax({
        url: '/ipheya/core/sub/php_action/fetchProductData.php',
        type: 'post',
        dataType: 'json',
        success: function(response) {

                var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
                    '<td>' +
                    '<div class="form-group">' +

                    '<select class="form-control" name="productName[]" id="productName' + count + '" onchange="getProductData(' + count + ')" >' +
                    '<option value="">~~SELECT~~</option>';
                // console.log(response);
                $.each(response, function(index, value) {
                    tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
                });

                tr += '</select>' +
                    '</div>' +
                    '</td>' +
                    '<td style="padding-left:20px;"">' +
                    '<input type="text" name="unitprice[]" id="unitprice' + count + '" onkeyup="getTotal(' + count + ')" autocomplete="off" class="form-control" />' +
                    '<input type="hidden" name="unitpriceValue[]" id="unitpriceValue' + count + '" autocomplete="off" class="form-control" />' +
                    '</td style="padding-left:20px;">' +
                    '<td style="padding-left:20px;">' +
                    '<div class="form-group">' +
                    '<input type="number" name="quantity[]" id="quantity' + count + '" onkeyup="getTotal(' + count + ')" autocomplete="off" class="form-control" min="1" />' +
                    '</div>' +
                    '</td>' +
                    '<td style="padding-left:20px;">' +
                    '<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control" disabled="true" />' +
                    '<input type="hidden" name="totalValue[]" id="totalValue' + count + '" autocomplete="off" class="form-control" />' +
                    '</td>' +
                    '<td>' +
                    '<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="glyphicon glyphicon-trash"></i></button>' +
                    '</td>' +
                    '</tr>';
                if (tableLength > 0) {
                    $("#productTable tbody tr:last").after(tr);
                } else {
                    $("#productTable tbody").append(tr);
                }

            } // /success
    }); // get the product data

} // /add row

function removeProductRow(row)
{
    if (row)
    {
        $("#row" + row).remove();
        subAmount();
        validateRows();
    }
    else
    {
        alert('error! Refresh the page again');
    }
}

function validateRows()
{
    var rows = $('#productTable>tbody>tr');
    if(rows.length ==1)
    {
        $('.removeProductRowBtn').attr('disabled','disabled');
    }
    else
    {
        $('.removeProductRowBtn').removeAttr('disabled');
    }
}
// select on product data
function getProductData(row) {
    if (row) {
        var productId = $("#productName" + row).val();

        if (productId == "") {
            $("#unitprice" + row).val("");

            $("#quantity" + row).val("");
            $("#total" + row).val("");

            // remove check if product name is selected
            // var tableProductLength = $("#productTable tbody tr").length;
            for (x = 0; x < tableProductLength; x++) {
                var tr = $("#productTable tbody tr")[x];
                var count = $(tr).attr('id');
                count = count.substring(3);

                var productValue = $("#productName" + row).val();

                if ($("#productName" + count).val() == "") {
                    $("#productName" + count).find("#changeProduct" + productId).removeClass('div-hide');
                    console.log("#changeProduct" + count);
                }
            } // /for

        } else {
            $.ajax({
                url: '/ipheya/core/sub/php_action/fetchSelectedProduct.php',
                type: 'post',
                data: { productId: productId },
                dataType: 'json',
                success: function(response) {
                        // setting the unitprice value into the unitprice input field
                        if ($("#unitprice" + row).val() == null) {
                            $("#unitprice" + row).val(0);
                            $("#unitpriceValue" + row).val(0);
                        }

                        if ($("#quantity" + row).val() == null) {
                            $("#quantity" + row).val(0);
                        }

                        var total = Number(0) * 1;
                        total = total.toFixed(2);
                        $("#total" + row).val(total);
                        $("#totalValue" + row).val(total);

                        // check if product name is selected
                        var tableProductLength = $("#productTable tbody tr").length;
                        for (x = 0; x < tableProductLength; x++) {
                            var tr = $("#productTable tbody tr")[x];
                            var count = $(tr).attr('id');
                            count = count.substring(3);

                            var productValue = $("#productName" + row).val()

                            if ($("#productName" + count).val() != productValue) {
                                // $("#productName"+count+" #changeProduct"+count).addClass('div-hide');
                                $("#productName" + count).find("#changeProduct" + productId).addClass('div-hide');
                                console.log("#changeProduct" + count);
                            }
                        } // /for

                        subAmount();
                    } // /success
            }); // /ajax function to fetch the product data
            $('.removeProductRowBtn').removeAttr('disabled');
        }

    } else {
        alert('no row! please refresh the page');
    }
} // /select on product data

// table total
function getTotal(row) {
    if (row) {
        var total = Number($("#unitprice" + row).val()) * Number($("#quantity" + row).val());
        total = total.toFixed(2);
        $("#total" + row).val(total);
        $("#totalValue" + row).val(total);

        subAmount();

    } else {
        alert('no row !! please refresh the page');
    }
}

function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#productTable tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(3);

        totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#subTotal").val(totalSubAmount);
    $("#subTotalValue").val(totalSubAmount);

    // vat
    var vat = (Number($("#subTotal").val()) / 100) * 14;
    vat = vat.toFixed(2);
    $("#vat").val(vat);
    $("#vatValue").val(vat);

    // total amount
    var totalAmount = (Number($("#subTotal").val()) - Number($("#vat").val()));
    totalAmount = totalAmount.toFixed(2);
    $("#totalAmount").val(totalAmount);
    $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if (discount)
    {
        var grandTotal = Number($("#totalAmount").val()) - Number(discount);
        grandTotal = grandTotal.toFixed(2);
        $("#grandTotal").val(grandTotal);
        $("#grandTotalValue").val(grandTotal);
    }
    else
    {
        $("#grandTotal").val(totalAmount);
        $("#grandTotalValue").val(totalAmount);
    } // /else discount

    var paidAmount = $("#paid").val();
    if (paidAmount)
    {
        paidAmount = Number($("#grandTotal").val()) - Number(paidAmount);
        paidAmount = paidAmount.toFixed(2);
        $("#due").val(paidAmount);
        $("#dueValue").val(paidAmount);
    }
    else
    {
        $("#due").val($("#grandTotal").val());
        $("#dueValue").val($("#grandTotal").val());
    } // else

} // /sub total amount

function discountFunc() {
    var discount = $("#discount").val();
    var totalAmount = Number($("#totalAmount").val());
    totalAmount = totalAmount.toFixed(2);

    var grandTotal;
    if (totalAmount) {
        grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
        grandTotal = grandTotal.toFixed(2);

        $("#grandTotal").val(grandTotal);
        $("#grandTotalValue").val(grandTotal);
    } else {}

    var paid = $("#paid").val();

    var dueAmount;
    if (paid) {
        dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
        dueAmount = dueAmount.toFixed(2);

        $("#due").val(dueAmount);
        $("#dueValue").val(dueAmount);
    } else {
        $("#due").val($("#grandTotal").val());
        $("#dueValue").val($("#grandTotal").val());
    }

} // /discount function

function paidAmount() {
    var grandTotal = $("#grandTotal").val();

    if (grandTotal) {
        var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
        dueAmount = dueAmount.toFixed(2);
        $("#due").val(dueAmount);
        $("#dueValue").val(dueAmount);
    } // /if
} // /paid amoutn function


function resetOrderForm() {
    // reset the input field
    $("#createOrderForm")[0].reset();
    // remove remove text danger
    $(".text-danger").remove();
    // remove form group error
    $(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


// remove order from server
function removeOrder(orderId) {
    if (orderId) {
        $("#removeOrderBtn").unbind('click').bind('click', function() {

            $.ajax({
                url: '/ipheya/core/sub/php_action/removeOrder.php',
                type: 'post',
                data: { orderId: orderId },
                dataType: 'json',
                success: function(response) {

                        if (response.success == true) {

                            manageOrderTable.ajax.reload(null, false);
                            // hide modal
                            $("#removeOrderModal").modal('hide');
                            // success messages
                            $("#success-messages").html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                            // remove the mesages
                            $(".alert-success").delay(500).show(10, function() {
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            }); // /.alert

                        } else {
                            // error messages
                            $(".removeOrderMessages").html('<div class="alert alert-warning">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                            // remove the mesages
                            $(".alert-success").delay(500).show(10, function() {
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            }); // /.alert
                        } // /else

                    } // /success
            }); // /ajax function to remove the order

        }); // /remove order button clicked


    } else {
        alert('error! refresh the page again');
    }
}
// /remove order from server

// Payment ORDER
function paymentOrder(orderId) {
    if (orderId) {

        $("#supplier").datepicker();

        $.ajax({
            url: '/ipheya/core/sub/php_action/fetchOrderData.php',
            type: 'post',
            data: { orderId: orderId },
            dataType: 'json',
            success: function(response) {

                    // due
                    $("#due").val(response.order[10]);

                    // pay amount
                    $("#payAmount").val(response.order[10]);

                    var paidAmount = response.order[9]
                    var dueAmount = response.order[10];
                    var grandTotal = response.order[8];

                    // update payment
                    $("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
                        var payAmount = $("#payAmount").val();
                        var paymentType = $("#paymentType").val();
                        var paymentStatus = $("#paymentStatus").val();

                        if (payAmount == "") {
                            $("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
                            $("#payAmount").closest('.form-group').addClass('has-error');
                        } else {
                            $("#payAmount").closest('.form-group').addClass('has-success');
                        }

                        if (paymentType == "") {
                            $("#paymentType").after('<p class="text-danger">The Pay Amount field is required</p>');
                            $("#paymentType").closest('.form-group').addClass('has-error');
                        } else {
                            $("#paymentType").closest('.form-group').addClass('has-success');
                        }

                        if (paymentStatus == "") {
                            $("#paymentStatus").after('<p class="text-danger">The Pay Amount field is required</p>');
                            $("#paymentStatus").closest('.form-group').addClass('has-error');
                        } else {
                            $("#paymentStatus").closest('.form-group').addClass('has-success');
                        }

                        if (payAmount && paymentType && paymentStatus) {
                            $.ajax({
                                url: '/ipheya/core/sub/php_action/editPayment.php',
                                type: 'post',
                                data: {
                                    orderId: orderId,
                                    payAmount: payAmount,
                                    paymentType: paymentType,
                                    paymentStatus: paymentStatus,
                                    paidAmount: paidAmount,
                                    grandTotal: grandTotal
                                },
                                dataType: 'json',
                                success: function(response) {

                                        // remove error
                                        $('.text-danger').remove();
                                        $('.form-group').removeClass('has-error').removeClass('has-success');

                                        $("#paymentOrderModal").modal('hide');

                                        $("#success-messages").html('<div class="alert alert-success">' +
                                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                            '</div>');

                                        // remove the mesages
                                        $(".alert-success").delay(500).show(10, function() {
                                            $(this).delay(3000).hide(10, function() {
                                                $(this).remove();
                                            });
                                        }); // /.alert

                                        // refresh the manage order table
                                        manageOrderTable.ajax.reload(null, false);

                                    } //

                            });
                        } // /if

                        return false;
                    }); // /update payment

                } // /success
        }); // fetch order data
    } else {
        alert('Error ! Refresh the page again');
    }
}
