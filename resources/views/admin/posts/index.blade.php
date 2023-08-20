<x-admin-layout title="{{ __('All Posts') }}">

    @livewire('admin.posts')

    @push('scripts')
        <script>
            window.addEventListener('delete', ({
                detail: {
                    id,
                    title,
                    text,
                }
            }) => {

                console.log(1);

                Swal.fire({
                    title: title,
                    text: text,
                    heightAuto: false,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: @json(__('Yes')),
                    cancelButtonText: @json(__('Cancel')),
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('delete-action', id)
                    }
                })


            })

            window.addEventListener('delete-selected', ({
                detail: {
                    title,
                    text,
                }
            }) => {

                Swal.fire({
                    title: title,
                    text: text,
                    heightAuto: false,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: @json(__('OK!')),
                    cancelButtonText: @json(__('Cancel')),
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('execute-action', true)
                    }
                })
            })
        </script>
    @endpush
</x-admin-layout>
