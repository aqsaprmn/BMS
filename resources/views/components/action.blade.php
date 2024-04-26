<div class="card">
    <div class="card-header pb-0">
        <h4 class="card-title mb-0">Action</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-md-0 mb-2">
                    <button type="button" id="btnGo"
                        class="btn btn-primary form-control whitespace-nowrap">{{ $action }}</button>
                </div>
                <div class="col-md-4 mb-md-0 mb-2">
                    <button type="reset" class="btn btn-light-info form-control">Reset</button>
                </div>
                <div class="col-md-4 mb-md-0 mb-2">
                    <a href="{{ url("$to") }}" class="btn btn-light-secondary form-control">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(function() {
            $("#btnGo").click(function(e) {
                var form = this.closest("form");
                const action = $(this).html();

                Swal.fire({
                    title: `Sure for ${action}?`,
                    text: `${action} will be processed!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            })
        })
    </script>
@endsection
