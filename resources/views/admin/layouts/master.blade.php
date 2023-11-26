@include('admin.layouts.includes.header')
<!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin.layouts.includes.sidebar')
  <!-- End Sidebar-->

    <main id="main" class="main">

        @yield('main_content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    {{-- @include('backend.layouts.includes.footer') --}}
<!-- End Footer -->

    <a href="{{ asset('admin') }}/#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('admin') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/quill/quill.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('admin') }}/assets/js/main.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
