{{-- scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ url('backend/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
{{-- <script src="{{ url('backend/assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ url('backend/assets/demo/chart-bar-demo.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="{{ url('backend/js/datatables-simple-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="{{ url('frontend/scripts/script.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

{{-- alert from session --}}
@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            type: "success"
        }).then((result) => {
            // Reload the Page
            location.reload();
        });
    </script>
@endif

@if (session()->has('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: "{{ session('failed') }}",
            type: "failed"
        }).then((result) => {
            // Reload the Page
            location.reload();
        });
    </script>

    @if ((isset($errors) && $errors->has('oldPassword')) || $errors->has('password'))
        <script>
            const myModal = document.getElementById('modalUbahPassword');
            const modal = bootstrap.Modal.getOrCreateInstance(myModal);
            modal.show();
        </script>
    @endif
@endif
