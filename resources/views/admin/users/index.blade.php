<x-admin-layout title="{{ __('Users') }}">
    @livewire('admin.user.user-list')


    @push('scripts')
        <script>
            
            $(window).on('hidden.bs.modal', function() {
                Livewire.emit('reset-form')
            })

            window.addEventListener('deleteUser', ({
                detail: {
                    id,
                    title,
                    text,
                }
            }) => {

                Swal.fire({
                    title: title,
                    text: text,
                    heightAuto: false,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: @json(__('OK!')),
                    cancelButtonText: @json(__('Cancel')),
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('delete-user-action', id)
                    }
                })


            })
        </script>
    @endpush


</x-admin-layout>
