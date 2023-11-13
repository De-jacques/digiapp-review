<div class="page-content d-flex align-items-stretch" id="sidebar">
    <!-- Side Navbar -->
    <nav class="side-navbar z-index-40">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center py-4 px-2"><img
                class="digicorp shadow-0 img-fluid rounded-circle" src="{{ asset('img/favicon.ico') }}" alt="...">
            <div class="ms-3 title">
                <h1 class="h4 mb-2">{{ Auth::user()->name }}</h1>
                <p class="text-sm text-gray-500 fw-light mb-0 lh-1 text-capitalize">{{ Auth::user()->poste }}</p>
            </div>
        </div>

        <!-- Sidebar Navidation Menus-->
        <span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">MENU</span>

        <ul class="list-unstyled py-4">

            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('home') }}">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                        <use xlink:href="#real-estate-1"> </use>
                    </svg>Accueil </a>
            </li>

            @if (Auth::user()->role != 'stock' &&
                    Auth::user()->role != 'reseau' &&
                    Auth::user()->role != 'programmation' &&
                    Auth::user()->role != 'secretariat' &&
                    Auth::user()->role != 'rh')
                <li class="sidebar-item"><a class="sidebar-link" href="#vente" data-bs-toggle="collapse">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                            <use xlink:href="#browser-window-1"> </use>
                        </svg>VENTES </a>
                    <ul class="collapse list-unstyled " id="vente">
                        <!--data-bs-toggle="modal" data-bs-target="#staticBackdrop"-->

                            <li><a class="sidebar-link" href="{{ route('proformas.index') }}">Proformas</a></li>
                            <li><a class="sidebar-link" href="{{ route('bons.index')}}">Bons</a></li>
                            <li><a class="sidebar-link" href="{{ route('factures.index') }}">Factures</a></li>
                    </ul>
                </li>
            @endif
            <li class="sidebar-item"><a class="sidebar-link" href="#stock" data-bs-toggle="collapse">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                        <use xlink:href="#browser-window-1"> </use>
                    </svg>STOCK</a>
                <ul class="collapse list-unstyled " id="stock">
                    <!--data-bs-toggle="modal" data-bs-target="#staticBackdrop"-->
                        <li><a class="sidebar-link" href="{{ route('produits.index') }}">Produits</a></li>
                        @if (Auth::user()->role == 'stock' || Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <li><a class="sidebar-link" href="{{ route('stocks.entre') }}">Bon de reception</a></li>
                            <li><a class="sidebar-link" href="{{ route('sorties.index') }}">Bon de livraison</a></li>
                        @endif
                        {{-- <li><a class="sidebar-link" href="#">Bon de retour</a></li> --}}
                        {{-- <li><a class="sidebar-link" href="{{ route ('mouvements.index') }}">Mouvements</a></li> --}}
                        <li><a class="sidebar-link" href="{{ route('serial-number.index') }}">S/N</a></li>

                </ul>
            </li>
            @if (Auth::user()->role != 'stock' &&
                    Auth::user()->role != 'reseau' &&
                    Auth::user()->role != 'programmation' &&
                    Auth::user()->role != 'secretariat' &&
                    Auth::user()->role != 'rh')
                <li class="sidebar-item"><a class="sidebar-link" href="#compte" data-bs-toggle="collapse">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                            <use xlink:href="#browser-window-1"> </use>
                        </svg>COMPTES </a>
                    <ul class="collapse list-unstyled " id="compte">
                        <li><a class="sidebar-link" href="{{ route('suppliers.index') }}">Fournisseurs</a></li>
                        <li><a class="sidebar-link" href="{{ route('providers.index') }}">Prestataires</a></li>
                        <li><a class="sidebar-link" href="{{ route('customers.index') }}">Clients</a></li>
                        <li><a class="sidebar-link" href="{{ route('contacts.index') }}">Contact</a></li>
                    </ul>
                </li>
            @endif
            {{-- <li class="sidebar-item"><a class="sidebar-link" href="#crmdropdownDropdown" data-bs-toggle="collapse">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                        <use xlink:href="#browser-window-1"> </use>
                    </svg>ACHATS </a>
                <ul class="collapse list-unstyled " id="crmdropdownDropdown">
                    <li><a class="sidebar-link" href="#">Quotations</a></li>
                    <li><a class="sidebar-link" href="#">Bons de commande</a></li>
                    <li><a class="sidebar-link" href="#">Factures</a></li>
                </ul>
            </li> --}}



            <li class="sidebar-item"><a class="sidebar-link" href="#settingd" data-bs-toggle="collapse">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                        <use xlink:href="#real-estate-1"> </use>
                    </svg>PARAMETRE </a>
                <ul class="collapse list-unstyled " id="settingd">
                    <!--data-bs-toggle="modal" data-bs-target="#staticBackdrop"-->
                        <li><a class="sidebar-link" href="{{ route('users.index') }}">Utilisateurs</a></li>
                        {{-- <li><a class="sidebar-link" href="{{ route('profiles.index') }}">Profile</a></li>
                    <li><a class="sidebar-link" href="{{ route('settings.pass') }}">Mot de passe</a></li> --}}
                        <li class="sidebar-item"><a class="sidebar-link" href="#sysgest" data-bs-toggle="collapse">
                                <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                    <use xlink:href="#real-estate-1"> </use>
                                </svg> Produits </a>
                            <ul class="collapse list-unstyled " id="sysgest">
                                <!--data-bs-toggle="modal" data-bs-target="#staticBackdrop"-->

                                    @if (Auth::user()->role == 'commercial' || Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
                                        <li><a class="sidebar-link" href="{{ route('settings.index') }}">Marge</a></li>
                                    @endif
                                    <li><a class="sidebar-link" href="{{ route('categories.index') }}">Categories</a>
                                    </li>
                                    <li><a class="sidebar-link" href="{{ route('sub_categories.index') }}">Sous
                                            catégories</a>
                                    </li>
                                    <li><a class="sidebar-link" href="{{ route('marques.index') }}">Marque</a></li>
                                    <li><a class="sidebar-link" href="{{ route('entrepots.index') }}">Entrepot</a></li>
                            </ul>
                        </li>

                </ul>
            </li>
            {{-- <li class="sidebar-item"><a class="sidebar-link" href="#profil" data-bs-toggle="collapse">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                    </svg>Mon Profile </a>
                <ul class="collapse list-unstyled " id="profil">
                    <!--data-bs-toggle="modal" data-bs-target="#staticBackdrop"-->
                    <li><a class="sidebar-link" href="{{ route('profiles.index') }}">Profile</a></li>
                    <li><a class="sidebar-link" href="{{ route('settings.pass') }}">Mot de passe</a></li>
                </ul>
            </li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ url('logout') }}">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                        <use xlink:href="#security-1"> </use>

                    </svg>Me deconnecter </a>
            </li> --}}

    </nav>
