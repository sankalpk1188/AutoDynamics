<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Launching Soon — {{ config('app.name', 'Auto Dynamics') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/fevicon.png') }}">
    <style>
        :root {
            --bg: #07111f;
            --card: rgba(8, 20, 38, 0.92);
            --line: rgba(94, 200, 255, 0.22);
            --accent: #0c7ebf;
            --text: #f4f7fb;
            --muted: #9aa8bc;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1.25rem;
            font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
            color: var(--text);
            background:
                radial-gradient(ellipse 80% 60% at 50% 0%, rgba(0, 130, 198, 0.14), transparent 60%),
                var(--bg);
        }

        .launch-card {
            width: min(100%, 520px);
            padding: clamp(1.5rem, 4vw, 2.25rem);
            border-radius: 18px;
            border: 1px solid var(--line);
            background: var(--card);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45);
            text-align: center;
        }

        .launch-image-wrap {
            margin: 0 auto 1.35rem;
            padding: 0.85rem;
            border-radius: 12px;
            background: #fff;
            max-width: 320px;
        }

        .launch-image-wrap img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .launch-badge {
            display: inline-block;
            margin-bottom: 1rem;
            padding: 0.35rem 0.9rem;
            border: 1px solid #0c7ebf;
            border-radius: 999px;
            color: var(--accent);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .launch-title {
            margin: 0 0 0.85rem;
            font-size: clamp(1.35rem, 4vw, 1.85rem);
            font-weight: 700;
            line-height: 1.25;
        }

        .launch-divider {
            width: 72px;
            height: 3px;
            margin: 0 auto 1.1rem;
            border-radius: 999px;
            background: var(--accent);
        }

        .launch-message {
            margin: 0 0 1.35rem;
            color: var(--muted);
            font-size: 0.98rem;
            line-height: 1.65;
            white-space: pre-line;
        }

        .launch-timer-label {
            margin: 0 0 0.45rem;
            color: var(--muted);
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .launch-timer {
            display: flex;
            justify-content: center;
            gap: 0.65rem;
            margin-bottom: 0.35rem;
        }

        .launch-timer-unit {
            min-width: 68px;
            padding: 0.65rem 0.5rem;
            border-radius: 10px;
            border: 1px solid rgba(94, 200, 255, 0.18);
            background: rgba(255, 255, 255, 0.03);
        }

        .launch-timer-unit strong {
            display: block;
            font-size: 1.35rem;
            line-height: 1;
        }

        .launch-timer-unit span {
            display: block;
            margin-top: 0.3rem;
            color: var(--muted);
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .launch-opens {
            margin: 0.85rem 0 0;
            color: var(--muted);
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <main class="launch-card" aria-live="polite">
        <div class="launch-image-wrap">
            <img src="{{ $imageUrl }}" alt="Auto Dynamics">
        </div>

        <div class="launch-badge">Launching Soon 🎉</div>

        <h1 class="launch-title">{{ $title }}</h1>
        <div class="launch-divider" aria-hidden="true"></div>

        <p class="launch-message">{{ $message }}</p>

        <p class="launch-timer-label">Website opens in</p>
        <div class="launch-timer" id="launch-timer">
            <div class="launch-timer-unit"><strong id="t-hours">00</strong><span>Hours</span></div>
            <div class="launch-timer-unit"><strong id="t-mins">00</strong><span>Mins</span></div>
            <div class="launch-timer-unit"><strong id="t-secs">00</strong><span>Secs</span></div>
        </div>

        @if(!empty($launchAtFormatted))
            <p class="launch-opens">Opens at {{ $launchAtFormatted }}</p>
        @endif
    </main>

    <script>
        (function () {
            var launchAt = {{ (int) $launchTimestampMs }};
            var hoursEl = document.getElementById('t-hours');
            var minsEl = document.getElementById('t-mins');
            var secsEl = document.getElementById('t-secs');

            function pad(n) {
                return String(n).padStart(2, '0');
            }

            function tick() {
                var remaining = launchAt - Date.now();
                if (remaining <= 0) {
                    window.location.replace('/');
                    return;
                }

                var totalSeconds = Math.floor(remaining / 1000);
                var hours = Math.floor(totalSeconds / 3600);
                var mins = Math.floor((totalSeconds % 3600) / 60);
                var secs = totalSeconds % 60;

                hoursEl.textContent = pad(hours);
                minsEl.textContent = pad(mins);
                secsEl.textContent = pad(secs);
            }

            tick();
            setInterval(tick, 1000);
        })();
    </script>
</body>
</html>
