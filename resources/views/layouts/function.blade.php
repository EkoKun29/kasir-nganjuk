<!-- jQuery -->
<script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets') }}/js/adminlte.min.js"></script>
<!-- Datatables -->
<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<!-- Select -->
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- Sweet Alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Datatables --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>

    $(document).ready(function() {
        // USE DATATABLE
        $('.table-dt').DataTable();

        // USE SELECT 2
        $('#select2').select2({
            theme: 'bootstrap4',
        });

        // RESET FORM INPUT WHEN CREATE MODAL ACTIVE
        $('#createModal').on('show.bs.modal', function() {
            $(this).find('form').trigger('reset');
        })
    });

    function formatRupiah(number) {
        var formatter = new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        });

        return formatter.format(number);
    }

    // Fungsi untuk mengubah angka menjadi format mata uang rupiah
    function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }
</script>
@stack('js')
