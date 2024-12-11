<!-- partial:partials/_navbar.html -->
<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">

            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p><span id="notificationCount">0</span> New Notifications</p>
                        <a href="javascript:;" class="text-muted" onclick="clearNotifications()">Clear all</a>
                    </div>
                    <div class="p-1" id="notificationList">
                        <!-- Notifikasi akan dimuat di sini -->
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li> --}}


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80"
                                alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ $user->name }}</p>
                            <p class="tx-12 text-muted">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="dropdown-inner">
                        <ul class="link-list">
                            <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View
                                        Profile</span></a></li>

                        </ul>
                    </div>
                    <div class="dropdown-inner">
                        <ul class="link-list">
                            <li><a href="#" class="text-body ms-0"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                    {{-- <ul class="list-unstyled p-1">

                        <li class="dropdown-item py-2">
                            <a href="#" class="text-body ms-0"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </li>

                    </ul> --}}
                </div>
            </li>
        </ul>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchNotifications(); // Panggil ketika halaman selesai dimuat
    });

    function fetchNotifications() {
        fetch('/get-notifications') // Pastikan route untuk controller benar
            .then(response => response.json())
            .then(data => {
                let notificationList = document.getElementById('notificationList');
                let notificationCount = document.getElementById('notificationCount');

                notificationList.innerHTML = ''; // Kosongkan list notifikasi
                if (data.length > 0) {
                    notificationCount.innerText = data.length; // Update jumlah notifikasi
                    data.forEach(notification => {
                        let listItem = `<a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                            <i class="icon-sm text-white" data-feather="bell"></i>
                                        </div>
                                        <div class="flex-grow-1 me-2">
                                            <p>Product ID: ${notification.product_id}</p>
                                            <p class="tx-12 text-muted">Status: ${notification.status} - ${new Date(notification.updated_at).toLocaleString()}</p>
                                        </div>
                                    </a>`;
                        notificationList.insertAdjacentHTML('beforeend', listItem);
                    });
                } else {
                    notificationList.innerHTML = '<p class="text-center py-2">No new notifications</p>';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Tandai notifikasi sebagai telah dibaca setelah dropdown dibuka
    document.getElementById('notificationDropdown').addEventListener('show.bs.dropdown', function() {
        fetch('/mark-notifications-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        }).then(() => {
            document.getElementById('notificationCount').innerText = '0'; // Reset jumlah notifikasi
        }).catch(error => console.error('Error marking notifications as read:', error));
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchNotifications();
    });

    function fetchNotifications() {
        fetch('/get-notifications') // Pastikan route untuk controller benar
            .then(response => response.json())
            .then(data => {
                let notificationList = document.getElementById('notificationList');
                let notificationCount = document.getElementById('notificationCount');

                notificationList.innerHTML = ''; // Kosongkan dulu
                if (data.length > 0) {
                    notificationCount.innerText = data.length;
                    data.forEach(notification => {
                        let listItem = `<a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                            <i class="icon-sm text-white" data-feather="bell"></i>
                                        </div>
                                        <div class="flex-grow-1 me-2">
                                            <p>Product ID: ${notification.product_id}</p>
                                            <p class="tx-12 text-muted">Status: ${notification.status} - ${new Date(notification.updated_at).toLocaleString()}</p>
                                        </div>
                                    </a>`;
                        notificationList.insertAdjacentHTML('beforeend', listItem);
                    });
                } else {
                    notificationList.innerHTML = '<p class="text-center py-2">No new notifications</p>';
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Tandai notifikasi sebagai telah dibaca setelah dropdown dibuka
    document.getElementById('notificationDropdown').addEventListener('show.bs.dropdown', function() {
        fetch('/mark-notifications-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            }
        }).then(() => {
            document.getElementById('notificationCount').innerText = '0'; // Reset jumlah notifikasi
        }).catch(error => console.error('Error marking notifications as read:', error));
    });
</script>
