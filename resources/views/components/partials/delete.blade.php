<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body px-4">
                <div class="p-2 d-inline-block rounded-circle mb-3" style="background-color: #FEF3F2">
                    <div class="icon-wrapper rounded-circle text-danger">
                        <div class="icon-wrapper-bg" style="background-color: #FEE4E2;"></div>
                        <i class="fas fa-trash-alt"></i>
                    </div>
                </div>

                <h5 class="fw-medium mb-2">Apakah Kamu Yakin?</h5>
                <p class="text-muted-tms">
                    Yakin ingin menghapus {{ $item }} ini? Tindakan ini
                    <br>
                    tidak bisa dibatalkan.
                </p>

                <form action="" id="{{ $formId }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <button type="button" class="btn btn-outline-secondary-app text-dark fw-medium" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-danger-app btn-delete-data fw-medium">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
<script>
    $(document).ready(function () {
        $('.{{ $buttonDelete }}').on('click', function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            $('#{{ $formId }}').attr('action', url);
            $('#{{ $modalId }}').modal('show');
        });
    });
</script>
@endpush
