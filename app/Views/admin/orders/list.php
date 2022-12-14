<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Woowprint</title>
    <?= $this->include('components/links') ?>
</head>

<body>
    <div class="d-flex font-nunito-sans bg-light">
        <?= $this->include('components/sidebar') ?>
        <section class="vh-100 w-100 scrollable-y" id="topbar-section">
            <?= $this->include('components/topbar') ?>

            <div class="mx-2 mx-lg-5 my-4 px-3 py-2">
                <h2 class="fw-semibold">List of Orders</h2>
                <hr class="mt-05" style="max-width: 200px;border: 2px solid; opacity: 1 ">
                <div class="d-flex mb-5">
                    <button class="btn btn-primary rounded-0 me-2" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                        <i class="fa-solid fa-file-circle-plus"></i>&nbsp; Add New Order
                    </button>
                    <button class="btn btn-dark rounded-0 me-2" data-bs-toggle="modal" data-bs-target="#shippingInfo">
                        <i class="fa-solid fa-truck"></i>&nbsp; Shipping Info
                    </button>
                </div>
                <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="uploading-tab" data-bs-toggle="tab" data-bs-target="#uploading-tab-pane" type="button" role="tab" aria-controls="uploading-tab-pane" aria-selected="true">Uploading</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="queued-tab" data-bs-toggle="tab" data-bs-target="#queued-tab-pane" type="button" role="tab" aria-controls="queued-tab-pane" aria-selected="false">Queued</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing-tab-pane" type="button" role="tab" aria-controls="processing-tab-pane" aria-selected="false">Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping-tab-pane" type="button" role="tab" aria-controls="shipping-tab-pane" aria-selected="false">Shipping</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-tab-pane" type="button" role="tab" aria-controls="completed-tab-pane" aria-selected="false">Completed</button>
                    </li>
                </ul>
                <div class="tab-content" id="orderTabsContent">
                    <div class="tab-pane fade pt-4 table-responsive show active" id="uploading-tab-pane" role="tabpanel" aria-labelledby="uploading-tab" tabindex="0"></div>
                    <div class="tab-pane fade pt-4 table-responsive" id="queued-tab-pane" role="tabpanel" aria-labelledby="queued-tab" tabindex="0"></div>
                    <div class="tab-pane fade pt-4 table-responsive" id="processing-tab-pane" role="tabpanel" aria-labelledby="processing-tab" tabindex="0"></div>
                    <div class="tab-pane fade pt-4 table-responsive" id="shipping-tab-pane" role="tabpanel" aria-labelledby="shipping-tab" tabindex="0"></div>
                    <div class="tab-pane fade pt-4 table-responsive" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab" tabindex="0"></div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Order Modal -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addOrderModalLabel">
                        <i class="fa-solid fa-file-circle-plus"></i>&nbsp; Add New Order
                    </h1>
                    <button type="button" class="btn-close rounded-0 noglow" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyUpdateEmployee">
                    <form>
                        <div class="mb-3">
                            <label for="inputCustomerName">Customer Name</label>
                            <input type="text" class="form-control my-2" name="inputCustomerName" id="inputCustomerName">
                        </div>
                        <div class="mb-3">
                            <label for="inputCustomerPhone">Customer Phone</label>
                            <input type="number" class="form-control my-2" name="inputCustomerPhone" id="inputCustomerPhone">
                            <small>Please use international format (eg. 6281234567890)</small>
                        </div>
                        <div class="mb-3">
                            <label for="inputCustomerAddress">Customer Address</label>
                            <textarea class="form-control my-2" name="inputCustomerAddress" id="inputCustomerAddress"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputDescription">Order Note / Description</label>
                            <textarea class="form-control my-2" name="inputDescription" id="inputDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputAmountPhoto">Number of photos</label>
                            <input type="number" class="form-control my-2" name="inputAmountPhoto" id="inputAmountPhoto">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-0" onclick="addOrder()"><i class="fa-solid fa-floppy-disk"></i>&nbsp; Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping Info Modal -->
    <div class="modal fade" id="shippingInfo" tabindex="-1" aria-labelledby="shippingInfoLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <form action="<?= base_url('admin/shipping/config') ?>" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="shippingInfoLabel">
                            <i class="fa-solid fa-truck"></i>&nbsp; Shipping Info
                        </h1>
                        <button type="button" class="btn-close rounded-0 noglow" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="updateSenderName">Sender Name</label>
                            <input type="text" class="form-control my-2" name="updateSenderName" id="updateSenderName" disabled value="<?= $sender[0]['sender_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="updateSenderPhone">Sender Phone</label>
                            <input type="text" class="form-control my-2" name="updateSenderPhone" id="updateSenderPhone" disabled value="<?= $sender[0]['sender_phone'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="updateSenderAddress">Sender Address</label>
                            <textarea type="text" class="form-control my-2" name="updateSenderAddress" id="updateSenderAddress" style="max-height:150px" disabled><?= $sender[0]['sender_address'] ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" id="buttonEditShippingInfo" class="btn btn-outline-primary rounded-0" onclick="switchEditMode()"><i class="fa-solid fa-rotate"></i>&nbsp; <span id="text-mode">Edit Mode</span></button>
                        <span>
                            <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancel</button>
                            <button id="buttonUpdateShippingInfo" class="btn btn-primary rounded-0" hidden><i class="fa-regular fa-floppy-disk"></i>&nbsp; Save</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateOrderModalLabel">
                        <i class="fa-solid fa-file-circle-plus"></i>&nbsp; Add New Order
                    </h1>
                    <button type="button" class="btn-close rounded-0 noglow" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyUpdateEmployee">
                    <form>
                        <div class="mb-3">
                            <label for="updateCustomerName">Customer Name</label>
                            <input type="text" class="form-control my-2" name="updateCustomerName" id="updateCustomerName">
                        </div>
                        <div class="mb-3">
                            <label for="updateCustomerPhone">Customer Phone</label>
                            <input type="number" class="form-control my-2" name="updateCustomerPhone" id="updateCustomerPhone">
                            <small>Please use international format (eg. 6281234567890)</small>
                        </div>
                        <div class="mb-3">
                            <label for="updateCustomerAddress">Customer Address</label>
                            <textarea class="form-control my-2" name="updateCustomerAddress" id="updateCustomerAddress"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="updateDescription">Order Note / Description</label>
                            <textarea class="form-control my-2" name="updateDescription" id="updateDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="updateAmountPhoto">Number of photos</label>
                            <input type="number" class="form-control my-2" name="updateAmountPhoto" id="updateAmountPhoto">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-0" id="updateOrderButton"><i class="fa-solid fa-floppy-disk"></i>&nbsp; Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Order Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">
                        <i class="fa-solid fa-info-circle"></i>&nbsp; Order Details
                    </h1>
                    <button type="button" class="btn-close rounded-0 noglow" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyUpdateEmployee">
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 170px">Order No.</td>
                            <td style="width: 20px">:&emsp;</td>
                            <td id="showOrderNo"></td>
                        </tr>
                        <tr>
                            <td style="width: 170px">Customer Name</td>
                            <td style="width: 20px">:&emsp;</td>
                            <td id="showCustomerName"></td>
                        </tr>
                        <tr>
                            <td style="width: 170px">Customer Phone</td>
                            <td style="width: 20px">:&emsp;</td>
                            <td id="showCustomerPhone"></td>
                        </tr>
                        <tr>
                            <td style="width: 170px">Customer Address</td>
                            <td style="width: 20px">:&emsp;</td>
                            <td id="showCustomerAddress"></td>
                        </tr>
                        <tr>
                            <td style="width: 170px">Description</td>
                            <td style="width: 20px">:&emsp;</td>
                            <td id="showDescription"></td>
                        </tr>
                        <tr>
                            <td style="width: 170px">Number of Photos</td>
                            <td style="width: 20px">:&emsp;</td>
                            <td id="showAmountPhoto"></td>
                        </tr>
                        <tr>
                            <td style="width: 170px">Order Status</td>
                            <td style="width: 20px">:&emsp;</td>
                            <td id="showStatus"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-body" id="modalBodyUpdateEmployee">
                    <div class="mb-3">
                        <label for="updateStatus">Change Order Status (current: <span id="currentStatus"></span>)</label>
                        <select id="updateStatus" class="form-select mt-2">
                            <option value="uploading">Uploading</option>
                            <option value="queued">Queued</option>
                            <option value="processing">Processing</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary rounded-0" id="updateOrderStatusButton"><i class="fa-solid fa-floppy-disk"></i>&nbsp; Save</button>

                </div>
            </div>
        </div>
    </div>

    <?= $this->include('components/scripts') ?>


    <script>
        $('#sidebar_orders').removeClass('link-dark').addClass('active')

        $(document).ready(function() {
            fetchAllTable()
        });

        function fetchAllTable() {
            getOrdersUploading()
            getOrdersQueued()
            getOrdersProcessing()
            getOrdersShipping()
            getOrdersCompleted()
        }

        function getOrdersUploading() {
            $.post("<?= base_url('admin/orders/uploadinglist') ?>", function(data) {
                    $('#uploading-tab-pane').html(data)
                })
                .fail(function() {
                    Notiflix.Loading.remove()
                    Notiflix.Report.failure('Server Error',
                        'Please check your connection and server status',
                        'Okay', )
                })
        }

        function getOrdersQueued() {
            $.post("<?= base_url('admin/orders/queuedlist') ?>", function(data) {
                    $('#queued-tab-pane').html(data)
                })
                .fail(function() {
                    Notiflix.Loading.remove()
                    Notiflix.Report.failure('Server Error',
                        'Please check your connection and server status',
                        'Okay', )
                })
        }

        function getOrdersProcessing() {
            $.post("<?= base_url('admin/orders/processinglist') ?>", function(data) {
                    $('#processing-tab-pane').html(data)
                })
                .fail(function() {
                    Notiflix.Loading.remove()
                    Notiflix.Report.failure('Server Error',
                        'Please check your connection and server status',
                        'Okay', )
                })
        }

        function getOrdersShipping() {
            $.post("<?= base_url('admin/orders/shippinglist') ?>", function(data) {
                    $('#shipping-tab-pane').html(data)
                })
                .fail(function() {
                    Notiflix.Loading.remove()
                    Notiflix.Report.failure('Server Error',
                        'Please check your connection and server status',
                        'Okay', )
                })
        }

        function getOrdersCompleted() {
            $.post("<?= base_url('admin/orders/completedlist') ?>", function(data) {
                    $('#completed-tab-pane').html(data)
                })
                .fail(function() {
                    Notiflix.Loading.remove()
                    Notiflix.Report.failure('Server Error',
                        'Please check your connection and server status',
                        'Okay', )
                })
        }

        function addOrder() {
            var cust_name = $('#inputCustomerName')
            var cust_phone = $('#inputCustomerPhone')
            var cust_address = $('#inputCustomerAddress')
            var description = $('#inputDescription')
            var amount_photo = $('#inputAmountPhoto')

            cust_name.val() == '' ? cust_name.addClass('is-invalid') : cust_name.removeClass('is-invalid');
            cust_phone.val() == '' ? cust_phone.addClass('is-invalid') : cust_phone.removeClass('is-invalid');
            cust_address.val() == '' ? cust_address.addClass('is-invalid') : cust_address.removeClass('is-invalid');
            description.val() == '' ? description.addClass('is-invalid') : description.removeClass('is-invalid');
            amount_photo.val() == '' ? amount_photo.addClass('is-invalid') : amount_photo.removeClass('is-invalid');

            if (cust_name.val() == '' || cust_phone.val() == '' || cust_address.val() == '' || description.val() == '' || amount_photo.val() == '') {
                Notiflix.Notify.warning("Field cannot be empty!")
            } else {
                Notiflix.Loading.pulse()
                $.post("<?= base_url('admin/orders/add') ?>", {
                        cust_name: cust_name.val(),
                        cust_phone: cust_phone.val(),
                        cust_address: cust_address.val(),
                        description: description.val(),
                        amount_photo: amount_photo.val()
                    })
                    .done(function(data) {
                        Notiflix.Loading.remove(500)
                        console.log(data)
                        setTimeout(function() {
                            if (data == "success") {
                                Notiflix.Notify.success("Order data saved!")
                                cust_name.val('')
                                cust_phone.val('')
                                cust_address.val('')
                                description.val('')
                                amount_photo.val('')
                                $('#addOrderModal').modal('hide')
                                fetchAllTable()

                            } else if (data == "conflict") {
                                Notiflix.Notify.failure("Failed to save, something wrong please try again!")
                            } else if (data == "empty") {
                                Notiflix.Notify.failure("Field cannot be empty!")
                            } else if (data == "failed") {
                                Notiflix.Notify.failure("FAILED! INTERNAL SERVER ERROR!")
                            }
                        }, 500)
                    })
                    .fail(function() {
                        Notiflix.Loading.remove()
                        Notiflix.Report.failure('Server Error',
                            'Please check your connection and server status',
                            'Okay', )
                    })
            }
        }

        function deleteOrder(id, order_no) {
            Notiflix.Confirm.show(
                'Delete Order ' + order_no,
                'Are you sure want to delete this order?',
                'Yes',
                'No',
                () => {
                    Notiflix.Loading.pulse()
                    $.post("<?= base_url('admin/orders/delete') ?>", {
                            id: id,
                            order_no: order_no
                        })
                        .done(function(data) {
                            fetchAllTable()
                            Notiflix.Loading.remove(500)
                            console.log(data)
                            setTimeout(function() {
                                if (data == "success") {
                                    Notiflix.Notify.success("Order data deleted!")
                                } else if (data == "notfound") {
                                    Notiflix.Notify.failure("Order data not found")
                                }
                            }, 500)
                        })
                        .fail(function() {
                            Notiflix.Loading.remove()
                            Notiflix.Report.failure('Server Error',
                                'Please check your connection and server status',
                                'Okay', )
                        })
                },
                () => {}, {},
            );
        }

        function detailModal(id, order_no, cust_name, cust_phone, cust_address, description, amount_photo, status) {
            $('#detailModal').modal('show')
            var stat = ''
            $('#showOrderNo').html(order_no)
            $('#showCustomerName').html(cust_name)
            $('#showCustomerPhone').html(cust_phone)
            $('#showCustomerAddress').html(cust_address)
            $('#showDescription').html(description)
            $('#showAmountPhoto').html(amount_photo)
            if (status == 'uploading') {
                stat = 'Uploading';
            } else if (status == 'queued') {
                stat = 'Queued'
            } else if (status == 'processing') {
                stat = 'Processing'
            } else if (status == 'shipping') {
                stat = 'Shipping'
            } else if (status == 'completed') {
                stat = 'Completed'
            }
            $('#showStatus').html(stat)
        }

        function updateOrderModal(id, order_no, cust_name, cust_phone, cust_address, description, amount_photo, status) {
            $('#updateOrderModal').modal('show')

            $("#updateCustomerName").val(cust_name)
            $("#updateCustomerPhone").val(cust_phone)
            $("#updateCustomerAddress").val(cust_address)
            $("#updateDescription").val(description)
            $("#updateAmountPhoto").val(amount_photo)


            $('#updateOrderButton').attr('onclick', 'updateOrder(' + id + ')')
        }

        function updateOrder(id) {
            const cust_name = $("#updateCustomerName").val()
            const cust_phone = $("#updateCustomerPhone").val()
            const cust_address = $("#updateCustomerAddress").val()
            const description = $("#updateDescription").val()
            const amount_photo = $("#updateAmountPhoto").val()
            Notiflix.Loading.pulse()
            $.post("<?= base_url('admin/orders/update') ?>", {
                    id: id,
                    cust_name: cust_name,
                    cust_phone: cust_phone,
                    cust_address: cust_address,
                    description: description,
                    amount_photo: amount_photo
                })
                .done(function(data) {
                    fetchAllTable()
                    Notiflix.Loading.remove(500)
                    setTimeout(() => {
                        if (data == "success") {
                            Notiflix.Notify.success('Order data updated successfully!')
                            $('#updateOrderModal').modal('hide')
                        } else if (data == "notfound") {
                            Notiflix.Notify.failure('Failed, order data not found!')
                            $('#updateOrderModal').modal('hide')
                        } else if (data == "empty") {
                            Notiflix.Notify.failure('Field cannot be empty!')
                        }
                    }, 500)
                })
                .fail(function() {
                    Notiflix.Loading.remove()
                    Notiflix.Report.failure('Server Error',
                        'Please check your connection and server status',
                        'Okay', )
                })
        }

        function updateStatusModal(id, order_no, status) {
            $('#updateStatusModal').modal('show')
            $('#updateStatus').val(status).change()
            $('#updateOrderStatusButton').attr('onclick', 'updateStatus(' + id + ',"' + order_no + '")')
            $('#currentStatus').html(status)
        }

        function updateStatus(id, order_no) {
            const status = $('#updateStatus').val()
            Notiflix.Loading.pulse()
            $.post("<?= base_url('admin/orders/updatestatus') ?>", {
                    id: id,
                    status: status,
                    order_no: order_no
                })
                .done(function(data) {
                    fetchAllTable()
                    Notiflix.Loading.remove(500)
                    setTimeout(() => {
                        if (data == "success") {
                            Notiflix.Notify.success('Order status has been updated, order has been moved to related table')
                            $('#updateStatusModal').modal('hide')
                        } else if (data == "notfound") {
                            Notiflix.Notify.failure('Failed, order data not found!')
                            $('#updateStatusModal').modal('hide')
                        } else if (data == "empty") {
                            Notiflix.Notify.failure('Field cannot be empty!')
                        }
                    }, 500)
                })
                .fail(function() {
                    Notiflix.Loading.remove()
                    Notiflix.Report.failure('Server Error',
                        'Please check your connection and server status',
                        'Okay', )
                })
        }

        function downloadFiles(id, order_no) {
            Notiflix.Confirm.show('Download Files Confirmation',
                'Want to download all photos from order ' + order_no + ' ?',
                'Yes',
                'No',
                () => {
                    $.post("<?= base_url('admin/orders/download') ?>", {
                            id: id,
                            order_no: order_no
                        })
                        .done(function(data) {
                            const photos = JSON.parse(data)
                            photos.forEach((photo, index) => {
                                console.log(photo.file_name)
                                window.open('<?= base_url('admin/orders/photosdownload') ?>' + '?i=' + photo.file_name, 'dl' + index)
                            })
                        })
                        .fail(function() {
                            Notiflix.Loading.remove()
                            Notiflix.Report.failure('Server Error',
                                'Please check your connection and server status',
                                'Okay', )
                        })
                },
                () => {}, {},
            );
        }

        function markAsFinished(id, order_no) {
            Notiflix.Confirm.show('Mark Order As Finished',
                'Do you want to mark order ' + order_no + ' as finished and move it to shipping table?',
                'Yes',
                'No',
                () => {
                    Notiflix.Loading.pulse()
                    $.post("<?= base_url('admin/orders/finished') ?>", {
                            id: id,
                            order_no: order_no
                        })
                        .done(function(data) {
                            fetchAllTable()
                            Notiflix.Loading.remove(500)
                            setTimeout(() => {
                                if (data == "success") {
                                    Notiflix.Notify.success("Order marked as finished and moved to shipping table")
                                } else if (data == "notfound") {
                                    Notiflix.Notify.failure("Order data not found")
                                }
                            }, 500)
                        })
                        .fail(function() {
                            Notiflix.Loading.remove()
                            Notiflix.Report.failure('Server Error',
                                'Please check your connection and server status',
                                'Okay', )
                        })
                },
                () => {}, {},
            );
        }

        function markAsCompleted(id, order_no) {

            Notiflix.Report.info(
                'Mark Order As Completed',
                'Marking an order as complete will delete all photos related to this order',
                'Understand',
                () => {
                    Notiflix.Confirm.show('Mark Order As Completed',
                        'Do you want to mark order ' + order_no + ' as completed and move it to completed order table?',
                        'Yes',
                        'No',
                        () => {
                            Notiflix.Loading.pulse()
                            $.post("<?= base_url('admin/orders/completed') ?>", {
                                    id: id,
                                    order_no: order_no
                                })
                                .done(function(data) {
                                    fetchAllTable()
                                    Notiflix.Loading.remove(500)
                                    setTimeout(() => {
                                        if (data == "success") {
                                            Notiflix.Notify.success("Order marked as completed and moved to completed order table")
                                        } else if (data == "notfound") {
                                            Notiflix.Notify.failure("Order data not found")
                                        }
                                    }, 500)
                                })
                                .fail(function() {
                                    Notiflix.Loading.remove()
                                    Notiflix.Report.failure('Server Error',
                                        'Please check your connection and server status',
                                        'Okay', )
                                })
                        },
                        () => {}, {},
                    );
                },
            );
        }

        function switchEditMode() {

            if ($('#buttonUpdateShippingInfo').attr('hidden') == 'hidden') {
                $('#buttonUpdateShippingInfo').removeAttr('hidden')
                $('#text-mode').html('Read Mode')

                $('#updateSenderName').removeAttr('disabled')
                $('#updateSenderPhone').removeAttr('disabled')
                $('#updateSenderAddress').removeAttr('disabled')
            } else {
                $('#buttonUpdateShippingInfo').attr('hidden', 'hidden')
                $('#text-mode').html('Edit Mode')
                $('#updateSenderName').attr('disabled', 'disabled')
                $('#updateSenderPhone').attr('disabled', 'disabled')
                $('#updateSenderAddress').attr('disabled', 'disabled')
            }


        }

        <?php
        if (isset($_SESSION['ReturnSuccess'])) {
        ?>
            Notiflix.Notify.success("<?= $_SESSION['ReturnSuccess'] ?>")
        <?php
        }

        if (isset($_SESSION['ReturnFailed'])) {
        ?>
            Notiflix.Notify.failure("<?= $_SESSION['ReturnFailed'] ?>")
        <?php
        }
        ?>
    </script>
</body>

</html>