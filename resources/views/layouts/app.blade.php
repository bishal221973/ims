{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}



<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    @php
        $org = App\Models\Organization::where('id', orgId())->first();
    @endphp
    <title>
        @if ($org)
            {{ $org->organization_name }} | @yield('title')
        @else
            Inventery Management System
        @endif
    </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/jquery-steps/jquery.steps.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('nepalidate.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>

    <style>
        .dashed-bottom {

            border-bottom: #ccc dotted;
        }

        .myTable tr th,
        .myTable tr td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .lastRow td {
            padding-bottom: 100px !important;
            border: none !important;
            border: 1px solid #ccc !important;
        }
    </style>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="login-page">

    @guest
        @yield('content')
    @else
        <x-header-component />
        <div style="height: 42px"></div>

        <x-sidebar-component />
        <div class="mobile-menu-overlay"></div>
        @yield('content')
    @endguest




    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>


    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('vendors/scripts/datatable-setting.js') }}"></script>
    @stack('addProduct')

    <script src="{{ asset('nepalidate.js') }}"></script>
    <script type="text/javascript">
        var mainInput = document.getElementById("nepali-datepicker");
        mainInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 100
        });

        var mainInput = document.getElementById("nepali-datepicker1");
        mainInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 100
        });
        var mainInput = document.getElementById("nepali-datepicker2");
        mainInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 100
        });
    </script>
    @stack('myscripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script></script>

    @yield('message')
    @stack('message')

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <script>
        $('#countryId').on('change', function() {
            var id = $(this).val();
            var url = "{{ route('province.select', ':id') }}";
            // alert(id);
            url = url.replace(':id', id);
            $("#ProvinceId").empty();
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    var resultData = dataResult.provinces;
                    var bodyData = '';
                    var i = 0;
                    for (var i = 0; i < dataResult.provinces.length; i++) {
                        $('#ProvinceId').append($('<option>', {
                            value: dataResult.provinces[i].id,
                            text: dataResult.provinces[i].name
                        }));
                        // appendImageCategorySelect(resultData[i].id, resultData[i].category);
                    }
                }
            });
        });
    </script>
    <script>
        $("#supplier_id").on('change',function(){
            var id=$(this).val();

            var url="{{route('purchase.supplier',':id')}}"
            url=url.replace(':id',id);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    $("#supplierPhone").val(dataResult.data.phone);
                    // console.log();
                }
            });
        });
    </script>
    <script>
        $("#txtPhoneNumber").on("input", function() {
            var phoneNumber = $(this).val();

            var url = "{{ route('filterCustomer', ':number') }}";
            url = url.replace(':number', phoneNumber);
            $("#ProvinceId").empty();
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    $("#txtCustomerName").val(dataResult.data.name);
                    $("#txtCustomerEmail").val(dataResult.data.email);
                    $("#customer_id").val(dataResult.data.id);
                    $("#vat_number").val(dataResult.data.vat_number);
                    $("#txtCustomerAddress").val(dataResult.data.address);
                }
            });
        });
    </script>

    <script>
        $("#txtSalesInvoiceNumber").on('input', function(e) {
            e.preventDefault;
            var invoiceNumber = $(this).val();
            var url = "{{ route('salesReturn', ':invoice') }}";

            $('#myData').empty();

            url = url.replace(':invoice', invoiceNumber);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    $("#txtSalesCustomerName").val(dataResult.data.customer.name);
                    $("#txtSalesCustomerPhone").val(dataResult.data.customer.phone);
                    $("#txtSalesCustomerDate").val(dataResult.data.transaction_date);
                    $("#salesId").val(dataResult.data.id);


                    for (var i = 0; i < dataResult.data.sales_product.length; i++) {
                        // console.log(dataResult.data);
                        $('#myData').append('<tr><td></td><td>' + dataResult.data.sales_product[i]
                            .product.name + '</td><td>' + dataResult.data.sales_product[i]
                            .quantity + '(' + dataResult.data.sales_product[i].product.unit.name +
                            ')' +
                            '</td><td> RS. ' + dataResult.data.sales_product[i]
                            .price +
                            ' /-</td><td><input type="hidden" name="product_id[]" value="' +
                            dataResult
                            .data.sales_product[i].product_id +
                            '"/><input type="number" name="quantity[]" required class="form-control"></td><td><input type="text" name="reason[]"  class="form-control"></td></tr>'
                        )
                        // $('#myData').append('<tr><td>' + response[0][i]['id'] + '</td><td>' + response[0][i]['first_name'] + " " + response[0][i]['last_name'] + '</td><td>' + response[0][i]['table'] + '</td><td>' + response[0][i]['items_won'] + '</td><td>' + response[0][i]['pledges_made'] +'</td><td>' + response[0][i]['amount_owed'] + '</td><td><button class="btn btn-primary">CLICK HERE</button></td></tr>');
                        // $('#myData').append('<tr><td>' + dataResult.data.sales_product[i].+ '</td><td>' + + " " +  + '</td><td>' +  + '</td><td>' +  + '</td><td>' +  +'</td><td>' +  + '</td><td><button class="btn btn-primary">CLICK HERE</button></td></tr>');
                    }
                }
            });
        });
    </script>

    <script>
        var month = NepaliFunctions.GetCurrentBsMonth();
        var url = "{{ route('totalPurchase', ':month') }}";
        url = url.replace(':month', month);
        $("#ProvinceId").empty();
        $.ajax({
            url: url,
            type: "GET",
            data: {
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                // alert(dataResult);
                // console.log(dataResult);
                $("#purchaseText").text(dataResult);
            }
        });
    </script>

    <script>
        // var id = $(this).val();
        var url = "{{ route('totalSales', ':month') }}";
        url = url.replace(':month', '4');
        $("#ProvinceId").empty();
        $.ajax({
            url: url,
            type: "GET",
            data: {
                _token: '{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult) {
                // console.log(dataResult);
                $("#salesText").text(dataResult);
            }
        });
    </script>
    <script>
        $('#schedule_branch_id').on('change', function() {
            var id = $(this).val();
            var url = "{{ route('getEmployee', ':id') }}";
            // alert(id);
            url = url.replace(':id', id);
            $("#scheduleEmployeeId").empty();
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult.data);
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i = 0;
                    for (var i = 0; i < dataResult.data.length; i++) {
                        $('#scheduleEmployeeId').append($('<option>', {
                            value: dataResult.data[i].id,
                            text: dataResult.data[i].user.name
                        }));
                        // appendImageCategorySelect(resultData[i].id, resultData[i].category);
                    }
                }
            });
        });
    </script>

    <script>
        var jsVariable = "Hello from JavaScript!";

        $.ajax({
            type: "POST",
            url: "process.php", // URL to your PHP script
            data: {
                data: jsVariable
            }, // Send the variable as a POST parameter
            success: function(response) {
                console.log("PHP script response:", response);
            }
        });
    </script>

</body>

</html>
