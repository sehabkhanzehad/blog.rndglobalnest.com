@php
    $setting = App\Models\Setting::first();
@endphp
<style>
    .icon {
        background: black !important;
    }

    .fas {
        color: white !important;
    }
</style>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img class="logo" src="{{ asset($setting->logo) }}" alt="logo" />
            </a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_sm_header }}</a>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="icon" style="">
                        <i class="fas fa-home"></i>
                    </div>
                    <span style="color:Black">{{ __('admin.Dashboard') }}</span>
                </a>
            </li>



            @if (auth()->user()->can('admin.service') ||
                    auth()->user()->can('admin.maintainance-mode') ||
                    auth()->user()->can('admin.announcement') ||
                    auth()->user()->can('admin.slider.index') ||
                    auth()->user()->can('admin.home-page') ||
                    auth()->user()->can('admin.banner-image.index') ||
                    auth()->user()->can('admin.homepage-one-visibility') ||
                    auth()->user()->can('admin.cart-bottom-banner') ||
                    auth()->user()->can('admin.shop-page') ||
                    auth()->user()->can('admin.menu-visibility') ||
                    auth()->user()->can('admin.product-detail-page') ||
                    auth()->user()->can('admin.default-avatar'))
                <li
                    class="nav-item dropdown {{ Route::is('admin.service.*') || Route::is('admin.maintainance-mode') || Route::is('admin.announcement') || Route::is('admin.slider.*') || Route::is('admin.home-page') || Route::is('admin.banner-image.index') || Route::is('admin.homepage-one-visibility') || Route::is('admin.cart-bottom-banner') || Route::is('admin.shop-page') || Route::is('admin.seo-setup') || Route::is('admin.menu-visibility') || Route::is('admin.product-detail-page') || Route::is('admin.default-avatar') || Route::is('admin.seller-conditions') || Route::is('admin.subscription-banner') || Route::is('admin.testimonial.*') || Route::is('admin.homepage-section-title') ? 'active' : '' }}">

                    <p class="s-divide">Website Management</p>
                </li>
            @endif
            <li
                class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') || Route::is('admin.popular-blog.*') || Route::is('admin.blog-comment.*') ? 'active' : '' }}">

                <a href="" class="nav-link has-dropdown">
                    <div class="icon">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <span style="color:black">{{ __('admin.Blogs') }}</span>
                </a>

                <ul class="dropdown-menu">

                    <li class="{{ Route::is('admin.blog-category.*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.blog-category.index') }}">{{ __('admin.Categories') }}</a></li>

                    <li class="{{ Route::is('admin.blog.*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.blog.index') }}">{{ __('admin.Blogs') }}</a></li>

                    <li class="{{ Route::is('admin.popular-blog.*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.popular-blog.index') }}">{{ __('admin.Popular Blogs') }}</a></li>

                    <li class="{{ Route::is('admin.blog-comment.*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.blog-comment.index') }}">{{ __('admin.Comments') }}</a></li>

                </ul>

            </li>

            <li
                class="nav-item dropdown {{ Route::is('admin.about-us.*') || Route::is('admin.custom-page.*') || Route::is('admin.terms-and-condition.*') || Route::is('admin.privacy-policy.*') || Route::is('admin.error-page.*') || Route::is('admin.contact-us.*') || Route::is('admin.login-page') ? 'active' : '' }}">

                <a href="" class="nav-link has-dropdown">

                    <div class="icon">
                        <i class="fas fa-columns"></i>

                    </div>
                    <span>{{ __('admin.Pages') }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.custom-page.*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.custom-page.index') }}">{{ __('admin.Custom Page') }}</a></li>
                </ul>
            </li>









            @if (auth()->user()->can('homepage-setting') ||
                    auth()->user()->can('homepage-setting') ||
                    auth()->user()->can('homepage-setting') ||
                    auth()->user()->can('shipping-method-index') ||
                    auth()->user()->can('payment-method-index') ||
                    auth()->user()->can('seoSetup') ||
                    auth()->user()->can('slider.index') ||
                    auth()->user()->can('social.index') ||
                    auth()->user()->can('footer-image'))
                <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}">
                    <a href="" class="nav-link has-dropdown">
                        <div class="icon">

                            <i class="fas fa-cog" aria-hidden="true"></i>

                        </div>
                        <span>{{ __('admin.Settings') }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        @if (auth()->user()->can('admin.general-setting'))
                            <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('admin.general-setting') }}">Settings</a></li>
                        @endif

                        @if (auth()->user()->can('admin.seo-setup') || auth()->user()->can('admin.slider'))
                            <li class="{{ Route::is('admin.seo-setup') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ route('admin.seo-setup') }}">{{ __('admin.SEO Setup') }}</a></li>
                        @endif
                        <li class="{{ Route::is('admin.social-link.*') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('admin.social-link.index') }}">{{ __('admin.Social Link') }}</a>
                        </li>

                    </ul>
                </li>
            @endif

            {{-- @php
                $logedInAdmin = Auth::guard('admin')->user();
            @endphp

            <li class="{{ Route::is('admin.report.order') ? 'active' : '' }}">
                <p class="s-divide">User Manage</p>
            </li>



            @if (auth()->user()->can('admin.user.index'))
                <li class="{{ Route::is('admin.user.index') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('admin.user.index') }}">
                        <div class="icon">
                            <i class="fas fa-users"></i>

                        </div>

                        <span style="color:black">Employee list</span>
                    </a></li>
            @endif

            @if (auth()->user()->can('admin.customer-list') || auth()->user()->can('admin.customer-show') || auth()->user()->can('admin.pending-customer-list') || auth()->user()->can('admin.seller-show') || auth()->user()->can('admin.seller-shop-detail') || auth()->user()->can('admin.seller-reviews') || auth()->user()->can('admin.show-seller-review-details') || auth()->user()->can('admin.send-email-to-seller') || auth()->user()->can('admin.email-history') || auth()->user()->can('admin.product-by-seller') || auth()->user()->can('admin.send-email-to-all-customer'))
                <li
                    class="nav-item dropdown {{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.pending-customer-list') || Route::is('admin.seller-show') || Route::is('admin.seller-shop-detail') || Route::is('admin.seller-reviews') || Route::is('admin.show-seller-review-details') || Route::is('admin.send-email-to-seller') || Route::is('admin.email-history') || Route::is('admin.product-by-seller') || Route::is('admin.send-email-to-all-seller') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">

                    <a href="#" class="nav-link has-dropdown">
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <span style="color:black">{{ __('admin.Users') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li
                            class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.ipblock') }}">Block User</a>
                        </li>
                        <li
                            class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">
                            <a class="nav-link"
                                href="{{ route('admin.customer-list') }}">{{ __('admin.Customer List') }}</a>
                        </li>



                    </ul>
                </li>
            @endif

            @if (auth()->user()->can('admin.user.role.index'))
                <li class="{{ Route::is('admin.user.role.index') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('admin.user.role.index') }}">
                        <div class="icon">


                            <i class="fas fa-blind"></i>
                        </div>
                        <span style="color:black">Role list</span>
                    </a></li>
            @endif

            @if (auth()->user()->can('admin.user.permission.index'))
                <li class="{{ Route::is('admin.user.permission.index') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('admin.user.permission.index') }}">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <span style="color:black">Permission list</span>
                    </a></li>
            @endif --}}


        </ul>
    </aside>

</div>
