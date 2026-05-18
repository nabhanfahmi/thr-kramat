<nav class="navbar navbar-expand-lg custom-topbar">

    <div class="topbar-left">

        <!-- Tombol Sidebar Mobile -->
        <button id="sidebarToggleTop" class="mobile-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Tombol Beranda -->
        <a href="{{ url('/') }}" class="topbar-btn">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>

    </div>

    <div class="topbar-right">

        <!-- USER PROFILE -->
        <div class="user-profile">

            @if(Auth::user()->foto)

                <img
                    src="{{ asset('uploads/profil/' . Auth::user()->foto) }}"
                    alt="Foto Profil"
                    class="user-profile-img">

            @else

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6f42c1&color=fff"
                    alt="Foto Profil"
                    class="user-profile-img">

            @endif

            <div class="user-profile-info">

                <div class="user-profile-name">
                    {{ Auth::user()->name }}
                </div>

                <div class="user-profile-role">
                    User Wisata
                </div>

            </div>

        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button class="topbar-btn logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</nav>

<style>

    /* =========================
    USER PROFILE
    ========================= */

    .user-profile{

        display:flex;

        align-items:center;

        gap:10px;

        padding:8px 14px;

        background:#fff;

        border-radius:14px;

        box-shadow:
            0 4px 12px rgba(111,66,193,.08);

        transition:.25s;
    }

    .user-profile:hover{

        transform:translateY(-1px);

        box-shadow:
            0 6px 16px rgba(111,66,193,.12);
    }

    /* =========================
    IMAGE
    ========================= */

    .user-profile-img{

        width:36px;

        height:36px;

        border-radius:50%;

        object-fit:cover;

        border:2px solid #f3f0ff;
    }

    /* =========================
    INFO
    ========================= */

    .user-profile-info{

        display:flex;

        flex-direction:column;

        line-height:1.1;
    }

    .user-profile-name{

        font-size:.84rem;

        font-weight:700;

        color:#2d2d2d;
    }

    .user-profile-role{

        font-size:.7rem;

        color:#888;

        margin-top:2px;
    }

    .custom-topbar{
        width:100%;
        height:75px;

        display:flex;
        align-items:center;
        justify-content:space-between;

        padding:0 25px;

        background:
        linear-gradient(135deg,#6a11cb,#2575fc);

        box-shadow:
        0 5px 20px rgba(0,0,0,0.15);

        position:sticky;
        top:0;
        z-index:999;
    }

    .topbar-left,
    .topbar-right{
        display:flex;
        align-items:center;
        gap:15px;
    }

    .topbar-btn{
        height:42px;
        padding:0 18px;

        border:none;
        border-radius:14px;

        display:flex;
        align-items:center;
        gap:8px;

        text-decoration:none;

        background:rgba(255,255,255,0.12);

        color:white;

        font-size:14px;
        font-weight:600;

        transition:0.3s ease;
    }

    .topbar-btn:hover{
        background:rgba(255,255,255,0.22);
        transform:translateY(-2px);
        color:white;
        text-decoration:none;
    }

    .logout-btn{
        cursor:pointer;
    }

    .user-name{
        display:flex;
        align-items:center;
        gap:8px;

        color:white;

        font-weight:600;
        font-size:14px;

        background:rgba(255,255,255,0.12);

        padding:10px 16px;

        border-radius:14px;
    }

    .user-name i{
        font-size:18px;
    }

    .mobile-toggle{
        width:42px;
        height:42px;

        border:none;
        border-radius:12px;

        background:rgba(255,255,255,0.12);

        color:white;

        display:none;

        transition:0.3s;
    }

    .mobile-toggle:hover{
        background:rgba(255,255,255,0.22);
    }

    @media(max-width:768px){

        .custom-topbar{
            height:auto;
            padding:15px;
        }

        .topbar-left,
        .topbar-right{
            gap:10px;
        }

        .topbar-btn span,
        .user-name{
            font-size:13px;
        }

        .mobile-toggle{
            display:flex;
            align-items:center;
            justify-content:center;
        }

    }

    @media(max-width:576px){

        .custom-topbar{
            flex-direction:column;
            gap:12px;
            align-items:stretch;
        }

        .topbar-left,
        .topbar-right{
            width:100%;
            justify-content:space-between;
        }

        .topbar-btn{
            flex:1;
            justify-content:center;
        }

        .user-name{
            flex:1;
            justify-content:center;
        }

    }

    @media(max-width:768px){

        .user-profile{

            padding:10px 14px;
        }

        .user-profile-img{

            width:42px;
            height:42px;
        }

        .user-profile-name{

            font-size:.88rem;
        }
    }

</style>