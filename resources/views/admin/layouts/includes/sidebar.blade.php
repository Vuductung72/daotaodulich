<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item {{ request()->is('admin/') ? 'active' : '' }}">
                <a href="{{ route('ad.index') }}"><i class="fa fa-home"></i> <span class="title">Dashboard</span></a>
            </li>
            @if (isAdmin(auth()->user()))
                <li class="nav-item {{ request()->is(['admin/user*']) ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link nav-toggle">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="title">Quản lý khách hàng</span>
                        <span class="arrow {{ request()->is(['admin/user*']) ? 'active' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ request()->is(['admin/user*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.user.index') }}" class="nav-link">
                                <span class="title">Danh sách khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->is(['admin/contact*']) ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link nav-toggle">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span class="title">Quản lý liên hệ</span>
                        <span class="arrow {{ request()->is(['admin/contact*']) ? 'active' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ request()->is(['admin/contact*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.contact.index') }}" class="nav-link">
                                <span class="title">Danh sách thông tin liên hệ</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->is(['admin/recharge*']) ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link nav-toggle">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span class="title">Quản lý nạp tiền</span>
                        <span class="arrow {{ request()->is(['admin/recharge*']) ? 'active' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ request()->is(['admin/recharge*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.payment.getRecharge') }}" class="nav-link">
                                <span class="title">Nạp tiền</span>
                            </a>
                        </li>
                    </ul>
                </li>                
            @endif
            {{-- blog manage --}}
            <li class="nav-item {{ request()->is(['admin/category*', 'admin/blog*','admin/cms*']) ? 'active' : '' }}">
                <a href="javascript:void(0);" class="nav-link nav-toggle">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <span class="title">Quản lý bài viết</span>
                    <span class="arrow {{ request()->is(['admin/category*', 'admin/blog*']) ? 'active' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ request()->is(['admin/category*']) ? 'active' : '' }}">
                        <a href="{{ route('ad.category.index') }}" class="nav-link">
                            <span class="title">Danh mục</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is(['admin/blog*']) ? 'active' : '' }}">
                        <a href="{{ route('ad.blog.index') }}" class="nav-link">
                            <span class="title">Bài viết</span>
                        </a>
                    </li>
                </ul>
            </li>

            @if ((isAdmin(auth()->user())))

                {{-- content manage  --}}
                <li class="nav-item {{ request()->is(['admin/profession*','admin/exam*','admin/question*','admin/search-question*','admin/search-exam*']) ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link nav-toggle">
                        <i class="fa fa-file"></i>
                        <span class="title">Quản lý nội dung</span>
                        <span class="arrow {{ request()->is(['admin/profession*','admin/exam*','admin/search-exam*','admin/question*','admin/search-question*']) ? 'active' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ request()->is(['admin/profession*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.profession.index') }}" class="nav-link">
                                <span class="title">Ngành nghề</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is(['admin/exam*','admin/search-exam*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.exam.index') }}" class="nav-link">
                                <span class="title">Bộ đề thi</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is(['admin/question*','admin/search-question*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.question.index') }}" class="nav-link">
                                <span class="title">Câu hỏi</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- course manage  --}}
                <li class="nav-item {{ request()->is(['admin/courses*','admin/lesson*','admin/search-courses*','admin/search-lesson*','admin/course/bought*', 'admin/confirm-exam*']) ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link nav-toggle">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span class="title">Quản lý khóa học</span>
                        <span class="arrow {{ request()->is(['admin/course/bought*','admin/courses*','admin/lesson*','admin/search-courses*','admin/search-lesson*']) ? 'active' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ request()->is(['admin/courses*','admin/search-courses*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.courses.index') }}" class="nav-link">
                                <span class="title">Khóa học</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is(['admin/course/bought*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.course.bought') }}" class="nav-link">
                                <span class="title">Lịch sử mua khóa học</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is(['admin/lesson*','admin/search-lesson*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.lesson.index') }}" class="nav-link">
                                <span class="title">Bài học</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is(['admin/confirm-exam*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.exam-confirm.index') }}" class="nav-link">
                                <span class="title">Thi ngay</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is(['admin/result-exam*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.exam.result') }}" class="nav-link">
                                <span class="title">Kết quả thi</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- expert manage  --}}
                <li class="nav-item {{ request()->is(['admin/expert*']) ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link nav-toggle">
                        <i class="fa fa-user"></i>
                        <span class="title">Quản lý chuyên gia</span>
                        <span class="arrow {{ request()->is(['admin/expert*']) ? 'active' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ request()->is(['admin/expert*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.expert.index') }}" class="nav-link">
                                <span class="title">Chuyên gia</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- internship manage  --}}
                <li class="nav-item {{ request()->is(['admin/internship*','admin/news-internship*']) ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="nav-link nav-toggle">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <span class="title">Quản lý thực tập</span>
                        <span class="arrow {{ request()->is(['admin/internship*','admin/news-internship*']) ? 'active' : '' }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ request()->is(['admin/internship*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.internship.index') }}" class="nav-link">
                                <span class="title">Nơi thực tập</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is(['admin/news-internship*']) ? 'active' : '' }}">
                            <a href="{{ route('ad.news-internship.index') }}" class="nav-link">
                                <span class="title">Tin thực tập</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- config web --}}
                <li class="nav-item {{ request()->is(['admin/config*']) ? 'active' : '' }}">
                    <a href="{{ route('ad.config.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-wrench" aria-hidden="true"></i>
                        <span class="title">Cấu hình</span>
                    </a>
                </li>

                {{-- admin manage  --}}
                <li class="nav-item {{ request()->is(['admin/admin*']) ? 'active' : '' }}">
                    <a href="{{ route('ad.admin.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-cogs"></i>
                        <span class="title">Quản lý Admin</span>
                    </a>
                </li>
            @endif

            {{-- banner manager  --}}
            <li class="nav-item {{ request()->is(['admin/slider*']) ? 'active' : '' }}">
                <a href="{{ route('ad.slider.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-image"></i>
                    <span class="title">Quản lý slider</span>
                </a>
            </li>

            {{-- comment manager  --}}
            <li class="nav-item {{ request()->is(['admin/feedback*']) ? 'active' : '' }}">
                <a href="{{ route('ad.feedback.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-comment"></i>
                    <span class="title">Quản lý đánh giá</span>
                </a>
            </li>

            {{-- partner manager --}}
            <li class="nav-item {{ request()->is(['admin/partner*']) ? 'active' : '' }}">
                <a href="{{ route('ad.partner.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <span class="title">Quản lý đối tác</span>
                </a>
            </li>
            <!-- END SIDEBAR TOGGLE BUTTON -->
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
