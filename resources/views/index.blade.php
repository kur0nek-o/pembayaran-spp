<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login · Pembayaran SPP</title>
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles -->
        <link href="/css/login.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <main class="form-signin w-100 m-auto">
            <form action="/" method="POST" autocomplete="off">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Login</h1>

                @if ( session()->has('invalidMessage') )
                    <div class="alert alert-danger" role="alert">
                        <p class="text-start mb-0">{{  session()->get( 'invalidMessage' )  }}</p>
                    </div>
                @endif

                <div class="form-floating">
                    <input 
                        type="text" 
                        class="form-control @error( 'username' ) is-invalid @enderror" 
                        id="username" 
                        name="username" 
                        placeholder="Username"
                        oninvalid="this.setCustomValidity( 'Username tidak boleh kosong' )"
                        oninput="this.setCustomValidity( '' )" 
                        required
                        autofocus
                        value="{{ old('username') }}"
                    >
                    <label for="username">Username</label>

                    @error( 'username' )
                        <div class="invalid-feedback">
                            <p class="text-start">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input 
                        type="password" 
                        class="form-control @error( 'password' ) is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="Password"
                        oninvalid="this.setCustomValidity( 'Password tidak boleh kosong' )"
                        oninput="this.setCustomValidity( '' )" 
                        required
                    >
                    <label for="password">Password</label>

                    @error( 'password' )
                        <div class="invalid-feedback">
                            <p class="text-start">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
        </main>
    </body>
</html>