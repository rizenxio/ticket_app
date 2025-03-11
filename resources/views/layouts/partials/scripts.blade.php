<script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
<script>
    // Script untuk validasi form bootstrap
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // Format harga dengan pemisah ribuan
    document.getElementById('price').addEventListener('input', function(e) {
        
        let value = this.value.replace(/\D/g, '');
        this.value = value;
    });
    
    // Preview gambar sebelum upload
    document.getElementById('images').addEventListener('change', function(e) {
        const file = this.files[0];
        const fileType = file.type;
        const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        
        if (file && validImageTypes.includes(fileType)) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('d-none');
            }
            
            reader.readAsDataURL(file);
        } else {
            alert('File harus berupa gambar (JPG, JPEG, atau PNG)');
            this.value = '';
        }
    });
    
    // Hapus gambar preview
    document.getElementById('removeImage').addEventListener('click', function() {
        document.getElementById('images').value = '';
        document.getElementById('imagePreview').classList.add('d-none');
    });
</script>
@stack('scripts')
