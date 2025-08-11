@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Plans')
@section('page-title', 'Plans')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Plans</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Manage your plans here.</p>
        </div>
    </div>
    <div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#planModal" data-mode="add">Add New Plan</button>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Plan Name</th>
                    <th>Price</th>
                    <th>Billing Period</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>{{ $plan->price }}</td>
                    <td>{{ ucfirst($plan->billing_period ?? 'monthly') }}</td>
                    <td>
                        <button class="btn btn-warning edit-plan" 
                                data-id="{{ $plan->id }}" 
                                data-name="{{ $plan->name }}" 
                                data-price="{{ $plan->price }}"
                                data-billing_period="{{ $plan->billing_period ?? 'monthly' }}"
                                data-toggle="modal" 
                                data-target="#planModal" 
                                data-mode="edit">Edit</button>
<button class="btn btn-danger delete-plan" 
                                data-id="{{ $plan->id }}" 
                                data-name="{{ $plan->name }}">Delete</button>                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>    
    </div>
</div>

<div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-labelledby="planModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planModalLabel">Add New Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="planForm" action="{{ route('storePlan') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="planName">Plan Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter plan name">
                    </div>
                    <div class="form-group">
                        <label for="planPrice">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter plan price">
                    </div>
                    <div class="form-group">
                        <label for="billing_period">Billing Period</label>
                        <select class="form-control" id="billing_period" name="billing_period">
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Plan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#planModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var mode = button.data('mode'); // Extract mode (add or edit)
            var modal = $(this);
            var form = modal.find('#planForm');

            if (mode === 'edit') {
                var id = button.data('id');
                var name = button.data('name');
                var price = button.data('price');
                var billingPeriod = button.data('billing_period');

                // Update modal title and form action
                modal.find('.modal-title').text('Edit Plan');
                form.attr('action', '/admin/plans/' + id);
                form.find('input[name="_method"]').remove(); // Ensure no duplicate _method field
                form.append('<input type="hidden" name="_method" value="PUT">');

                // Populate form fields
                form.find('#name').val(name);
                form.find('#price').val(price);
                form.find('#billing_period').val(billingPeriod || 'monthly');
            } else {
                // Reset for adding a new plan
                modal.find('.modal-title').text('Add New Plan');
                form.attr('action', '{{ route("storePlan") }}');
                form.find('input[name="_method"]').remove();
                form.find('#name').val('');
                form.find('#price').val('');
                form.find('#billing_period').val('monthly');
            }
        });

        $(document).on('click', '.delete-plan', function() {
        var planId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/plans/' + planId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    });

        // Show success/error messages with SweetAlert
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session("success") }}',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session("error") }}',
                icon: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endsection