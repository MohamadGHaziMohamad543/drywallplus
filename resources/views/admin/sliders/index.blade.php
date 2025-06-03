@extends('admin.layout.app')
@section('title','Team View')
@section('header')
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.13.4/css/dataTables.material.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css')}}" />

<style>
    .create{
        margin-bottom:20px;
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

    /* Custom styles for image preview */
    .image-preview {
        max-width: 100px;
        cursor: pointer;
    }
    #teamsTable {
    max-height: 400px; /* تحديد ارتفاع الجدول */
    overflow-y: auto; /* تفعيل التمرير الرأسي */
    display: block; /* تجنب تعارض التمرير مع محتويات الجدول */
}

#teamsTable th, #teamsTable td {
    text-align: center; /* محاذاة النص في الجدول */
    padding: 8px; /* مسافة padding حول النص */
}

#teamsTable thead th {
    background-color: #3f51b5; /* تحديد لون الخلفية للرؤوس */
    color: white; /* تحديد لون النص للرؤوس */
}
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
                        <h1>{{ __('messages.slider') }}</h1>
                        <a href="{{ route('sliders.create', ['lang' => app()->getLocale()]) }}" class="btn btn-primary create"><i class="fas fa-plus-circle"></i> {{ __('messages.create_slider') }}</a>
                        <table id="teamsTable" style="" class="display" style="max-height: 400px; overflow-y: auto;">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.title') }}</th>
                                    <th>{{ __('messages.disc') }}</th>
                                    <th>{{ __('messages.image') }}</th>
                                    
                                    <th>{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->{'title_' . app()->getLocale()} ?? $slider->title_en }}</td>
                                    <td>{!! $slider->{'description_' . app()->getLocale()} ?? $slider->description_en !!}</td>
                                    <td>
                                            <a href="{{ asset($slider->image_path) }}" data-fancybox="gallery">
                                                <img src="{{ asset($slider->image_path) }}" class="image-preview" alt="team Image" />
                                            </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('sliders.edit', ['lang' => app()->getLocale(), 'slider' => $slider->id]) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                        <form id="delete-form-{{ $slider->id }}" action="{{ route('sliders.destroy', ['slider' => $slider->id, 'lang' => app()->getLocale()]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $slider->id }})">
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
    $('#teamsTable').DataTable({
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
    function confirmDownload(pdfUrl) {
        const messages = {
            'en': "Are you sure you want to generate the PDF file?",
            'ar': "هل أنت متأكد أنك تريد تحويل الملف إلى PDF؟",
            'de': "Sind Sie sicher, dass Sie die PDF-Datei generieren möchten?",
            'tr': "PDF dosyasını oluşturmak istediğinizden emin misiniz?",
            'zh': "您确定要生成 PDF 文件吗？",
            'fr': "Êtes-vous sûr de vouloir générer le fichier PDF ?",
            'nl': "Weet u zeker dat u het PDF-bestand wilt genereren?"
        };

        // تحديد اللغة الحالية
        let currentLang = "{{ app()->getLocale() }}";
        let confirmMessage = messages[currentLang] || messages['en']; // الافتراضي هو الإنجليزية

        Swal.fire({
            title: confirmMessage,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = pdfUrl; // تحميل PDF
            }
        });
    }
    function confirmDelete(userId) {
        const messages = {
            'en': "Are you sure you want to delete this user?",
            'ar': "هل أنت متأكد أنك تريد حذف هذا المستخدم؟",
            'de': "Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?",
            'tr': "Bu kullanıcıyı silmek istediğinizden emin misiniz?",
            'zh': "您确定要删除此用户吗？",
            'fr': "Êtes-vous sûr de vouloir supprimer cet utilisateur ?",
            'nl': "Weet u zeker dat u deze gebruiker wilt verwijderen?"
        };

        // تحديد اللغة الحالية
        let currentLang = "{{ app()->getLocale() }}";
        let confirmMessage = messages[currentLang] || messages['en']; // الافتراضي هو الإنجليزية

        Swal.fire({
            title: confirmMessage,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit(); // إرسال النموذج لحذف المستخدم
            }
        });
    }
</script>
@endsection