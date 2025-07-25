<!DOCTYPE html>
<?php

if (session_has('locale')) {
    $lang = session('locale');
    $dir = session('locale') == 'ar' ? 'rtl' : 'ltr';
} else {
    $lang = 'en';
    $dir = 'ltr';
}
?>
<html lang="<?= $lang ?>" data-bs-theme="auto" dir="<?= $dir ?>">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Astro v5.9.2" />
    <title>{{ lang('admin.login_page_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/" />
    <script src="{{ url('assets/admin') }}/assets/js/color-modes.js"></script>
    <link href="{{ url('assets/admin') }}/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="{{ url('assets/admin') }}/css/sign-in.css" rel="stylesheet" />

</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z">
            </path>
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z">
            </path>
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z">
            </path>
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
            </path>
        </symbol>
    </svg>
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" aria-hidden="true">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" aria-hidden="true">
                        <use href="#sun-fill"></use>
                    </svg>
                    {{ lang('admin.light')}}
                    <svg class="bi ms-auto d-none" aria-hidden="true">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" aria-hidden="true">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    {{ lang('admin.dark')}}
                    <svg class="bi ms-auto d-none" aria-hidden="true">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
                    <svg class="bi me-2 opacity-50" aria-hidden="true">
                        <use href="#circle-half"></use>
                    </svg>
                    {{ lang('admin.auto')}}
                    <svg class="bi ms-auto d-none" aria-hidden="true">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>
    <main class="form-signin w-100 m-auto text-center">
            @php
    // var_dump(any_errors());
    //echo get_error();'
    $validat_email = get_error('email');
    $validat_password = get_error('password');


    @endphp
      @if( any_errors() )
    <div class="alert alert-danger" role="alert">
        <ol>
            @foreach( all_errors() as $error)
               <li> @php echo $error @endphp </li>
            @endforeach
        </ol>
    </div>
    @php
    end_errors();
    @endphp
    @endif
        <form action="{{ url(ADMIN . '/do/login') }}" method="post" enctype="multipart/form-data" class="needs-validation">
            <input type="hidden" name="_method" value="post" />
            <img class="mb-4" src="{{ url('assets/admin') }}/assets/brand/bootstrap-logo.svg" alt="" width="72"
                height="57" />
            <h1 class="h3 mb-3 fw-normal">{{ lang('admin.login_page_title')}}</h1>
            <div class="<?= !empty($validat_email) ? 'invalid-feedback' : 'valid-feedback' ?>">
                <?= $validat_email; ?>
            </div>
            <div class="form-floating">
                <input type="text" id="floatingInput" value="<?= old('email') ?>" class="form-control <?= !empty($validat_email) ? 'is-invalid' : '' ?>" name="email" placeholder="name@example.com">

                <label for="floatingInput">{{ lang('admin.email')}}</label>
            </div>
            <div class="<?= !empty($validat_password) ? 'invalid-feedback' : 'valid-feedback' ?>">
                <?= $validat_password; ?>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control  <?= !empty($validat_password) ? 'is-invalid' : '' ?>" id="floatingPassword"
                    placeholder="Password" value="<?= old('password') ?>" />
                <label for="floatingPassword">{{ lang('admin.password')}}</label>
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault"
                    name="remember_me" />
                <label class="form-check-label" for="checkDefault">
                    {{ lang('admin.remember_me')}}
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">
                {{ lang('admin.sign_in')}}
            </button>
        </form>
        @if( $lang == 'ar')
        <a href="{{url( ADMIN .'/lang?lang=en')}}" class="nav-link">{{ lang('main.english')}}</a>

        @eles
        <a href="{{url( ADMIN .'/lang?lang=ar')}}" class="nav-link">{{ lang('main.arabic') }}</a>

        @endif
    </main>
    <script src="{{ url('assets/admin') }}/assets/dist/js/bootstrap.bundle.min.js" class="astro-vvvwv3sm"></script>
</body>

</html>