@extends('admin.layout.app')
@section('title','Sub-SubCategories View')

@section('header')
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.13.4/css/dataTables.material.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css')}}" />

<style>
    .create { margin-bottom: 20px; }
    table.dataTable thead th { background-color: #3f51b5; color: #fff; text-align: center; }
    table.dataTable tbody tr:hover { background-color: #f5f5f5; }
    .dt-buttons .btn { margin-right: 10px; background-color: #3f51b5; color: white; }
    .dt-buttons .btn:hover { background-color: #5c6bc0; }
    .image-preview { max-width: 100px; cursor: pointer; }
    #subsubcategoriesTable { max-height: 400px; overflow-y: auto; display: block; }
    #subsubcategoriesTable th, #subsubcategoriesTable td { text-align: center; padding: 8px; }
</style>
<script src="{{url('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection

@section('content')
<div class="main-panel" style="width: 100%;">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ __('messages.subsubcategories') }}</h1>
                        <a href="{{ route('subsubcategories.create', ['lang' => app()->getLocale()]) }}" class="btn btn-primary create">
                            <i class="fas fa-plus-circle"></i> {{ __('messages.create_subsubcategory') }}
                        </a>
                        <table id="subsubcategoriesTable" class="display">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.discription') }}</th>
                                    <th>{{ __('messages.subcategory') }}</th>
                                    <th>{{ __('messages.category') }}</th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($subsubcategories as $subsubcategory)
                                <tr>
                                    <td>{{ $subsubcategory->{'name_' . $lang} }}</td>
                                    <td>{!! $subsubcategory->{'description_' . $lang} !!}</td>
                                    <td>{{ $subsubcategory->subcategory->{'name_' . $lang} ?? '' }}</td>
                                    <td>{{ $subsubcategory->subcategory->category->{'name_' . $lang} ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('subsubcategories.edit', ['lang' => app()->getLocale(), 'subsubcategory' => $subsubcategory->id]) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $subsubcategory->id }}" action="{{ route('subsubcategories.destroy', ['subsubcategory' => $subsubcategory->id, 'lang' => app()->getLocale()]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $subsubcategory->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{url('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js')}}"></script>
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#subsubcategoriesTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copy', text: '<i class="fas fa-copy"></i>', className: 'btn btn-primary' },
                { extend: 'excel', text: '<i class="fas fa-file-excel"></i>', className: 'btn btn-success' },
                { extend: 'pdf', text: '<i class="fas fa-file-pdf"></i>', className: 'btn btn-danger' },
                { extend: 'print', text: '<i class="fas fa-print"></i>', className: 'btn btn-warning' }
            ],
            language: {
                paginate: { next: "Next", previous: "Previous" },
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries"
            },
            lengthMenu: [5, 10, 25, 50, 100],
            pageLength: 10,
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure you want to delete this item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
