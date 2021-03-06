<div class="left-side-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="assets/images/logo.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="assets/images/logo-dark.png" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm_dark.png" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('home') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('academicYear.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Niên khóa</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('faculty.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Khoa </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('teachers.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Giảng viên </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('major.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Ngành học</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('classroom.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Lớp học</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('subjects.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Môn học </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('course.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Học phần </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('courseDetail.index') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Xếp lịch học </span>
                </a>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
