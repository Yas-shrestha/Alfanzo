            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme')}}">
                <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column')}}">
                    <div class="mb-2 mb-md-0">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </div>
                </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>

            </div>
            <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
            </div>
            <script>
                @if (session('success'))
                    toastr.success('{{ session('success') }}')
                @endif
                @if (session('error'))
                    toastr.error('{{ session('error') }}')
                @endif
            </script>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <!-- / Layout wrapper -->



            <!-- Core JS -->
            <!-- build:js assets/vendor/js/core.js -->
            <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
            <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
            <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

            <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
            <!-- endbuild -->

            <!-- Vendors JS -->
            <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

            <!-- Main JS -->
            <script src="{{ asset('assets/js/main.js') }}"></script>

            <!-- Page JS -->
            <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

            <!-- Place this tag in your head or just before your close body tag. -->
            <script async defer src="https://buttons.github.io/buttons.js')}}"></script>
            <script>
                tinymce.init({
                    selector: '#myEditor', // Target the specific textarea
                    plugins: [
                        // Essential plugins
                        'image', 'link', 'lists', 'media', 'table', 'wordcount',
                        // Optional extras
                        'emoticons', 'charmap', 'searchreplace', 'visualblocks'

                    ],
                    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | link image  | numlist bullist  ',
                    menubar: false, // Simplify UI by removing menu bar
                    branding: false, // Remove "Powered by TinyMCE" branding
                    height: 400, // Set a comfortable height for the editor
                    image_title: true, // Enable title input for images
                    automatic_uploads: false, // Disable TinyMCE's built-in image uploader
                    file_picker_types: 'image', // Focus on images for the file picker
                    file_picker_callback: function(callback, value, meta) {
                        if (meta.filetype === 'image') {
                            const input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');
                            input.onchange = function() {
                                const file = this.files[0];
                                const reader = new FileReader();
                                reader.onload = function() {
                                    callback(reader.result, {
                                        alt: file.name
                                    });
                                };
                                reader.readAsDataURL(file);
                            };
                            input.click();
                        }
                    },
                    content_style: `
                        body { font-family:Arial,sans-serif; font-size:14px; }
                        img { max-width: 100%; height: auto; }
                    ` // Ensure images are responsive
                });
            </script>
            </body>

            </html>
