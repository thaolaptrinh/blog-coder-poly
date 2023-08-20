<x-admin-layout title="{{ __('New Post') }}">

    @livewire('admin.new-post')

    @push('scripts')
        <script>
            window.addEventListener('clear-tinymce', function(e) {
                if (tinymce.get('tinymce-editor')) {
                    tinymce.get('tinymce-editor').setContent('');
                }
            })
        </script>

        {{-- <script>
            function showFile(event, id) {

                var input = event.target
                var reader = new FileReader()

                reader.readAsDataURL(input.files[0])

                reader.onload = function() {
                    var dataUrl = reader.result;
                    var output = document.getElementById(id)
                    output.src = dataUrl
                }

                reader.onerror = function() {
                    console.log(reader.error);
                };

            }
        </script> --}}
    @endpush

</x-admin-layout>
