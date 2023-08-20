 <!-- Favicons -->
 <link href="{{ asset('server/img/favicon.png') }}" rel="icon">
 <link href="{{ asset('server/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

 <!-- Google Fonts -->
 <link href="https://fonts.gstatic.com" rel="preconnect">
 <link
     href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
     rel="stylesheet">

 <!-- Vendor CSS Files -->
 <link href="{{ asset('server/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
 <link href="{{ asset('server/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
 <link href="{{ asset('server/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
 <link href="{{ asset('server/vendor/quill/quill.snow.css') }}" rel="stylesheet">
 <link href="{{ asset('server/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
 <link href="{{ asset('server/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
 <link href="{{ asset('server/vendor/simple-datatables/style.css') }}" rel="stylesheet">

 <!-- Template Main CSS File -->
 <link href="{{ asset('server/css/style.css') }}" rel="stylesheet">
 <style>
     @-webkit-keyframes blinker {
         from {
             opacity: 1.0;
         }

         to {
             opacity: 0.0;
         }
     }

     .blink {
         text-decoration: blink;
         color: lightcoral;
         background-color: lightyellow;
         font-weight: bold;
         -webkit-animation-name: blinker;
         -webkit-animation-duration: 0.6s;
         -webkit-animation-iteration-count: infinite;
         -webkit-animation-timing-function: ease-in-out;
         -webkit-animation-direction: alternate;
     }
 </style>
 @yield('additional-css')
