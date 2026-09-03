<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar sesión · Bitácora de Avisos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --papel: #ECEDE8;
            --superficie: #FFFFFF;
            --campo: #FAFAF8;
            --tinta: #23292C;
            --tinta-2: #5C666B;
            --linea: #D6D8D2;
            --acento: #3E5B5C;
            --acento-suave: #E3EAE8;
            --alerta: #8C4A3F;
            --alerta-suave: #F3E7E4;
            --radio: 5px;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; }
        body { margin: 0; font-family: 'IBM Plex Sans', system-ui, -apple-system, sans-serif; font-size: 15px; line-height: 1.55; color: var(--tinta); background-color: var(--papel); -webkit-font-smoothing: antialiased; }
        .escena { position: relative; min-height: 100%; display: flex; align-items: center; justify-content: center; padding: 32px 20px; }
        .escena::before { content: ""; position: absolute; inset: 0; background-image: linear-gradient(var(--linea) 1px, transparent 1px), linear-gradient(90deg, var(--linea) 1px, transparent 1px); background-size: 28px 28px; opacity: .45; -webkit-mask-image: radial-gradient(ellipse at center, #000 20%, transparent 78%); mask-image: radial-gradient(ellipse at center, #000 20%, transparent 78%); pointer-events: none; }
        .marco { position: relative; width: 100%; max-width: 404px; background: var(--superficie); border: 1px solid var(--linea); border-radius: var(--radio); padding: 38px 34px 30px; box-shadow: 0 1px 2px rgba(35,41,44,.04), 0 24px 48px -34px rgba(35,41,44,.34); }
        .marco::before { content: ""; position: absolute; top: -1px; left: 34px; width: 44px; height: 2px; background: var(--acento); }
        .codigo { display: block; font-family: 'IBM Plex Mono', ui-monospace, monospace; font-size: 10.5px; font-weight: 500; letter-spacing: .14em; text-transform: uppercase; color: var(--tinta-2); }
        .marca h1 { margin: 14px 0 6px; font-size: 25px; font-weight: 600; letter-spacing: -.02em; }
        .nota { margin: 0 0 26px; font-size: 13.5px; color: var(--tinta-2); }
        .aviso { margin: 0 0 20px; padding: 10px 12px; font-size: 13px; border: 1px solid var(--linea); border-left: 2px solid var(--acento); background: var(--acento-suave); border-radius: 3px; }
        .campo { margin-bottom: 18px; }
        .campo > label { display: block; margin-bottom: 7px; font-family: 'IBM Plex Mono', ui-monospace, monospace; font-size: 10.5px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: var(--tinta-2); }
        .campo input[type="text"], .campo input[type="email"], .campo input[type="password"] { width: 100%; height: 44px; padding: 0 13px; font: inherit; color: var(--tinta); background: var(--campo); border: 1px solid var(--linea); border-radius: 4px; transition: border-color .14s ease, box-shadow .14s ease, background-color .14s ease; }
        .campo input::placeholder { color: #A2AAAD; }
        .campo input:focus { outline: none; background: var(--superficie); border-color: var(--acento); box-shadow: 0 0 0 3px var(--acento-suave); }
        .campo input[aria-invalid="true"] { border-color: var(--alerta); }
        .campo input[aria-invalid="true"]:focus { box-shadow: 0 0 0 3px var(--alerta-suave); }
        .secreto { position: relative; }
        .secreto input { padding-right: 74px; }
        .ver { position: absolute; top: 50%; right: 6px; transform: translateY(-50%); height: 32px; padding: 0 10px; font-family: 'IBM Plex Mono', ui-monospace, monospace; font-size: 10px; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: var(--tinta-2); background: transparent; border: 1px solid transparent; border-radius: 3px; cursor: pointer; transition: color .14s ease, background-color .14s ease; }
        .ver:hover { color: var(--tinta); background: var(--papel); }
        .ver:focus-visible { outline: 2px solid var(--acento); outline-offset: 1px; }
        .error { margin: 7px 0 0; font-size: 12.5px; color: var(--alerta); }
        .fila { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin: 22px 0 24px; }
        .recordar { display: inline-flex; align-items: center; gap: 8px; font-size: 13.5px; color: var(--tinta-2); cursor: pointer; }
        .recordar input { width: 15px; height: 15px; margin: 0; accent-color: var(--acento); cursor: pointer; }
        .enlace { font-size: 13.5px; color: var(--acento); text-decoration: none; border-bottom: 1px solid transparent; transition: border-color .14s ease; }
        .enlace:hover { border-bottom-color: var(--acento); }
        .enlace:focus-visible { outline: 2px solid var(--acento); outline-offset: 2px; border-radius: 2px; }
        .entrar { width: 100%; height: 46px; font: inherit; font-weight: 500; letter-spacing: .01em; color: #FFFFFF; background: var(--acento); border: 1px solid var(--acento); border-radius: 4px; cursor: pointer; transition: background-color .14s ease, transform .14s ease; }
        .entrar:hover { background: #345051; border-color: #345051; }
        .entrar:active { transform: translateY(1px); }
        .entrar:focus-visible { outline: 2px solid var(--tinta); outline-offset: 2px; }
        .pie { margin: 26px 0 0; padding-top: 18px; border-top: 1px solid var(--linea); font-family: 'IBM Plex Mono', ui-monospace, monospace; font-size: 10.5px; letter-spacing: .08em; text-transform: uppercase; color: #8B9295; text-align: center; }
        @media (max-width: 420px) { .marco { padding: 32px 22px 26px; } .marco::before { left: 22px; } .marca h1 { font-size: 22px; } }
        @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
    </style>
</head>
<body>
    <main class="escena">
        <div class="marco">
            <header class="marca">
                <span class="codigo">Bitácora · Avisos</span>
                <h1>Iniciar sesión</h1>
                <p class="nota">Acceso para publicar y administrar avisos del blog.</p>
            </header>

            @if (session('status'))
                <p class="aviso" role="status">{{ session('status') }}</p>
            @endif

            <form method="POST" action="{{ route('login.entrar') }}">
                @csrf
                <div class="campo">
                    <label for="email">Usuario o correo</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nombre@blog.test" autocomplete="username" autofocus required @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                    @error('email') <p class="error" id="email-error">{{ $message }}</p> @enderror
                </div>
                <div class="campo secreto">
                    <label for="password">Contraseña</label>
                    <input id="password" name="password" type="password" placeholder="••••••••" autocomplete="current-password" required @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                    <button type="button" class="ver" id="ver" aria-controls="password" aria-pressed="false">Mostrar</button>
                    @error('password') <p class="error" id="password-error">{{ $message }}</p> @enderror
                </div>
                <div class="fila">
                    <label class="recordar"><input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Mantener sesión</label>
                    @if (Route::has('password.request'))
                        <a class="enlace" href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                    @endif
                </div>
                <button type="submit" class="entrar">Entrar al blog</button>
            </form>
            <p class="pie">Bitácora de Avisos · Comunidad editorial</p>
        </div>
    </main>
    <script>
        (function () {
            var boton = document.getElementById('ver');
            var campo = document.getElementById('password');
            if (!boton || !campo) return;
            boton.addEventListener('click', function () {
                var oculto = campo.type === 'password';
                campo.type = oculto ? 'text' : 'password';
                boton.textContent = oculto ? 'Ocultar' : 'Mostrar';
                boton.setAttribute('aria-pressed', oculto ? 'true' : 'false');
                campo.focus();
            });
        })();
    </script>
</body>
</html>
