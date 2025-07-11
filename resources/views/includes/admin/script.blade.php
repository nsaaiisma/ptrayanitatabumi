<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
<script>
    // Hanya digunakan untuk modal Add/Edit/Delete
    let editingItem = null;
    let deletingItem = null;

    $(document).ready(function() {
        // Sidebar toggle (optional)
        $('#toggle-sidebar').on('click', function() {
            $('.sidebar').toggleClass('collapsed');
            $('.content-area').toggleClass('expanded');
        });
    });

    // Modal handling
    function openModal(modalId) {
        $('#' + modalId).removeClass('hidden');
    }

    function closeModal(modalId) {
        $('#' + modalId).addClass('hidden');
    }

    function openDeleteModal() {
        $('#delete-modal').removeClass('hidden');
    }

    function closeDeleteModal() {
        $('#delete-modal').addClass('hidden');
        deletingItem = null;
    }

    function saveItem() {
        // Placeholder logic — in real app, handle via form submit to Laravel
        closeModal(); // pastikan modalId dikirim jika pakai banyak modal
        editingItem = null;
    }

    // SweetAlert2 Toast Success
    function toastr_success(msg) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "success",
            title: msg
        });
    }

    // SweetAlert2 Toast Error
    function toastr_error(msg) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "error",
            title: msg
        });
    }
</script>

@if (session('success'))
<script>
    toastr_success("{{ session('success') }}");
</script>
@endif
@if (session('error'))
<script>
    toastr_error("{{ session('error') }}");
</script>
@endif