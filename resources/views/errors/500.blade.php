<!DOCTYPE html>
<html lang="es" data-theme="ayu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>500 — noctidev</title>
  <meta name="robots" content="noindex">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('styles.css') }}" />
</head>
<body class="crt-scan crt-glow crt-flicker">
  <div class="stage">
    <div class="window">
      <div class="titlebar">
        <div class="lights">
          <span class="light r"></span><span class="light y"></span><span class="light g"></span>
        </div>
        <span class="title-text">
          <span class="accent">noctidev</span>@arch: ~/500 — zsh
        </span>
        <span class="spacer"></span>
        <span class="conn"><span class="dot"></span> 500 · internal error</span>
      </div>

      <div class="term">
        <div class="entry">
          <div class="cmd-echo">
            <span class="ps1">
              <span class="user">noctidev</span><span class="at">@</span><span class="host">arch</span><span class="dim">:</span><span class="path">~</span><span class="sym"> $</span>
            </span>
            <span class="typed">./serve</span>
          </div>
          <div class="out err glow">Segmentation fault (core dumped)</div>
          <div class="out err">zsh: command failed: internal server error</div>
          <div class="out txt dim">// 500 — internal error</div>
        </div>

        <div class="entry">
          <div class="cmd-echo">
            <span class="ps1">
              <span class="user">noctidev</span><span class="at">@</span><span class="host">arch</span><span class="dim">:</span><span class="path">~</span><span class="sym"> $</span>
            </span>
            <a href="{{ url('/') }}" class="typed accent">cd ~</a>
          </div>
          <div class="out txt dim">volver al home</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
