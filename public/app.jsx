/* ============================================================
   NoctiDev — terminal app
   ============================================================ */
const TWEAK_DEFAULTS = /*EDITMODE-BEGIN*/{
  "theme": "ayu",
  "scanlines": true,
  "glow": true,
  "flicker": true,
  "ligatures": true
}/*EDITMODE-END*/;

const THEME_ORDER = ["ayu", "mirage", "gruvbox", "catppuccin", "tokyonight", "greencrt"];
const THEME_LABEL = {
  ayu: "Ayu Dark", mirage: "Ayu Mirage", gruvbox: "Gruvbox",
  catppuccin: "Catppuccin", tokyonight: "Tokyo Night", greencrt: "Green CRT",
};

let _id = 1;
const nextId = () => _id++;

/* ---- Ps1 prompt ---- */
function Ps1({ user, host, path }) {
  return (
    <span className="ps1">
      <span className="user">{user}</span>
      <span className="at">@</span>
      <span className="host">{host}</span>
      <span className="dim">:</span>
      <span className="path">{path}</span>
      <span className="sym"> $</span>
    </span>
  );
}

/* ---- output dispatch ---- */
function Output({ cmd, theme }) {
  const word = cmd.trim().split(/\s+/)[0].toLowerCase();
  switch (word) {
    case "about":              return <About />;
    case "projects":
    case "ls":                 return <Projects />;
    case "skills":
    case "stack":              return <Skills />;
    case "experience":
    case "cv":                 return <Experience />;
    case "social":
    case "contact":            return <Social />;
    case "neofetch":
    case "noctifetch":         return <div className="out"><Neofetch /></div>;
    case "help":               return <Help />;
    case "whoami":             return <div className="out txt accent glow">noctidev</div>;
    case "echo":               return <div className="out txt">{cmd.trim().slice(5)}</div>;
    case "theme":
      return (
        <div className="out txt">
          <span className="ok">✓</span> theme → <span className="accent">{THEME_LABEL[theme]}</span>
          <span className="dim">  ·  type `theme` again to cycle, or open Tweaks</span>
        </div>
      );
    case "":                   return null;
    default:
      return <div className="out err">zsh: command not found: {word} — try <span className="accent">help</span></div>;
  }
}

/* ---- one executed command (echo + output) ---- */
function CmdItem({ item, theme, scrollDown }) {
  const animate = item.animate;
  const [shown, setShown] = React.useState(animate ? "" : item.cmd);
  const [done, setDone] = React.useState(!animate);

  React.useEffect(() => {
    if (!animate) { scrollDown(); return; }
    let i = 0;
    const t = setInterval(() => {
      i++;
      setShown(item.cmd.slice(0, i));
      scrollDown();
      if (i >= item.cmd.length) {
        clearInterval(t);
        setTimeout(() => { setDone(true); scrollDown(); }, 90);
      }
    }, 42);
    return () => clearInterval(t);
  }, []);

  return (
    <div className="entry">
      <div className="cmd-echo">
        <Ps1 user={window.SITE.user} host={window.SITE.host} path={window.SITE.path} />
        <span className="typed">{shown}{!done && <span className="type-caret" />}</span>
      </div>
      {done && <Output cmd={item.cmd} theme={theme} />}
    </div>
  );
}

/* ---- chips ---- */
function Chip({ name, onRun }) {
  return (
    <button className="chip" onClick={() => onRun(name)}>
      <span className="pre">$ </span>{name}
    </button>
  );
}

/* ---- intro block ---- */
function Intro({ onRun }) {
  return (
    <div className="entry">
      <Neofetch />
      <div className="txt" style={{ marginTop: 10, marginBottom: 12 }}>
        <span className="dim">{"// bienvenido a mi terminal. escribe un comando, o haz click"}</span>
      </div>
      <div className="helpline">
        <span className="label">try:</span>
        {["about", "projects", "skills", "experience"].map((c) => (
          <Chip key={c} name={c} onRun={onRun} />
        ))}
        <Chip name="help" onRun={onRun} />
      </div>
    </div>
  );
}

/* ---- main terminal ---- */
function Terminal({ theme, setTweak, onOpenTweaks }) {
  const [log, setLog] = React.useState([{ id: 0, intro: true }]);
  const [value, setValue] = React.useState("");
  const [focused, setFocused] = React.useState(true);
  const termRef = React.useRef(null);
  const inputRef = React.useRef(null);
  const histRef = React.useRef(
    JSON.parse(localStorage.getItem("nocti_hist") || "[]")
  );
  const histIdx = React.useRef(-1);
  const themeRef = React.useRef(theme);
  themeRef.current = theme;

  const scrollDown = () => {
    const el = termRef.current;
    if (el) el.scrollTop = el.scrollHeight;
  };

  React.useEffect(() => { scrollDown(); }, [log]);
  React.useEffect(() => { inputRef.current && inputRef.current.focus(); }, []);

  const pushHistory = (cmd) => {
    const h = histRef.current;
    if (h[h.length - 1] !== cmd) h.push(cmd);
    while (h.length > 60) h.shift();
    localStorage.setItem("nocti_hist", JSON.stringify(h));
    histIdx.current = -1;
  };

  const run = (raw, animate = true) => {
    const cmd = (raw || "").trim();
    if (!cmd) return;
    pushHistory(cmd);
    const word = cmd.split(/\s+/)[0].toLowerCase();

    if (word === "clear" || word === "cls") { setLog([]); _id = 1; return; }

    if (word === "theme") {
      const arg = cmd.split(/\s+/)[1];
      let next;
      if (arg && THEME_ORDER.includes(arg)) next = arg;
      else {
        const i = THEME_ORDER.indexOf(themeRef.current);
        next = THEME_ORDER[(i + 1) % THEME_ORDER.length];
      }
      setTweak("theme", next);
    }

    setLog((l) => [...l, { id: nextId(), cmd, animate }]);
  };

  const onKey = (e) => {
    if (e.key === "Enter") {
      run(value, false);
      setValue("");
    } else if (e.key === "ArrowUp") {
      e.preventDefault();
      const h = histRef.current;
      if (!h.length) return;
      histIdx.current = histIdx.current < 0 ? h.length - 1 : Math.max(0, histIdx.current - 1);
      setValue(h[histIdx.current]);
    } else if (e.key === "ArrowDown") {
      e.preventDefault();
      const h = histRef.current;
      if (histIdx.current < 0) return;
      histIdx.current = histIdx.current + 1;
      if (histIdx.current >= h.length) { histIdx.current = -1; setValue(""); }
      else setValue(h[histIdx.current]);
    } else if (e.key === "Tab") {
      e.preventDefault();
      const names = window.COMMANDS.map((c) => c[0]);
      const match = names.filter((n) => n.startsWith(value.trim()));
      if (match.length === 1) setValue(match[0]);
      else if (match.length > 1) {
        setLog((l) => [...l, { id: nextId(), cmd: "help", animate: false }]);
      }
    } else if (e.key === "l" && e.ctrlKey) {
      e.preventDefault();
      setLog([]); _id = 1;
    }
  };

  return (
    <div className="stage">
      <div className="window">
        <div className="titlebar">
          <div className="lights">
            <span className="light r" /><span className="light y" /><span className="light g" />
          </div>
          <span className="title-text">
            <span className="accent">noctidev</span>@arch: ~/portfolio — zsh
          </span>
          <span className="spacer" />
          <span className="conn"><span className="dot" /> ssh · {THEME_LABEL[theme]}</span>
          <button className="tweaks-btn" onClick={onOpenTweaks}>tweaks</button>
        </div>

        <div className="term" ref={termRef} onClick={() => inputRef.current && inputRef.current.focus()}>
          {log.map((item) =>
            item.intro
              ? <Intro key={item.id} onRun={run} />
              : <CmdItem key={item.id} item={item} theme={theme} scrollDown={scrollDown} />
          )}
        </div>

        <div className={"promptbar" + (focused ? " focused" : "")}>
          <Ps1 user={window.SITE.user} host={window.SITE.host} path={window.SITE.path} />
          <input
            ref={inputRef}
            value={value}
            spellCheck={false}
            autoComplete="off"
            autoCapitalize="off"
            placeholder="escribe un comando… (help)"
            onChange={(e) => setValue(e.target.value)}
            onKeyDown={onKey}
            onFocus={() => setFocused(true)}
            onBlur={() => setFocused(false)}
          />
          <span className="hint">
            <kbd>Tab</kbd> autocompleta · <kbd>↑</kbd> historial · <kbd>clear</kbd> limpia
          </span>
        </div>
      </div>
      <div className="crt-overlay" />
    </div>
  );
}

window.Terminal = Terminal;
window.TWEAK_DEFAULTS = TWEAK_DEFAULTS;
window.THEME_ORDER = THEME_ORDER;
window.THEME_LABEL = THEME_LABEL;
