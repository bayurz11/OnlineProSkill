<div class="row">
    <div class="col-lg-3">
        <div class="dashboard__sidebar-wrap">
            <div class="dashboard__sidebar-title mb-20">
                <h6 class="title">Welcome, {{ $user->name }}</h6>
            </div>
            <nav class="dashboard__sidebar-menu">
                <ul class="list-wrap">
                    <li class="active">
                        <a href="{{ route('dashboard_instruktur') }}">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="instructor-profile.html">
                            <i class="skillgro-avatar"></i>
                            My Profile
                        </a>
                    </li>
                    <li>
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
                    </li>
                </ul>
            </nav>
            <div class="dashboard__sidebar-title mt-40 mb-20">
                <h6 class="title">INSTRUCTOR</h6>
            </div>
            <nav class="dashboard__sidebar-menu">
                <ul class="list-wrap">
                    <li>
                        <a href="instructor-courses.html">
                            <i class="skillgro-video-tutorial"></i>
                            My Courses
                        </a>
                    </li>
                    <li>
                        <a href="instructor-announcement.html">
                            <i class="skillgro-marketing"></i>
                            Announcements
                        </a>
                    </li>
                    <li>
                        <a href="instructor-quiz.html">
                            <i class="skillgro-chat"></i>
                            Quiz Attempts
                        </a>
                    </li>
                    <li>
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
                    <li>
                        <a href="instructor-setting.html">
                            <i class="skillgro-settings"></i>
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="index.html">
                            <i class="skillgro-logout"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="dashboard__content-wrap dashboard__content-wrap-two mb-60">
            <div class="dashboard__content-title">
                <h4 class="title">Dashboard</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="dashboard__counter-item">
                        <div class="icon">
                            <i class="skillgro-book"></i>
                        </div>
                        <div class="content">
                            <span class="count odometer" data-count="30"></span>
                            <p>ENROLLED COURSES</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="dashboard__counter-item">
                        <div class="icon">
                            <i class="skillgro-tutorial"></i>
                        </div>
                        <div class="content">
                            <span class="count odometer" data-count="10"></span>
                            <p>ACTIVE COURSES</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="dashboard__counter-item">
                        <div class="icon">
                            <i class="skillgro-diploma-1"></i>
                        </div>
                        <div class="content">
                            <span class="count odometer" data-count="7"></span>
                            <p>COMPLETED COURSES</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="dashboard__counter-item">
                        <div class="icon">
                            <i class="skillgro-group"></i>
                        </div>
                        <div class="content">
                            <span class="count odometer" data-count="160"></span>
                            <p>TOTAL STUDENTS</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="dashboard__counter-item">
                        <div class="icon">
                            <i class="skillgro-notepad"></i>
                        </div>
                        <div class="content">
                            <span class="count odometer" data-count="30"></span>
                            <p>TOTAL COURSES</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="dashboard__counter-item">
                        <div class="icon">
                            <i class="skillgro-dollar-currency-symbol"></i>
                        </div>
                        <div class="content">
                            <span class="count odometer" data-count="29000"></span>
                            <p>TOTAL EARNINGS</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard__content-wrap">
            <div class="dashboard__content-title">
                <h4 class="title">My Courses</h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="dashboard__review-table">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Enrolled</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="course-details.html">Accounting</a>
                                    </td>
                                    <td>
                                        <p class="color-black">50</p>
                                    </td>
                                    <td>
                                        <div class="review__wrap">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="course-details.html">Marketing</a>
                                    </td>
                                    <td>
                                        <p class="color-black">43</p>
                                    </td>
                                    <td>
                                        <div class="review__wrap">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="course-details.html">Web Design</a>
                                    </td>
                                    <td>
                                        <p class="color-black">36</p>
                                    </td>
                                    <td>
                                        <div class="review__wrap">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="course-details.html">Graphic</a>
                                    </td>
                                    <td>
                                        <p class="color-black">22</p>
                                    </td>
                                    <td>
                                        <div class="review__wrap">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="load-more-btn text-center mt-20">
                <a href="#" class="link-btn">Browse All Course <img src="assets/img/icons/right_arrow.svg"
                        alt="" class="injectable"></a>
            </div>
        </div>
    </div>
</div>
