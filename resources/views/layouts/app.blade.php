<!DOCTYPE html>
<html data-theme="emerald" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KisanSAT - Revolutionizing Agriculture') }}</title>
    @if (!empty($setting->application_logo) && file_exists(public_path('storage/' . $setting->application_logo)))
        <link type="image/x-icon" href="{{ asset('storage/' . $setting->application_logo) }}" rel="icon">
    @else
        <link type="image/x-icon" href="{{ asset('images/kisansat-logo.png') }}" rel="icon">
    @endif

    {{-- Fonts-  Headinng font is downloaded and imported in style.css file, this body font is imported via cdn --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <!-- Check if the local Font Awesome file exists -->
    @if (file_exists(public_path('assets/font-awesome.min.css')))
        <link href="{{ asset('assets/font-awesome.min.css') }}" rel="stylesheet">
    @else
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @endif

    {{-- STYLES --}}
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        /* Ensure table does not shrink */
        table {
            min-width: 1000px;
            /* Prevents shrinking */
        }

        table.dataTable thead th {
            white-space: nowrap;
            /* Keep headers aligned */
        }

        .dataTables_wrapper {
            width: 100%;
            overflow-x: auto;
            /* Enable horizontal scrolling */
        }

        .dataTables_wrapper .dataTables_length select {
            width: 60px !important;
        }

        /* Ensure table does not shrink */
        table {
            min-width: 1000px;
            /* Prevents shrinking */
        }

        table.dataTable thead th {
            white-space: nowrap;
            /* Keep headers aligned */
        }

        .dataTables_wrapper {
            width: 100%;
            overflow-x: auto;
            /* Enable horizontal scrolling */
        }

        .dataTables_wrapper .dataTables_length select {
            width: 60px !important;
        }

        /* for datatable scroller */
        div.dt-layout-row {
            overflow-y: hidden;
            padding: 0px 0px 25px 0px;
        }

        .select2-container .select2-selection--single {
            height: 45px !important;
        }
    </style>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1234100948458360');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1234100948458360&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/2.0.3/css/select.dataTables.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/fixedcolumns/5.0.1/css/fixedColumns.dataTables.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.dataTables.css" rel="stylesheet" />

    <!-- DataTables JS (Only ONE version) -->
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.3/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.1/js/dataTables.fixedColumns.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.print.min.js"></script>

    <!-- JS Dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Summernote -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>


    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Toggle sidebar based on screen width, if screen width if > 1024 sidebarToggle will be true --}}

<body x-data="{ sidebarToggle: window.innerWidth > 1024 }">
    <div class="flex h-screen overflow-hidden bg-gray-100">

        {{-- SIDEBAR --}}
        <x-sidebar />

        <!-- CONTENT AREA -->
        <div class="relative flex flex-col overflow-y-auto overflow-x-hidden transition-all duration-300 ease-in-out"
            :class="sidebarToggle ? 'lg:w-[calc(100%-18rem)]' : 'lg:w-full'">

            {{-- HEADER --}}
            <x-header />

            @include('components.alert')
            <!-- MAIN CONTENT -->
            <main>

                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    {{-- /* ------------------------------------------------------------------ CUSTOM CODE ----------------------------------------------------------------- */ --}}

    {{-- 
	<script>
		$(document).ready(function() {
			const $sidebar = $('#sidebar');
			const $menuText = $('.menu-text');
			const $menuIcon = $('#sidebar ul li a i');

			// Function to toggle sidebar and hide/show text
			function toggleSidebar() {
				$sidebar.toggleClass('w-72 w-16'); // Toggle width
				$menuText.toggleClass('hidden'); // Hide/Show menu text
				$menuIcon.toggleClass('me-5'); // Hide/Show menu text
				$('#sidebarToggle1 i').toggleClass('rotate-180'); // Rotate icon
			}

			// Sidebar toggle button
			$('#sidebarToggle, #sidebarToggle1').on('click', function() {
				toggleSidebar();
			});
		});
	</script> --}}

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener('click', function(event) {
            // Agar click delete button par hua hai
            if (event.target.classList.contains('delete-button')) {
                // SweetAlert message display karein
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to Delete!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    // Agar user ne 'Yes' button par click kiya hai
                    if (result.isConfirmed) {
                        // Uske parent form ko submit karein
                        event.target.closest('form').submit();
                    }
                });
            }
        });
        document.addEventListener('click', function(event) {
            // Agar click delete button par hua hai
            if (event.target.classList.contains('restore-button')) {
                // SweetAlert message display karein
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to Restore!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Restore it!'
                }).then((result) => {
                    // Agar user ne 'Yes' button par click kiya hai
                    if (result.isConfirmed) {
                        // Uske parent form ko submit karein
                        event.target.closest('form').submit();
                    }
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
