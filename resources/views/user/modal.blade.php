<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <form id="frmUser" action="{{ url()->current() . '/process' }}" method="POST" autocomplete="off">
            @if($type == 'EDIT')
            <input type="hidden" name="userId" value="{{ $user->userId }}">
            @endif

            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title">{{ ucfirst(strtolower($type)) }} User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Name" value="{{ $type == 'EDIT' ? $user->name : null }}" required>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $type == 'EDIT' ? $user->username : null }}" required>
                </div>

                @if($type == 'ADD')
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                </div>
                @endif

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        @foreach($role as $key => $value)
                        <option value="{{ $value->roleId }}" {{ $type == 'EDIT' && $user->roleId == $value->roleId ? 'selected' : null }}>{{ $value->roleName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ $type == 'ADD' ? 'Add' : 'Edit' }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    $('#frmUser').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let elementsForm = $(this).find('button, input, select');

        elementsForm.attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                elementsForm.removeAttr('disabled');

                if (response.RESULT == 'OK') {
                    swalSuccess(response.MESSAGE);

                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    swalError(response.MESSAGE);
                }
            }
        }).fail(function() {
            elementsForm.removeAttr('disabled');

            swalError();
        });
    });
</script>