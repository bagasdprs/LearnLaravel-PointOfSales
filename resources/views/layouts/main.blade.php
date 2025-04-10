<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title ?? '' }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">


</head>

<body>

    @include('sweetalert::alert')

    <!-- ======= Header ======= -->
    @include('.layouts.inc.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('layouts.inc.sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>@yield('title')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @yield('content')


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layouts.inc.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <script>
        function formatRupiah(number) {
            const formatted = number.toLocaleString("id", {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            })

            return formatted;
        }

        $('#category_id').change(function() {
            let cat_id = $(this).val(),
                option = `<option value="" disabled selected>Select One</option>`;

            $.ajax({
                type: 'GET',
                url: '/get-product/' + cat_id,
                dataType: 'json',
                success: function(resp) {
                    $.each(resp.data, function(index, value) {
                        option +=
                            `<option data-img="${value.product_photo}" value="${value.id}" data-price="${value.product_price}">${value.product_name}</option>`;

                    });
                    $('#product_id').html(option);

                }

            });

        });

        $(".add-row").click(function() {

            let tbody = $("tbody");
            let selectOption = $('#product_id').find('option:selected');
            let productName = selectOption.text();
            let productId = selectOption.val();
            let productPhoto = selectOption.data('img');
            let productPrice = parseInt(selectOption.data('price')) || 0;

            if ($('#category_id').val() == "") {
                alert('Please select category first!');
                return false;
            }

            if ($('#product_id').val() == "") {
                alert('Please select product first!');
                return false;
            }

            let newRow = "<tr>";
            newRow +=
                `<td><img src="{{ asset('storage/') }}/${productPhoto}" alt="Product Image" style="width: 70px; height: 70px;"></td>`
            newRow +=
                `<td>${productName}<input type='hidden' name='product_id[]' value='${productId}'></td>`
            newRow += `<td width='110'><input value='1' type='number' name='qty[]' class='qty form-control'></td>`
            newRow +=
                `<td><input type='hidden' name='order_price[]' value='${productPrice}'><span class='price' data-price=${productPrice}>Rp. ${formatRupiah(productPrice)}</span></td>`
            newRow +=
                `<td><input type='hidden' class='subtotal_input' name='order_subtotal[]' value='${productPrice}'><span class='subtotal'>${formatRupiah(productPrice)}</span></td>`
            newRow += "</tr>";

            tbody.append(newRow);

            calculatedSubtotal();

            clearAll();

            $('.qty').off().on('input', function() {
                {{--  Cara 1  --}}
                let row = $(this).closest('tr');
                let qty = parseInt($(this).val()) || 0;
                let price = parseInt(row.find('.price').data('price')) || 0;
                let total = qty * price;
                row.find('.subtotal').text(formatRupiah(total));
                row.find('.subtotal_input').val(formatRupiah(total));

                calculatedSubtotal();

                {{--  Cara 2  
          let qty = $(this).val();
          let price = productPrice;
          let subtotal = qty * price;
          $(this).closest('tr').find('.subtotal').text(formatRupiah(subtotal));  --}}
            });
        })

        function calculatedSubtotal() {

            {{--  Cara 1  --}}
            let grandtotal = 0;
            $('.subtotal').each(function() {
                let total = parseInt($(this).text().replace(/\./g, ''));
                grandtotal += total;

            });

            $('.grandtotal').text(formatRupiah(grandtotal));
            $('input[name="grandtotal"]').val(grandtotal);
        }

        function clearAll() {
            $('#category_id').val('');
            $('#product_id').val('');
        }
    </script>
</body>

</html>
