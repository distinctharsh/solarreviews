      <!-- Welcome Page CSS -->
<link rel="stylesheet" href="{{ asset('css/design-system.css') }}">

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="z-index: 1100; border-bottom: 4px solid #e6b800; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <div class="container" style="max-width: 1200px;">
        @php($normalUserSession = $normalUserSession ?? null)
        @php($isBusinessUser = auth()->check())
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/1.png') }}" alt="SolarReviews Logo" class="navbar-logo">
        </a>
        
        <!-- Desktop Nav Links -->
        <div class="desktop-nav d-none d-lg-flex align-items-center">
            <div class="mega-nav-item position-relative">
                <button class="nav-link fw-medium mega-trigger d-inline-flex align-items-center gap-1" data-mega-trigger>
                    Learn About Solar
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 7l5 5 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="mega-dropdown shadow">
                    <!-- <div class="mega-column">
                        <p class="mega-heading">Reviews</p>
                        <a href="{{ route('companies.index') }}" class="mega-link">Solar Companies</a>
                        <a href="{{ url('compare/panels') }}" class="mega-link">Solar Panels</a>
                        <a href="{{ url('compare/inverters') }}" class="mega-link">Solar Inverters</a>
                        <a href="{{ url('compare/batteries') }}" class="mega-link">Solar Batteries</a>
                    </div> -->
                    <div class="mega-column">
                        <p class="mega-heading">Guides</p>
                        <a href="https://solareviews.in/blogs" class="mega-link">Buying Guide</a>
                        <a href="#" class="mega-link">Installation Checklist</a>
                        <a href="#" class="mega-link">Financing & Subsidy</a>
                        <a href="#" class="mega-link">Maintenance Tips</a>
                    </div>
                </div>
            </div>
            <div class="mega-nav-item position-relative">
                <button class="nav-link fw-medium mega-trigger d-inline-flex align-items-center gap-1" data-mega-trigger>
                    How it works
                    <svg width="12" height="12" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M5 7l5 5 5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="mega-dropdown shadow" style="min-width: 220px; padding: 16px 20px;">
                    <div class="mega-column">
                        <a href="{{ route('how-it-works.customers') }}" class="mega-link">For Customers</a>
                        <a href="{{ route('how-it-works.epc-companies') }}" class="mega-link">For EPC Companies</a>
                    </div>
                </div>
            </div>
            @if(!$isBusinessUser)
            <a class="nav-link fw-medium py-3" href="{{ route('reviews.write') }}">Write a review</a>
            @endif
            @if(!$isBusinessUser && $normalUserSession)
                @php($normalUserName = $normalUserSession->name ?? ($normalUserSession->email ? explode('@', $normalUserSession->email)[0] : 'Reviewer'))
                <div class="mega-nav-item position-relative">
                    <button class="nav-link fw-medium mega-trigger d-inline-flex align-items-center gap-1 mt-2"
                            data-profile-trigger>
                       
                            <img src="{{ $normalUserSession->avatar_url }}" alt="{{ $normalUserSession->name ?? 'User' }}" style="width: 30px; border-radius: 50%;" >
                            {{$normalUserSession->name}}
           
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="none" >
                            <path d="M5 7l5 5 5-5" stroke="currentColor" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                
                    <div class="mega-dropdown shadow" style="min-width: 180px; padding: 16px 20px;">
                        <div class="mega-column">
                            <a class="nav-link fw-medium py-3 nav-normal-login" href="{{ route('normal-user.reviews.index') }}">
                                My profile
                            </a>
                            <form method="POST" action="{{ route('reviews.session.logout') }}">
                                @csrf
                                <button type="submit" class="mega-link text-start"
                                        style="background:none;border:none;padding:0;">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @elseif(!$isBusinessUser)
                <a
                    class="nav-link fw-medium py-3 nav-normal-login"
                    href="javascript:void(0)"
                    onclick="window.openNormalUserLoginModal && window.openNormalUserLoginModal()"
                >
                    Login
                </a>
            @endif
            @if($isBusinessUser)
                <div class="mega-nav-item position-relative">
                    <button class="nav-link fw-medium mega-trigger d-inline-flex align-items-center gap-1"
                            data-profile-trigger>
                        {{ auth()->user()->name ?? (auth()->user()->email ? explode('@', auth()->user()->email)[0] : 'Account') }}
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="none" >
                            <path d="M5 7l5 5 5-5" stroke="currentColor" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="mega-dropdown shadow" style="min-width: 180px; padding: 16px 20px;">
                        <div class="mega-column">
                            <a class="nav-link fw-medium py-3" href="{{ route('dashboard') }}">
                                My Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="mega-link text-start"
                                        style="background:none;border:none;padding:0;">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @elseif(!$normalUserSession)
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="nav-link fw-medium nav-btn-primary" style="border:none; background:none;">
                            Logout
                        </button>
                    </form>
                @else
                    <a class="nav-link fw-medium nav-btn-primary" href="{{ route('login') }}">For Business</a>
                @endauth
            @endif

            <div class="nav-translate mt-1" aria-label="Translate website">
                <i class="fa-solid fa-globe nav-translate-icon" aria-hidden="true"></i>
                <div id="google_translate_element"></div>
            </div>
        </div>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button>
    </div>
</nav>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <span class="close-icon"></span>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="mt-3" aria-label="Translate website">
            <div class="nav-translate nav-translate-mobile">
                <i class="fa-solid fa-globe nav-translate-icon" aria-hidden="true"></i>
                <div id="google_translate_element_mobile"></div>
            </div>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link fw-medium py-3" >Learn About Solar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-medium py-3" href="{{ route('how-it-works.customers') }}">How it works - For Customers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-medium py-3" href="{{ route('how-it-works.epc-companies') }}">How it works - For EPC Companies</a>
            </li>
            @if(!$normalUserSession && Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3" href="{{ url('/dashboard') }}">My Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link fw-medium py-3 nav-btn-outline w-100 text-start">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3 nav-btn-outline" href="{{ route('login') }}">For Business</a>
                    </li>
                @endauth
            @endif
            @if(!$isBusinessUser)
            <li class="nav-item">
                <a class="nav-link fw-medium py-3" href="{{ route('reviews.write') }}">Write a review</a>
            </li>
            @endif
            @if(!$isBusinessUser && $normalUserSession)
                <li class="nav-item">
                    <a class="nav-link fw-medium py-3 nav-normal-login w-100 text-start" href="{{ route('normal-user.reviews.index') }}">
                        My profile
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('reviews.session.logout') }}">
                        @csrf
                        <button type="submit" class="nav-link fw-medium py-3 nav-btn-outline w-100 text-start">Logout</button>
                    </form>
                </li>
            @elseif(!$isBusinessUser)
                <li class="nav-item">
                    <a
                        class="nav-link fw-medium py-3 nav-normal-login w-100 text-start"
                        href="javascript:void(0)"
                        onclick="window.openNormalUserLoginModal && window.openNormalUserLoginModal()"
                    >
                        Login
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

<style>
    
    
</style>

<!--<script>-->
<!--    document.addEventListener('DOMContentLoaded', () => {-->
<!--        const megaItem = document.querySelector('.mega-nav-item');-->
<!--        const trigger = megaItem?.querySelector('[data-mega-trigger]');-->
<!--        const dropdown = megaItem?.querySelector('.mega-dropdown');-->

<!--        if (!megaItem || !trigger || !dropdown) return;-->

<!--        let hideTimeout = null;-->

<!--        const openDropdown = () => {-->
<!--            clearTimeout(hideTimeout);-->
<!--            megaItem.classList.add('show');-->
<!--            trigger.setAttribute('aria-expanded', 'true');-->
<!--        };-->

<!--        const scheduleClose = () => {-->
<!--            hideTimeout = setTimeout(() => {-->
<!--                megaItem.classList.remove('show');-->
<!--                trigger.setAttribute('aria-expanded', 'false');-->
<!--            }, 120);-->
<!--        };-->

<!--        trigger.addEventListener('mouseenter', openDropdown);-->
<!--        trigger.addEventListener('focus', openDropdown);-->
<!--        dropdown.addEventListener('mouseenter', openDropdown);-->

<!--        trigger.addEventListener('mouseleave', scheduleClose);-->
<!--        dropdown.addEventListener('mouseleave', scheduleClose);-->

<!--        trigger.addEventListener('click', (e) => {-->
<!--            e.preventDefault();-->
<!--            clearTimeout(hideTimeout);-->
<!--            const isOpen = megaItem.classList.toggle('show');-->
<!--            trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');-->
<!--        });-->
<!--    });-->
<!--</script>-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@include('components.frontend.login-choice-modal')


<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.mega-nav-item').forEach(item => {
        const trigger = item.querySelector('.mega-trigger');
        const dropdown = item.querySelector('.mega-dropdown');
        if (!trigger || !dropdown) return;

        let hideTimeout = null;

        const open = () => {
            clearTimeout(hideTimeout);
            item.classList.add('show');
            trigger.setAttribute('aria-expanded', 'true');
        };

        const close = () => {
            hideTimeout = setTimeout(() => {
                item.classList.remove('show');
                trigger.setAttribute('aria-expanded', 'false');
            }, 120);
        };

        trigger.addEventListener('mouseenter', open);
        trigger.addEventListener('focus', open);
        dropdown.addEventListener('mouseenter', open);

        trigger.addEventListener('mouseleave', close);
        dropdown.addEventListener('mouseleave', close);

        trigger.addEventListener('click', e => {
            e.preventDefault();
            const isOpen = item.classList.toggle('show');
            trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    });

    const translateWrappers = document.querySelectorAll('.nav-translate');
    translateWrappers.forEach((wrap) => {
        if (!wrap || wrap.dataset.translateBound === '1') return;
        wrap.addEventListener('click', (e) => {
            const target = e.target;
            if (target && (target.tagName === 'SELECT' || target.closest('select.goog-te-combo'))) {
                return;
            }

            if (target && (target.tagName === 'A' || target.closest('.goog-te-gadget-simple a'))) {
                return;
            }

            const select = wrap.querySelector('select.goog-te-combo');

            if (select) {
                try {
                    select.focus();
                    select.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }));
                    select.click();
                } catch (err) {
                    // ignore
                }
                return;
            }

            const simpleLink = wrap.querySelector('.goog-te-gadget-simple a');
            if (simpleLink) {
                try {
                    simpleLink.click();
                } catch (err) {
                    // ignore
                }
            }
        });
        wrap.style.cursor = 'pointer';
        wrap.dataset.translateBound = '1';
    });
});
</script>

@once
    <script>
        (function () {
            try {
                const storedLang = localStorage.getItem('site_lang');
                if (storedLang) {
                    const cookieValue = `/en/${storedLang}`;
                    document.cookie = `googtrans=${cookieValue};path=/;max-age=31536000`;
                    document.cookie = `googtrans=${cookieValue};path=/;max-age=31536000;SameSite=Lax`;
                }
            } catch (e) {
                // ignore
            }
        })();

        function googleTranslateElementInit() {
            if (window.google && window.google.translate && window.google.translate.TranslateElement) {
                // const includedLanguages = 'en,hi,es,fr,de,it,zh-CN,ja';
                const includedLanguages = 'hi,bn,te,mr,ta,ur,gu,kn,ml,or,pa,as,sd,ks,ne,sa,mai,doi,bo,sat,es,fr,de,it,zh-CN,ja';


                new window.google.translate.TranslateElement(
                    {
                        pageLanguage: 'en',
                        includedLanguages: includedLanguages,
                        autoDisplay: false,
                        layout: window.google.translate.TranslateElement.InlineLayout.SIMPLE
                    },
                    'google_translate_element'
                );

                const mountTranslateTo = (targetId) => {
                    const target = document.getElementById(targetId);
                    if (!target) return;

                    const desktopHost = document.getElementById('google_translate_element');
                    if (!desktopHost) return;

                    const gadget = desktopHost.querySelector('.goog-te-gadget');
                    if (!gadget) return;

                    if (!target.contains(gadget)) {
                        target.innerHTML = '';
                        target.appendChild(gadget);
                    }
                };

                const mountTranslateBackToDesktop = () => {
                    const desktopHost = document.getElementById('google_translate_element');
                    if (!desktopHost) return;

                    const gadget = document.querySelector('#google_translate_element_mobile .goog-te-gadget');
                    if (!gadget) return;

                    if (!desktopHost.contains(gadget)) {
                        desktopHost.innerHTML = '';
                        desktopHost.appendChild(gadget);
                    }
                };

                const persistLang = (lang) => {
                    if (!lang || lang === 'en') {
                        try { localStorage.removeItem('site_lang'); } catch (e) {}
                        document.cookie = 'googtrans=/en/en;path=/;max-age=31536000';
                        document.cookie = 'googtrans=/en/en;path=/;max-age=31536000;SameSite=Lax';
                        return;
                    }

                    try { localStorage.setItem('site_lang', lang); } catch (e) {}
                    const cookieValue = `/en/${lang}`;
                    document.cookie = `googtrans=${cookieValue};path=/;max-age=31536000`;
                    document.cookie = `googtrans=${cookieValue};path=/;max-age=31536000;SameSite=Lax`;
                };

                const syncTranslateSelects = () => {
                    const selects = document.querySelectorAll('select.goog-te-combo');
                    if (!selects.length) return;

                    let storedLang = 'en';
                    try { storedLang = localStorage.getItem('site_lang') || 'en'; } catch (e) {}

                    selects.forEach((select) => {
                        if (!select) return;
                        if (select.value !== storedLang) {
                            select.value = storedLang;
                        }
                        if (!select.dataset.langPersistBound) {
                            select.addEventListener('change', function () {
                                const lang = this.value || 'en';
                                persistLang(lang);
                            });
                            select.dataset.langPersistBound = '1';
                        }
                    });
                };

                const scheduleSync = () => setTimeout(syncTranslateSelects, 400);
                scheduleSync();

                const offcanvas = document.getElementById('mobileSidebar');
                if (offcanvas) {
                    offcanvas.addEventListener('shown.bs.offcanvas', () => {
                        mountTranslateTo('google_translate_element_mobile');
                        scheduleSync();
                    });

                    offcanvas.addEventListener('hidden.bs.offcanvas', () => {
                        mountTranslateBackToDesktop();
                        scheduleSync();
                    });
                }
            }
        }
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endonce

