<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('uipack/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    {{--  <link rel="stylesheet" href="{{ asset('uipack/assets/vendor/libs/apex-charts/apex-charts.css') }}" /> --}}
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('uipack/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('uipack/assets/js/config.js') }}"></script>
    <style>
        @page {
            header: page-header;
            footer: page-footer;


        }

        body {
            font-family: 'examplefont', sans-serif;

        }
    </style>
</head>


<body>

    {{-- {{ $data[0]->id }} --}}
    {{-- {!! QrCode::size(50)->generate(url('fix?id=') . $data[0]->id) !!} --}}
    <table>
        <tr>
            <td><img src="data:image/png;base64, {!! base64_encode(
                QrCode::eye('circle')->format('png')->size(500)->generate(url('fix?id=') . $data[0]->id)) !!} "></td>
            <td class="px-1">
                <p class="text-nowrap mb-1" style="font-size: 12px;font-weight: bold;">รหัส: {{ $data[0]->id }}</p>
                <p class="text-nowrap mb-1" style="font-size: 12px;font-weight: bold;">เลขครุภัณฑ์:
                    {{ $data[0]->durable_id }}</p>
                <p class="text-nowrap mb-1" style="font-size: 12px;font-weight: bold;">ประเภท:
                    {{ $data[0]->com_type_name }}</p>
                <p class="text-nowrap mb-1" style="font-size: 12px;font-weight: bold;">หน่วยงาน:
                    {{ $data[0]->inv_dep_name }}</p>
                <p class="text-nowrap mb-1" style="font-size: 12px;font-weight: bold;">ปีที่ได้รับ:
                    {{ $data[0]->year_received }}</p>

            </td>
        </tr>
    </table>
   {{--  <htmlpageheader name="page-header">
        แจ้งซ่อม
    </htmlpageheader>

    <htmlpagefooter name="page-footer">
        Your Footer Content
    </htmlpagefooter> --}}
    <script src="{{ asset('uipack/assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('uipack/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('uipack/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('uipack/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('uipack/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    {{-- <script src="{{ asset('uipack/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
    <!-- Main JS -->
    <script src="{{ asset('uipack/assets/js/main.js') }}"></script>
    <!-- Page JS -->
    {{-- <script src="{{ asset('uipack/assets/js/dashboards-analytics.js') }}"></script> --}}
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
