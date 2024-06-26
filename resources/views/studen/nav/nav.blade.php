<div class="col-lg-3">
    <div class="dashboard__sidebar-wrap">
        <div class="dashboard__sidebar-title mb-20">
            <h6 class="title">Selamat datang, {{ $user->name }}</h6>
        </div>
        <nav class="dashboard__sidebar-menu">
            <ul class="list-wrap">
                <li class="{{ Request::is('dashboard_studen') ? 'active' : '' }}">
                    <a href="{{ route('dashboard_studen') }}">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="{{ Request::is('student-profile') ? 'active' : '' }}">
                    <a href="student-profile.html">
                        <i class="skillgro-avatar"></i>
                        My Profile
                    </a>
                </li>
                <li class="{{ Request::is('student-enrolled-courses') ? 'active' : '' }}">
                    <a href="student-enrolled-courses.html">
                        <i class="skillgro-book"></i>
                        Enrolled Courses
                    </a>
                </li>
                <li class="{{ Request::is('student-wishlist') ? 'active' : '' }}">
                    <a href="student-wishlist.html">
                        <i class="skillgro-label"></i>
                        Wishlist
                    </a>
                </li>
                <li class="{{ Request::is('student-review') ? 'active' : '' }}">
                    <a href="student-review.html">
                        <i class="skillgro-book-2"></i>
                        Reviews
                    </a>
                </li>
                <li class="{{ Request::is('student-attempts') ? 'active' : '' }}">
                    <a href="student-attempts.html">
                        <i class="skillgro-question"></i>
                        My Quiz Attempts
                    </a>
                </li>
                <li class="{{ Request::is('student-history') ? 'active' : '' }}">
                    <a href="student-history.html">
                        <i class="skillgro-satchel"></i>
                        Order History
                    </a>
                </li>
            </ul>
        </nav>
        <div class="dashboard__sidebar-title mt-30 mb-20">
            <h6 class="title">User</h6>
        </div>
        <nav class="dashboard__sidebar-menu">
            <ul class="list-wrap">
                <li class="{{ Request::is('setting') ? 'active' : '' }}">
                    <a href="{{ route('setting') }}">
                        <i class="skillgro-settings"></i>
                        Settings
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="skillgro-logout"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
