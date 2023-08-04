    <!-- Bootstrap Script -->
    <script src="{{ url('frontend/libraries/bootstrap-5.2.3-dist/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('frontend/scripts/login.js') }}"></script>

    {{-- alert from session --}}
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
            });
        </script>
    @endif

    @if (session()->has('failed'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: "{{ session('failed') }}",
            });
        </script>
    @endif
