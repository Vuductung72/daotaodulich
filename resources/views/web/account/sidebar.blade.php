<!-- Sidebar -->
<div class="col-12 col-lg-3 side-bar-bank-col">
    <div class="side-bar-bank">
        <div class="logo-top">
          <div>
            <h3>{{customer()->user()->name}}</h3>
            <div class="money-box">
              <input type="hidden" id="account-money-input-hide" value="{{customer()->user()->money}}">
              <input type="password" id="account-money-input" value="{{number_format((customer()->user()->money))}}VND" readonly>
              {{-- <span class="text-warning" id="account-money">{{number_format((customer()->user()->money))}}</span> --}}
              <button id="toggle-button-money" toggle="#account-money-input"><i class="fa fa-fw fa-eye field-icon"></i></button>
            </div>
            {{-- <span toggle="#account-money" class="fa fa-fw fa-eye field-icon toggle-money"></span> --}}
          </div>

          <button class="navbar-toggle-account" type="button" data-toggle="collapse"
          data-target="#navbarAccountMb" aria-controls="navbarMobile" aria-expanded="false"
          aria-label="Toggle navigation">
                    <span class="nav-toggler">
                        <i class="fa fa-chevron-down"></i>
                    </span>
            </button>


        </div>
        <ul class="nav-links" id="navbarAccountMb">
          <li class="nav-tab {{ request()->is(['tai-khoan*']) ? 'active' : '' }}">
            <a href="{{route('w.tai-khoan.index')}}">
              <i class="fa-solid fa-user"></i>
              <span>
                Tài khoản
              </span>
            </a>
          </li>

          <li class="nav-tab {{ request()->is(['doi-mat-khau']) ? 'active' : '' }}">
            <a href="{{route('w.account.password')}}">
              <i class="fa-solid fa-key"></i>
              <span>
                Đổi mật khẩu
              </span>
            </a>
          </li>

          <li class="nav-tab {{ request()->is(['nap-tien']) ? 'active' : '' }}">
            <a href="{{route('w.payment.recharge')}}">
              <i class="fa-solid fa-hand-holding-dollar"></i>
              <span>
                Nạp tiền
              </span>
            </a>
          </li>
          <li class="nav-tab {{ request()->is(['nap-tien/lich-su']) ? 'active' : '' }}">
            <a href="{{route('w.account.history')}}">
              <i class="fa-solid fa-clock-rotate-left"></i>
              <span>
                Lịch sử nạp tiền
              </span>
            </a>
          </li>
          <li class="nav-tab {{ request()->is(['khoa-hoc-da-mua']) ? 'active' : '' }}">
            <a href="{{ route('w.course.bought')}}">
              <i class="fa-solid fa-book"></i>
              <span>
                Khóa học đã mua
              </span>
            </a>
          </li>

          <li class="nav-tab {{ request()->is(['lich-su-thi']) ? 'active' : '' }}">
            <a href="{{ route('w.exam.history')}}">
              <i class="fa-solid fa-clock-rotate-left"></i>
              <span>
                Lịch sử thi
              </span>
            </a>
          </li>

          <li class="nav-tab {{ request()->is(['thong-tin-thuc-tap']) ? 'active' : '' }}">
            <a href="{{route('w.account.intership')}}">
              <i class="fa-solid fa-clock-rotate-left"></i>
              <span>
                Thực tập
              </span>
            </a>
          </li>


        </ul>
    </div>
</div>
