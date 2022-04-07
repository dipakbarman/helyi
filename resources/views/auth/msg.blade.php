@extends('admin.master')
@section("body")

<!--app-content open-->
<div class="app-content">
    <div class="side-app">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <ol class="breadcrumb"><!-- breadcrumb -->
                
            </ol><!-- End breadcrumb -->
        </div>
        <!-- PAGE-HEADER END -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">Message forms</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                    
                                    <button onclick="startFCM()"
                                        class="btn btn-danger btn-flat">Allow notification
                                    </button>
                    
                                <div class="card mt-3">
                                    <div class="card-body">
                                        @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                    
                                        <form action="{{ route('send.web-notification') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Message Title</label>
                                                <input type="text" class="form-control" name="title">
                                            </div>
                                            <div class="form-group">
                                                <label>Message Body</label>
                                                <textarea class="form-control" name="body"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                                        </form>
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>
<!-- CONTAINER END -->
<!-- CONTAINER END -->

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

<script>
    var firebaseConfig = {
        apiKey: "AIzaSyApwkkc1CIUOWsyyWRCCv-YGzBUS5N4Uz0",
  authDomain: "pushmsg-43122.firebaseapp.com",
  projectId: "pushmsg-43122",
  storageBucket: "pushmsg-43122.appspot.com",
  messagingSenderId: "557522217700",
  appId: "1:557522217700:web:25fcb0337cc31435f9daf1",
  measurementId: "G-R11TSYHVCF"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("store.token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token stored.');
                    },
                    error: function (error) {
                        alert(error);
                    },
                });

            }).catch(function (error) {
                alert(error);
            });
    }

    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });

</script>
@endsection