<x-admin-layout title="{{ __('Edit Post') }}">

    @livewire('admin.edit-post', ['post' => $post])

    @push('scripts')
        <script>
            window.addEventListener('clear-tinymce', function(e) {
                if (tinymce.get('tinymce-editor')) {
                    tinymce.get('tinymce-editor').setContent('');
                }
            })
        </script>
    @endpush

</x-admin-layout>
