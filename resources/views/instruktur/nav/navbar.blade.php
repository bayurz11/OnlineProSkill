<div class="col-lg-3">
    <div class="dashboard__sidebar-wrap">
        <div class="dashboard__sidebar-title mb-20">
            <h6 class="title">Welcome, {{ $user->name }}</h6>
        </div>
        <nav class="dashboard__sidebar-menu">
            <ul class="list-wrap">
                <li class="{{ Request::is('dashboard_instruktur') ? 'active' : '' }}">
                    <a href="{{ route('dashboard_instruktur') }}">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="{{ Request::is('instruktur_profile') ? 'active' : '' }}">
                    <a href="{{ route('instruktur_profile') }}">
                        <i class="skillgro-avatar"></i>
                        My Profile
                    </a>
                </li>
                {{-- <li>
                    <a href="instructor-enrolled-courses.html">
                        <i class="skillgro-book"></i>
                        Enrolled Courses
                    </a>
                </li>
                <li>
                    <a href="instructor-wishlist.html">
                        <i class="skillgro-label"></i>
                        Wishlist
                    </a>
                </li>
                <li>
                    <a href="instructor-review.html">
                        <i class="skillgro-book-2"></i>
                        Reviews
                    </a>
                </li>
                <li>
                    <a href="instructor-attempts.html">
                        <i class="skillgro-question"></i>
                        My Quiz Attempts
                    </a>
                </li>
                <li>
                    <a href="instructor-history.html">
                        <i class="skillgro-satchel"></i>
                        Order History
                    </a>
                </li> --}}
            </ul>
        </nav>
        <div class="dashboard__sidebar-title mt-40 mb-20">
            <h6 class="title">INSTRUCTOR</h6>
        </div>
        <nav class="dashboard__sidebar-menu">
            <ul class="list-wrap">
                <li class="{{ Request::is('instruktur_courses', 'instruktur.kurikulum') ? 'active' : '' }}">
                    <a href="{{ route('instruktur_courses') }}">
                        <i class="skillgro-video-tutorial"></i>
                        My Courses
                    </a>
                </li>
                <li class="{{ Request::is('#') ? 'active' : '' }}">
                    <a href="instructor-announcement.html">
                        <i class="skillgro-marketing"></i>
                        Announcements
                    </a>
                </li>
                <li class="{{ Request::is('#') ? 'active' : '' }}">
                    <a href="instructor-quiz.html">
                        <i class="skillgro-chat"></i>
                        Quiz Attempts
                    </a>
                </li>
                <li class="{{ Request::is('#') ? 'active' : '' }}">
                    <a href="instructor-assignment.html">
                        <i class="skillgro-list"></i>
                        Assignments
                    </a>
                </li>
            </ul>
        </nav>
        <div class="dashboard__sidebar-title mt-30 mb-20">
            <h6 class="title">User</h6>
        </div>
        <nav class="dashboard__sidebar-menu">
            <ul class="list-wrap">
                <li class="{{ Request::is('instruktur_setting') ? 'active' : '' }}">
                    <a href="{{ route('instruktur_setting') }}">
                        <i class="skillgro-settings"></i>
                        Settings
                    </a>
                </li>
                <li class="{{ Request::is('#') ? 'active' : '' }}">


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                            class="skillgro-logout"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
