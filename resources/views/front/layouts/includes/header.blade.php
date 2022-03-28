<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0 bg-light-primary">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <img alt="Porto" width="150" data-sticky-width="82" src="/storage/logo_long_color.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li><a href="#">Accueil</a></li>
                                        <li><a href="#">Compte Courant</a></li>
                                        <li><a href="#">Crédit</a></li>
                                        <li><a href="#">Assurance</a></li>
                                        <li><a href="#">Epargne</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                            <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                <a href="#" class="header-nav-features-toggle text-decoration-none" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
                                <div class="header-nav-features-dropdown" id="headerTopSearchDropdown">
                                    <form role="search" action="page-search-results.html" method="get">
                                        <div class="simple-search input-group">
                                            <input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
                                            <button class="btn" type="submit">
                                                <i class="fas fa-search header-nav-top-icon"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="header-nav-feature header-nav-features-user d-inline-flex mx-2 pe-2 signin" id="headerAccount">
                                @guest()
                                    <a href="{{ route('login') }}" style="color: #444; font-size: 13px; font-weight: 600; text-transform: uppercase;">
                                        <i class="fas fa-lock me-2"></i> Espace client
                                    </a>
                                @else
                                    <a href="#" class="header-nav-features-toggle">
                                        <i class="far fa-user"></i> {{ auth()->user()->customer->friendlyName }}
                                    </a>
                                    <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right" id="headerTopUserDropdown">
                                        <div class="row">
                                            <div class="col-8">
                                                <p class="mb-0 pb-0 text-2 line-height-1 pt-1">Bonjour,</p>
                                                <p><strong class="text-color-dark text-4">{{ auth()->user()->customer->friendlyName }}</strong></p>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-flex justify-content-end">
                                                    <img class="rounded-circle" width="40" height="40" alt="" src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get(auth()->user()->email) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <ul class="nav nav-list-simple flex-column text-3">
                                                    <li class="nav-item"><a class="nav-link" href="{{ route('account.dashboard') }}">Tableau de Bord</a></li>
                                                    <li class="nav-item">
                                                        <form action="{{ route('logout') }}" method="post">
                                                            <button type="submit" class="btn bg-transparent text-dark border-bottom-0 logout">Déconnexion</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
