@extends('admin.layout.app')

@section('title', 'Contact Us View')

@section('header')
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.13.4/css/dataTables.material.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css') }}" />

    <style>
        .create {
            margin-bottom: 20px;
        }
        table.dataTable thead th {
            background-color: #3f51b5;
            color: #fff;
            text-align: center;
        }
        table.dataTable tbody tr:hover {
            background-color: #f5f5f5;
        }
        .dt-buttons .btn {
            margin-right: 10px;
            background-color: #3f51b5;
            color: white;
        }
        .dt-buttons .btn:hover {
            background-color: #5c6bc0;
        }
        #contactUsTable {
    max-height: 400px; /* تحديد ارتفاع الجدول */
    overflow-y: auto; /* تفعيل التمرير الرأسي */
    display: block; /* تجنب تعارض التمرير مع محتويات الجدول */
}

#contactUsTable th, #contactUsTable td {
    text-align: center; /* محاذاة النص في الجدول */
    padding: 8px; /* مسافة padding حول النص */
}

#contactUsTable thead th {
    background-color: #3f51b5; /* تحديد لون الخلفية للرؤوس */
    color: white; /* تحديد لون النص للرؤوس */
}

    </style>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
@endsection

@section('content')
    <div class="main-panel" style="width: 100%;">
        <div class="content-wrapper">
            <div class="row">
                <div class="col grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ __('messages.contact_us') }}</h1>
                            <a href="{{ route('contact-us.create', ['lang' => app()->getLocale()]) }}" class="btn btn-primary create">
                                <i class="fas fa-plus-circle"></i> {{ __('messages.create_contact_us') }}
                            </a>
                            <table id="contactUsTable" style="" class="display" style="max-height: 400px; overflow-y: auto;">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.email') }}</th>
                                        <th>{{ __('messages.phone') }}</th>
                                        <th>{{ __('messages.whatsapp_link') }}</th>
                                        <th>{{ __('messages.facebook_link') }}</th>
                                        <th>{{ __('messages.linkedin_link') }}</th>
                                        <th>{{ __('messages.instagram_link') }}</th>
                                        <th>{{ __('messages.address') }}</th>
                                        <th>{{ __('messages.map') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($contactUs as $contact)
                                    <tr>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td><a href="{{ $contact->whatsapp_link }}" target="_blank">whatsapp_link</a></td>
                                        <td><a href="{{ $contact->facebook_link }}" target="_blank">facebook_link</a></td>
                                        <td><a href="{{ $contact->linkedin_link }}" target="_blank">linkedin_link</a></td>
                                        <td><a href="{{ $contact->instagram_link }}" target="_blank">instagram_link</a></td>
                                        <td>{{ $contact->{'address_' . app()->getLocale()} }}
                                        </td>
                                        <td><a href="{{ $contact->map_link }}" target="_blank">map_link</a></td>
                                        <td>
                                            <a href="{{ route('contact-us.edit', ['lang' => app()->getLocale(), 'contact_u' => $contact->id]) }}" class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $contact->id }}" action="{{ route('contact-us.destroy', ['contact_u' => $contact->id, 'lang' => app()->getLocale()]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $contact->id }})">
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
    <script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js') }}"></script>
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js') }}"></script>
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#contactUsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i>',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i>',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        className: 'btn btn-warning'
                    }
                ],
                "language": {
                    "paginate": {
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                },
                "lengthMenu": [5, 10, 25, 50, 100],
                "pageLength": 10,
            });
        });

        function confirmDelete(contactId) {
            Swal.fire({
                title: "Are you sure you want to delete this contact information?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + contactId).submit();
                }
            });
        }
    </script>
@endsection
