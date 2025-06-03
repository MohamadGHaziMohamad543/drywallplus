@extends('admin.layout.app')

@section('title', 'About View')

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
        .image-preview {
            max-width: 100px;
            cursor: pointer;
        }
        #eventsTable {
    max-height: 400px; /* تحديد ارتفاع الجدول */
    overflow-y: auto; /* تفعيل التمرير الرأسي */
    display: block; /* تجنب تعارض التمرير مع محتويات الجدول */
}

#eventsTable th, #eventsTable td {
    text-align: center; /* محاذاة النص في الجدول */
    padding: 8px; /* مسافة padding حول النص */
}

#eventsTable thead th {
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
                            <h1>{{ __('messages.abouts') }}</h1>
                            <a href="{{ route('abouts.create', ['lang' => app()->getLocale()]) }}" class="btn btn-primary create">
                                <i class="fas fa-plus-circle"></i> {{ __('messages.about_event') }}
                            </a>
                            <table id="eventsTable" class="display" style="max-height: 400px; overflow-y: auto;">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>{{ __('messages.description') }}</th>
                                        <th>{{ __('messages.image') }}</th>
                                        <th>{{ __('messages.images') }}</th>
                                        <th>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($abouts as $about)
                                    <tr>
                                        <td>{{ $about->{'name_' . app()->getLocale()} ?? $about->name_en  }}</td>
                                        <td>{!! $about->{'desc_' . app()->getLocale()} ?? $about->desc_en  !!}</td>
                                        <td>
                                            @if($about->image)
                                                <a href="{{ asset($about->image) }}" data-fancybox="gallery">
                                                    <img src="{{ asset($about->image) }}" class="image-preview" alt="Event Image" />
                                                </a>
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>

                                            @if(!empty($about->images))
                                            @php
                                                $images = is_array($about->images) ? $about->images : json_decode($about->images, true);
                                            @endphp

                                            @foreach($images as $image)
                                                    <a href="{{ asset($image) }}" data-fancybox="gallery">
                                                        <img src="{{ asset($image) }}" width="50" class="image-preview" alt="Event Image" />
                                                    </a>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('abouts.show', ['lang' => app()->getLocale(), 'about' => $about->id]) }}" class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('abouts.edit', ['lang' => app()->getLocale(), 'about' => $about->id]) }}" class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $about->id }}" action="{{ route('abouts.destroy', ['about' => $about->id, 'lang' => app()->getLocale()]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $about->id }})">
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
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#eventsTable').DataTable({
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

        function confirmDelete(eventId) {
            Swal.fire({
                title: "Are you sure you want to delete this event?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + eventId).submit();
                }
            });
        }
    </script>
@endsection
